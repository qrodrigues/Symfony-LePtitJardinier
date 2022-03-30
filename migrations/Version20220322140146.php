<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322140146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devis (no INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_8B27C52BFB88E14F (utilisateur_id), PRIMARY KEY(no)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tailler (id INT AUTO_INCREMENT NOT NULL, code_haie_id VARCHAR(255) NOT NULL, hauteur NUMERIC(10, 2) NOT NULL, longueur NUMERIC(10, 2) NOT NULL, INDEX IDX_447D1788DFE04BB0 (code_haie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE tailler ADD CONSTRAINT FK_447D1788DFE04BB0 FOREIGN KEY (code_haie_id) REFERENCES haie (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE tailler');
    }
}
