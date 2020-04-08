<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408135821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE etiquette_recettes');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etiquette_recettes (etiquette_id INT NOT NULL, recettes_id INT NOT NULL, INDEX IDX_28E35B123E2ED6D6 (recettes_id), INDEX IDX_28E35B127BD2EA57 (etiquette_id), PRIMARY KEY(etiquette_id, recettes_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE etiquette_recettes ADD CONSTRAINT FK_28E35B123E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etiquette_recettes ADD CONSTRAINT FK_28E35B127BD2EA57 FOREIGN KEY (etiquette_id) REFERENCES etiquette (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
