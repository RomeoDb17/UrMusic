<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301113827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cancion_en_playlist (id_relacion INT AUTO_INCREMENT NOT NULL, id_cancion INT DEFAULT NULL, id_playlist INT DEFAULT NULL, INDEX IDX_9D1A093C3AFFA6D0 (id_cancion), INDEX IDX_9D1A093C8759FDB8 (id_playlist), PRIMARY KEY(id_relacion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE cancion_en_playlist ADD CONSTRAINT FK_9D1A093C3AFFA6D0 FOREIGN KEY (id_cancion) REFERENCES cancion (id)');
        $this->addSql('ALTER TABLE cancion_en_playlist ADD CONSTRAINT FK_9D1A093C8759FDB8 FOREIGN KEY (id_playlist) REFERENCES playlist (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cancion_en_playlist DROP FOREIGN KEY FK_9D1A093C3AFFA6D0');
        $this->addSql('ALTER TABLE cancion_en_playlist DROP FOREIGN KEY FK_9D1A093C8759FDB8');
        $this->addSql('DROP TABLE cancion_en_playlist');
    }
}
