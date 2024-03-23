<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240323122053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation table VilleCodePost + table region + relation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, region VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville_code_post (id INT AUTO_INCREMENT NOT NULL, region_id INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_post VARCHAR(255) DEFAULT NULL, INDEX IDX_8B1BCAA198260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ville_code_post ADD CONSTRAINT FK_8B1BCAA198260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE utilisateur ADD ville_code_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B358B04C4 FOREIGN KEY (ville_code_post_id) REFERENCES ville_code_post (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B358B04C4 ON utilisateur (ville_code_post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B358B04C4');
        $this->addSql('ALTER TABLE ville_code_post DROP FOREIGN KEY FK_8B1BCAA198260155');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE ville_code_post');
        $this->addSql('DROP INDEX IDX_1D1C63B358B04C4 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP ville_code_post_id');
    }
}
