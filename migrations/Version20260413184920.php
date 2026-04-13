<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260413184920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE market_indices CHANGE sparkline sparkline JSON NOT NULL');
        $this->addSql('ALTER TABLE tagestrends_panels CHANGE line line JSON NOT NULL');
        $this->addSql('ALTER TABLE tops_flops CHANGE sparkline sparkline JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE market_indices CHANGE sparkline sparkline VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tagestrends_panels CHANGE line line LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE tops_flops CHANGE sparkline sparkline VARCHAR(255) DEFAULT NULL');
    }
}
