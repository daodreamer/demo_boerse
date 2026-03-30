<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Driver\Middleware;
use Doctrine\DBAL\Driver\Middleware\AbstractDriverMiddleware;
use SensitiveParameter;

/**
 * Doctrine DBAL middleware that enables SSL for TiDB Cloud Serverless.
 *
 * When DB_SSL_CA env var is set, intercepts the DBAL connection and switches
 * to the mysqli driver (which properly calls mysqli_ssl_set() before connecting).
 * This bypasses Doctrine Bundle's config validation, which does not allow
 * ssl_ca as a direct YAML option.
 */
final class TiDBSSLMiddleware implements Middleware
{
    public function __construct(private readonly string $sslCa) {}

    public function wrap(Driver $driver): Driver
    {
        if ($this->sslCa === '') {
            return $driver;
        }

        $sslCa = $this->sslCa;

        return new class($driver, $sslCa) extends AbstractDriverMiddleware {
            public function __construct(Driver $driver, private readonly string $sslCa)
            {
                parent::__construct($driver);
            }

            public function connect(#[SensitiveParameter] array $params): Driver\Connection
            {
                // Use the mysqli driver which calls mysqli_ssl_set() before real_connect().
                // PDO::MYSQL_ATTR_SSL_CA fails on PHP 8.4 (PDO::connect() regression).
                $params['ssl_ca'] = $this->sslCa;
                return (new \Doctrine\DBAL\Driver\Mysqli\Driver())->connect($params);
            }
        };
    }
}
