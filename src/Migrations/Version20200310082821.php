<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310082821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etiquettes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recettes_etiquettes (recettes_id INT NOT NULL, etiquettes_id INT NOT NULL, INDEX IDX_11AD1AB03E2ED6D6 (recettes_id), INDEX IDX_11AD1AB01205AB98 (etiquettes_id), PRIMARY KEY(recettes_id, etiquettes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB03E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB01205AB98 FOREIGN KEY (etiquettes_id) REFERENCES etiquettes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recettes_etiquettes DROP FOREIGN KEY FK_11AD1AB01205AB98');
        $this->addSql('DROP TABLE etiquettes');
        $this->addSql('DROP TABLE recettes_etiquettes');
    }
}
