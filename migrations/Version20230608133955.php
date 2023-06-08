<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608133955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hero_item (hero_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_9FF0475845B0BCD (hero_id), INDEX IDX_9FF04758126F525E (item_id), PRIMARY KEY(hero_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hero_item ADD CONSTRAINT FK_9FF0475845B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_item ADD CONSTRAINT FK_9FF04758126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero_item DROP FOREIGN KEY FK_9FF0475845B0BCD');
        $this->addSql('ALTER TABLE hero_item DROP FOREIGN KEY FK_9FF04758126F525E');
        $this->addSql('DROP TABLE hero_item');
    }
}
