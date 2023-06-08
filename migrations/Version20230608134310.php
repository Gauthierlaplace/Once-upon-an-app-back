<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608134310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hero_event (hero_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_A491056045B0BCD (hero_id), INDEX IDX_A491056071F7E88B (event_id), PRIMARY KEY(hero_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hero_event ADD CONSTRAINT FK_A491056045B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_event ADD CONSTRAINT FK_A491056071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero_event DROP FOREIGN KEY FK_A491056045B0BCD');
        $this->addSql('ALTER TABLE hero_event DROP FOREIGN KEY FK_A491056071F7E88B');
        $this->addSql('DROP TABLE hero_event');
    }
}
