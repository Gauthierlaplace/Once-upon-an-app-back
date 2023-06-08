<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608134447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_effect (answer_id INT NOT NULL, effect_id INT NOT NULL, INDEX IDX_4499AB55AA334807 (answer_id), INDEX IDX_4499AB55F5E9B83B (effect_id), PRIMARY KEY(answer_id, effect_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_effect ADD CONSTRAINT FK_4499AB55AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer_effect ADD CONSTRAINT FK_4499AB55F5E9B83B FOREIGN KEY (effect_id) REFERENCES effect (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_effect DROP FOREIGN KEY FK_4499AB55AA334807');
        $this->addSql('ALTER TABLE answer_effect DROP FOREIGN KEY FK_4499AB55F5E9B83B');
        $this->addSql('DROP TABLE answer_effect');
    }
}
