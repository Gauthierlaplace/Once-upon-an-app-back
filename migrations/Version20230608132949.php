<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608132949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ending ADD event_id INT NOT NULL, ADD event_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE ending ADD CONSTRAINT FK_1413D44F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE ending ADD CONSTRAINT FK_1413D44F401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
        $this->addSql('CREATE INDEX IDX_1413D44F71F7E88B ON ending (event_id)');
        $this->addSql('CREATE INDEX IDX_1413D44F401B253C ON ending (event_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ending DROP FOREIGN KEY FK_1413D44F71F7E88B');
        $this->addSql('ALTER TABLE ending DROP FOREIGN KEY FK_1413D44F401B253C');
        $this->addSql('DROP INDEX IDX_1413D44F71F7E88B ON ending');
        $this->addSql('DROP INDEX IDX_1413D44F401B253C ON ending');
        $this->addSql('ALTER TABLE ending DROP event_id, DROP event_type_id');
    }
}
