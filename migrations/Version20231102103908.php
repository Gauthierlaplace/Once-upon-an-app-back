<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102103908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero ADD fight_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86AC6657E4 FOREIGN KEY (fight_id) REFERENCES fight (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51CE6E86AC6657E4 ON hero (fight_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86AC6657E4');
        $this->addSql('DROP INDEX UNIQ_51CE6E86AC6657E4 ON hero');
        $this->addSql('ALTER TABLE hero DROP fight_id');
    }
}
