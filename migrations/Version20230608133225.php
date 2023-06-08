<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608133225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialogue ADD npc_id INT NOT NULL');
        $this->addSql('ALTER TABLE dialogue ADD CONSTRAINT FK_F18A1C39CA7D6B89 FOREIGN KEY (npc_id) REFERENCES npc (id)');
        $this->addSql('CREATE INDEX IDX_F18A1C39CA7D6B89 ON dialogue (npc_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialogue DROP FOREIGN KEY FK_F18A1C39CA7D6B89');
        $this->addSql('DROP INDEX IDX_F18A1C39CA7D6B89 ON dialogue');
        $this->addSql('ALTER TABLE dialogue DROP npc_id');
    }
}
