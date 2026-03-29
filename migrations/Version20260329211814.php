<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260329211814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE derivate_products CHANGE `change` change_val VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE etf_products CHANGE `change` change_val VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE eurex_futures CHANGE `change` change_val VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE market_indices CHANGE `change` change_val VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE ticker_items CHANGE `change` change_val VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE tops_flops CHANGE `change` change_val VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE derivate_products CHANGE change_val `change` VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE etf_products CHANGE change_val `change` VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE eurex_futures CHANGE change_val `change` VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE market_indices CHANGE change_val `change` VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE ticker_items CHANGE change_val `change` VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE tops_flops CHANGE change_val `change` VARCHAR(20) NOT NULL');
    }
}
