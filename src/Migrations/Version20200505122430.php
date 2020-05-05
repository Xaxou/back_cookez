<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505122430 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recettes_ingredients DROP FOREIGN KEY FK_33E6DB8E3E2ED6D6');
        $this->addSql('ALTER TABLE recettes_ingredients DROP FOREIGN KEY FK_33E6DB8E3EC4DCE');
        $this->addSql('ALTER TABLE recettes_ingredients ADD CONSTRAINT FK_33E6DB8E3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id)');
        $this->addSql('ALTER TABLE recettes_ingredients ADD CONSTRAINT FK_33E6DB8E3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE recettes_etiquettes DROP FOREIGN KEY FK_11AD1AB01205AB98');
        $this->addSql('ALTER TABLE recettes_etiquettes DROP FOREIGN KEY FK_11AD1AB03E2ED6D6');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB01205AB98 FOREIGN KEY (etiquettes_id) REFERENCES etiquettes (id)');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB03E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recettes_etiquettes DROP FOREIGN KEY FK_11AD1AB03E2ED6D6');
        $this->addSql('ALTER TABLE recettes_etiquettes DROP FOREIGN KEY FK_11AD1AB01205AB98');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB03E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_etiquettes ADD CONSTRAINT FK_11AD1AB01205AB98 FOREIGN KEY (etiquettes_id) REFERENCES etiquettes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_ingredients DROP FOREIGN KEY FK_33E6DB8E3E2ED6D6');
        $this->addSql('ALTER TABLE recettes_ingredients DROP FOREIGN KEY FK_33E6DB8E3EC4DCE');
        $this->addSql('ALTER TABLE recettes_ingredients ADD CONSTRAINT FK_33E6DB8E3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_ingredients ADD CONSTRAINT FK_33E6DB8E3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
