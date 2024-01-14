<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111191107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modification du bool categ de service false par defaut';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_de_services CHANGE en_avant en_avant TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_de_services CHANGE en_avant en_avant TINYINT(1) DEFAULT NULL');
    }
}
