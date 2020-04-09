<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402214746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recettes_etiquettes DROP FOREIGN KEY FK_11AD1AB01205AB98');
        $this->addSql('CREATE TABLE cuisson (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, etape_text VARCHAR(255) NOT NULL, num_etape INT NOT NULL, INDEX IDX_8FADE20489312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette_recettes (etiquette_id INT NOT NULL, recettes_id INT NOT NULL, INDEX IDX_28E35B127BD2EA57 (etiquette_id), INDEX IDX_28E35B123E2ED6D6 (recettes_id), PRIMARY KEY(etiquette_id, recettes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantite (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, recette_id INT NOT NULL, quantite VARCHAR(255) NOT NULL, INDEX IDX_8BF24A79933FE08C (ingredient_id), INDEX IDX_8BF24A7989312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cuisson ADD CONSTRAINT FK_8FADE20489312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('ALTER TABLE etiquette_recettes ADD CONSTRAINT FK_28E35B127BD2EA57 FOREIGN KEY (etiquette_id) REFERENCES etiquette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etiquette_recettes ADD CONSTRAINT FK_28E35B123E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quantite ADD CONSTRAINT FK_8BF24A79933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE quantite ADD CONSTRAINT FK_8BF24A7989312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('DROP TABLE etapes');
        $this->addSql('DROP TABLE etiquettes');
        $this->addSql('DROP TABLE recettes_etiquettes');
        $this->addSql('ALTER TABLE preparation RENAME INDEX idx_f9f0aaf42cbbaf3e TO IDX_F9F0AAF489312FE9');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etiquette_recettes DROP FOREIGN KEY FK_28E35B127BD2EA57');
        $this->addSql('CREATE TABLE etapes (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero INT NOT NULL, onglet VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E3443E1789312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etiquettes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recettes_etiquettes (recettes_id INT NOT NULL, etiquettes_id INT NOT NULL, INDEX IDX_11AD1AB01205AB98 (etiquettes_id), INDEX IDX_11AD1AB03E2ED6D6 (recettes_id), PRIMARY KEY(recettes_id, etiquettes_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE etapes ADD CONSTRAINT FK_E3443E1789312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB01205AB98 FOREIGN KEY (etiquettes_id) REFERENCES etiquettes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB03E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE cuisson');
        $this->addSql('DROP TABLE etiquette');
        $this->addSql('DROP TABLE etiquette_recettes');
        $this->addSql('DROP TABLE quantite');
        $this->addSql('ALTER TABLE preparation RENAME INDEX idx_f9f0aaf489312fe9 TO IDX_F9F0AAF42CBBAF3E');
    }
}
