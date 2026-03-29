<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260329211110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aktien_news (id INT AUTO_INCREMENT NOT NULL, time VARCHAR(10) NOT NULL, title VARCHAR(255) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE analyses_list (id INT AUTO_INCREMENT NOT NULL, time VARCHAR(20) NOT NULL, title VARCHAR(255) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE anlagestrategen (id INT AUTO_INCREMENT NOT NULL, badge VARCHAR(30) NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(100) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE derivate_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, icon VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, count VARCHAR(20) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE derivate_products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, issuer VARCHAR(80) NOT NULL, bid VARCHAR(20) NOT NULL, ask VARCHAR(20) NOT NULL, `change` VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE devisen_rows (id INT AUTO_INCREMENT NOT NULL, pair VARCHAR(20) NOT NULL, kurs VARCHAR(20) NOT NULL, pct VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE etf_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, count VARCHAR(20) NOT NULL, example VARCHAR(150) NOT NULL, ter VARCHAR(20) NOT NULL, aum VARCHAR(30) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE etf_products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, isin VARCHAR(20) NOT NULL, price VARCHAR(20) NOT NULL, `change` VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, ytd VARCHAR(20) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE eurex_futures (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, expiry VARCHAR(20) NOT NULL, last VARCHAR(20) NOT NULL, `change` VARCHAR(20) NOT NULL, pct VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, volume VARCHAR(20) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE eurex_options (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, expiry VARCHAR(20) NOT NULL, last VARCHAR(20) NOT NULL, iv VARCHAR(20) NOT NULL, volume VARCHAR(20) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE event_items (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(20) NOT NULL, company VARCHAR(150) NOT NULL, type VARCHAR(80) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE experts (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(512) NOT NULL, name VARCHAR(100) NOT NULL, role VARCHAR(150) NOT NULL, title VARCHAR(255) NOT NULL, quote LONGTEXT NOT NULL, timestamp VARCHAR(50) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE fonds_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, count VARCHAR(20) NOT NULL, top_performer VARCHAR(100) NOT NULL, ytd VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE fonds_news (id INT AUTO_INCREMENT NOT NULL, time VARCHAR(10) NOT NULL, title VARCHAR(255) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE fonds_strip_funds (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, thes_price VARCHAR(20) NOT NULL, thes_change VARCHAR(20) NOT NULL, thes_bullish TINYINT NOT NULL, aussh_price VARCHAR(20) NOT NULL, aussh_change VARCHAR(20) NOT NULL, aussh_bullish TINYINT NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE gruppe_news (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(80) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE indizes_rows (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, aktuell VARCHAR(20) NOT NULL, pkt VARCHAR(20) NOT NULL, pct VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, high52 VARCHAR(20) NOT NULL, low52 VARCHAR(20) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE konjunktur_items (id INT AUTO_INCREMENT NOT NULL, datetime VARCHAR(30) NOT NULL, title VARCHAR(255) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE market_indices (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, price VARCHAR(30) NOT NULL, `change` VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, sparkline VARCHAR(255) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE most_searched (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, count VARCHAR(20) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE news_items (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(512) NOT NULL, category VARCHAR(80) NOT NULL, timestamp VARCHAR(50) NOT NULL, title VARCHAR(255) NOT NULL, excerpt LONGTEXT NOT NULL, style VARCHAR(20) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE rohstoffe_rows (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, kurs VARCHAR(20) NOT NULL, pct VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE service_items (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, cta VARCHAR(50) NOT NULL, icon VARCHAR(50) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE site_config (config_key VARCHAR(80) NOT NULL, value JSON NOT NULL, PRIMARY KEY (config_key)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tagestrends_panels (id INT AUTO_INCREMENT NOT NULL, tab_id VARCHAR(30) NOT NULL, bullish TINYINT NOT NULL, high VARCHAR(20) NOT NULL, low VARCHAR(20) NOT NULL, line LONGTEXT NOT NULL, stocks JSON NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tagestrends_tabs (id INT AUTO_INCREMENT NOT NULL, row_index INT NOT NULL, tab_id VARCHAR(30) NOT NULL, label VARCHAR(80) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ticker_items (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, price VARCHAR(30) NOT NULL, `change` VARCHAR(20) NOT NULL, bullish TINYINT NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tops_flops (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, `change` VARCHAR(20) NOT NULL, sparkline VARCHAR(255) DEFAULT NULL, type VARCHAR(10) NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE wissen_categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, icon VARCHAR(50) NOT NULL, articles JSON NOT NULL, sort_order INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE aktien_news');
        $this->addSql('DROP TABLE analyses_list');
        $this->addSql('DROP TABLE anlagestrategen');
        $this->addSql('DROP TABLE derivate_categories');
        $this->addSql('DROP TABLE derivate_products');
        $this->addSql('DROP TABLE devisen_rows');
        $this->addSql('DROP TABLE etf_categories');
        $this->addSql('DROP TABLE etf_products');
        $this->addSql('DROP TABLE eurex_futures');
        $this->addSql('DROP TABLE eurex_options');
        $this->addSql('DROP TABLE event_items');
        $this->addSql('DROP TABLE experts');
        $this->addSql('DROP TABLE fonds_categories');
        $this->addSql('DROP TABLE fonds_news');
        $this->addSql('DROP TABLE fonds_strip_funds');
        $this->addSql('DROP TABLE gruppe_news');
        $this->addSql('DROP TABLE indizes_rows');
        $this->addSql('DROP TABLE konjunktur_items');
        $this->addSql('DROP TABLE market_indices');
        $this->addSql('DROP TABLE most_searched');
        $this->addSql('DROP TABLE news_items');
        $this->addSql('DROP TABLE rohstoffe_rows');
        $this->addSql('DROP TABLE service_items');
        $this->addSql('DROP TABLE site_config');
        $this->addSql('DROP TABLE tagestrends_panels');
        $this->addSql('DROP TABLE tagestrends_tabs');
        $this->addSql('DROP TABLE ticker_items');
        $this->addSql('DROP TABLE tops_flops');
        $this->addSql('DROP TABLE wissen_categories');
    }
}
