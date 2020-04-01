<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200401093208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE preparation DROP FOREIGN KEY FK_F9F0AAF42CBBAF3E');
        $this->addSql('DROP INDEX IDX_F9F0AAF42CBBAF3E ON preparation');
        $this->addSql('ALTER TABLE preparation CHANGE id_recette_id recette_id INT NOT NULL');
        $this->addSql('ALTER TABLE preparation ADD CONSTRAINT FK_F9F0AAF489312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('CREATE INDEX IDX_F9F0AAF489312FE9 ON preparation (recette_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE preparation DROP FOREIGN KEY FK_F9F0AAF489312FE9');
        $this->addSql('DROP INDEX IDX_F9F0AAF489312FE9 ON preparation');
        $this->addSql('ALTER TABLE preparation CHANGE recette_id id_recette_id INT NOT NULL');
        $this->addSql('ALTER TABLE preparation ADD CONSTRAINT FK_F9F0AAF42CBBAF3E FOREIGN KEY (id_recette_id) REFERENCES recettes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F9F0AAF42CBBAF3E ON preparation (id_recette_id)');
    }
}
