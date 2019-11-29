<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122112220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fight (id INT AUTO_INCREMENT NOT NULL, combattant1_id INT NOT NULL, combattant2_id INT NOT NULL, rounds LONGTEXT NOT NULL, INDEX IDX_21AA4456CF4B102E (combattant1_id), INDEX IDX_21AA4456DDFEBFC0 (combattant2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA4456CF4B102E FOREIGN KEY (combattant1_id) REFERENCES combattant (id)');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA4456DDFEBFC0 FOREIGN KEY (combattant2_id) REFERENCES combattant (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE fight');
    }
}
