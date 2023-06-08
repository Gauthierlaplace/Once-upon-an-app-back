<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608134212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE npc_item (npc_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_46576227CA7D6B89 (npc_id), INDEX IDX_46576227126F525E (item_id), PRIMARY KEY(npc_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE npc_item ADD CONSTRAINT FK_46576227CA7D6B89 FOREIGN KEY (npc_id) REFERENCES npc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE npc_item ADD CONSTRAINT FK_46576227126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE npc_item DROP FOREIGN KEY FK_46576227CA7D6B89');
        $this->addSql('ALTER TABLE npc_item DROP FOREIGN KEY FK_46576227126F525E');
        $this->addSql('DROP TABLE npc_item');
    }
}
