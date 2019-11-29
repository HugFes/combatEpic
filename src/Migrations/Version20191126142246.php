<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126142246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fight ADD winner_id INT NOT NULL');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA4456CF4B102E FOREIGN KEY (combattant1_id) REFERENCES warrior (id)');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA4456DDFEBFC0 FOREIGN KEY (combattant2_id) REFERENCES warrior (id)');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA44565DFCD4B8 FOREIGN KEY (winner_id) REFERENCES warrior (id)');
        $this->addSql('CREATE INDEX IDX_21AA44565DFCD4B8 ON fight (winner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA4456CF4B102E');
        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA4456DDFEBFC0');
        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA44565DFCD4B8');
        $this->addSql('DROP INDEX IDX_21AA44565DFCD4B8 ON fight');
        $this->addSql('ALTER TABLE fight DROP winner_id');
    }
}
