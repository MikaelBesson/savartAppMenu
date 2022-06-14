<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614094221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE plats_selection');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plats_selection (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, repas_id INT NOT NULL, plat_id INT DEFAULT NULL, INDEX IDX_DCFD8F511D236AAA (repas_id), INDEX IDX_DCFD8F51A76ED395 (user_id), INDEX IDX_DCFD8F51D73DB560 (plat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE plats_selection ADD CONSTRAINT FK_DCFD8F511D236AAA FOREIGN KEY (repas_id) REFERENCES repas (id)');
        $this->addSql('ALTER TABLE plats_selection ADD CONSTRAINT FK_DCFD8F51D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('ALTER TABLE plats_selection ADD CONSTRAINT FK_DCFD8F51A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
