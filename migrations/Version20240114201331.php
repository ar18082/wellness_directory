<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240114201331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD internaute_id INT DEFAULT NULL, ADD prestataire_id INT DEFAULT NULL, ADD adresse_number VARCHAR(255) DEFAULT NULL, ADD adresse_rue VARCHAR(255) DEFAULT NULL, ADD inscription DATE NOT NULL, ADD type_utilisateur VARCHAR(255) DEFAULT NULL, ADD nb_essais_infructueux INT DEFAULT NULL, ADD banni TINYINT(1) NOT NULL, ADD inscript_confirm TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3CAF41882 ON utilisateur (internaute_id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3BE3DB2B7 ON utilisateur (prestataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3CAF41882');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3BE3DB2B7');
        $this->addSql('DROP INDEX IDX_1D1C63B3CAF41882 ON utilisateur');
        $this->addSql('DROP INDEX IDX_1D1C63B3BE3DB2B7 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP internaute_id, DROP prestataire_id, DROP adresse_number, DROP adresse_rue, DROP inscription, DROP type_utilisateur, DROP nb_essais_infructueux, DROP banni, DROP inscript_confirm');
    }
}
