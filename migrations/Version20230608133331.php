<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608133331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer ADD dialogue_id INT NOT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25A6E12CBD FOREIGN KEY (dialogue_id) REFERENCES dialogue (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25A6E12CBD ON answer (dialogue_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25A6E12CBD');
        $this->addSql('DROP INDEX IDX_DADD4A25A6E12CBD ON answer');
        $this->addSql('ALTER TABLE answer DROP dialogue_id');
    }
}
