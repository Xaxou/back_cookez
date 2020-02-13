<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213132028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredients CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recettes ADD createur_id INT NOT NULL');
        $this->addSql('ALTER TABLE recettes ADD CONSTRAINT FK_EB48E72C73A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EB48E72C73A201E5 ON recettes (createur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredients CHANGE categorie_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE recettes DROP FOREIGN KEY FK_EB48E72C73A201E5');
        $this->addSql('DROP INDEX IDX_EB48E72C73A201E5 ON recettes');
        $this->addSql('ALTER TABLE recettes DROP createur_id');
    }
}
