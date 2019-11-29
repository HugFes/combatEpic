<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106081151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE combattant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pv INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE troll (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pv INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nain (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pv INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE elfe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pv INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE combattant');
        $this->addSql('DROP TABLE troll');
        $this->addSql('DROP TABLE nain');
        $this->addSql('DROP TABLE elfe');
    }
}
