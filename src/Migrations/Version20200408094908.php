<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408094908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cuisson (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, etape_text VARCHAR(255) NOT NULL, num_etape INT NOT NULL, INDEX IDX_8FADE20489312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette_recettes (etiquette_id INT NOT NULL, recettes_id INT NOT NULL, INDEX IDX_28E35B127BD2EA57 (etiquette_id), INDEX IDX_28E35B123E2ED6D6 (recettes_id), PRIMARY KEY(etiquette_id, recettes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, INDEX IDX_4B60114FBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, user_id INT NOT NULL, etoiles INT NOT NULL, INDEX IDX_11BA68C89312FE9 (recette_id), INDEX IDX_11BA68CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preparation (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, etape_text VARCHAR(255) NOT NULL, num_etape INT NOT NULL, INDEX IDX_F9F0AAF489312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantite (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, recette_id INT NOT NULL, quantite VARCHAR(255) NOT NULL, INDEX IDX_8BF24A79933FE08C (ingredient_id), INDEX IDX_8BF24A7989312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recettes (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, createur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, difficulte INT NOT NULL, tempsprepa VARCHAR(255) NOT NULL, tempscuisson VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, nbr_personnes INT NOT NULL, INDEX IDX_EB48E72CC54C8C93 (type_id), INDEX IDX_EB48E72C73A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recettes_ingredients (recettes_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_33E6DB8E3E2ED6D6 (recettes_id), INDEX IDX_33E6DB8E3EC4DCE (ingredients_id), PRIMARY KEY(recettes_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cuisson ADD CONSTRAINT FK_8FADE20489312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('ALTER TABLE etiquette_recettes ADD CONSTRAINT FK_28E35B127BD2EA57 FOREIGN KEY (etiquette_id) REFERENCES etiquette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etiquette_recettes ADD CONSTRAINT FK_28E35B123E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C89312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE preparation ADD CONSTRAINT FK_F9F0AAF489312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('ALTER TABLE quantite ADD CONSTRAINT FK_8BF24A79933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE quantite ADD CONSTRAINT FK_8BF24A7989312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('ALTER TABLE recettes ADD CONSTRAINT FK_EB48E72CC54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE recettes ADD CONSTRAINT FK_EB48E72C73A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recettes_ingredients ADD CONSTRAINT FK_33E6DB8E3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_ingredients ADD CONSTRAINT FK_33E6DB8E3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114FBCF5E72D');
        $this->addSql('ALTER TABLE etiquette_recettes DROP FOREIGN KEY FK_28E35B127BD2EA57');
        $this->addSql('ALTER TABLE quantite DROP FOREIGN KEY FK_8BF24A79933FE08C');
        $this->addSql('ALTER TABLE recettes_ingredients DROP FOREIGN KEY FK_33E6DB8E3EC4DCE');
        $this->addSql('ALTER TABLE cuisson DROP FOREIGN KEY FK_8FADE20489312FE9');
        $this->addSql('ALTER TABLE etiquette_recettes DROP FOREIGN KEY FK_28E35B123E2ED6D6');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C89312FE9');
        $this->addSql('ALTER TABLE preparation DROP FOREIGN KEY FK_F9F0AAF489312FE9');
        $this->addSql('ALTER TABLE quantite DROP FOREIGN KEY FK_8BF24A7989312FE9');
        $this->addSql('ALTER TABLE recettes_ingredients DROP FOREIGN KEY FK_33E6DB8E3E2ED6D6');
        $this->addSql('ALTER TABLE recettes DROP FOREIGN KEY FK_EB48E72CC54C8C93');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CA76ED395');
        $this->addSql('ALTER TABLE recettes DROP FOREIGN KEY FK_EB48E72C73A201E5');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE cuisson');
        $this->addSql('DROP TABLE etiquette');
        $this->addSql('DROP TABLE etiquette_recettes');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE preparation');
        $this->addSql('DROP TABLE quantite');
        $this->addSql('DROP TABLE recettes');
        $this->addSql('DROP TABLE recettes_ingredients');
        $this->addSql('DROP TABLE types');
        $this->addSql('DROP TABLE user');
    }
}
