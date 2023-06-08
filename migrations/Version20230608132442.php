<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608132442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero ADD hero_class_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E864F1EBAB8 FOREIGN KEY (hero_class_id) REFERENCES hero_class (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_51CE6E864F1EBAB8 ON hero (hero_class_id)');
        $this->addSql('CREATE INDEX IDX_51CE6E86A76ED395 ON hero (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E864F1EBAB8');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86A76ED395');
        $this->addSql('DROP INDEX IDX_51CE6E864F1EBAB8 ON hero');
        $this->addSql('DROP INDEX IDX_51CE6E86A76ED395 ON hero');
        $this->addSql('ALTER TABLE hero DROP hero_class_id, DROP user_id');
    }
}
