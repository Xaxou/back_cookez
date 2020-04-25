<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409091950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE frigo (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A1D16CE1FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frigo_ingredients (frigo_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_DF2F9A11F6FDB9EF (frigo_id), INDEX IDX_DF2F9A113EC4DCE (ingredients_id), PRIMARY KEY(frigo_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE frigo ADD CONSTRAINT FK_A1D16CE1FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE frigo_ingredients ADD CONSTRAINT FK_DF2F9A11F6FDB9EF FOREIGN KEY (frigo_id) REFERENCES frigo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE frigo_ingredients ADD CONSTRAINT FK_DF2F9A113EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE frigo_ingredients DROP FOREIGN KEY FK_DF2F9A11F6FDB9EF');
        $this->addSql('DROP TABLE frigo');
        $this->addSql('DROP TABLE frigo_ingredients');
    }
}
