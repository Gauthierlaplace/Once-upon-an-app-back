<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626214201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD picture_id INT DEFAULT NULL, DROP picture');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7EE45BDBF ON event (picture_id)');
        $this->addSql('ALTER TABLE hero ADD picture_id INT DEFAULT NULL, DROP picture');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_51CE6E86EE45BDBF ON hero (picture_id)');
        $this->addSql('ALTER TABLE item ADD picture_id INT DEFAULT NULL, DROP picture');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251EEE45BDBF ON item (picture_id)');
        $this->addSql('ALTER TABLE npc ADD picture_id INT DEFAULT NULL, DROP picture');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_468C762CEE45BDBF ON npc (picture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EEE45BDBF');
        $this->addSql('DROP INDEX UNIQ_1F1B251EEE45BDBF ON item');
        $this->addSql('ALTER TABLE item ADD picture VARCHAR(255) DEFAULT NULL, DROP picture_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7EE45BDBF');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7EE45BDBF ON event');
        $this->addSql('ALTER TABLE event ADD picture VARCHAR(255) DEFAULT NULL, DROP picture_id');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762CEE45BDBF');
        $this->addSql('DROP INDEX UNIQ_468C762CEE45BDBF ON npc');
        $this->addSql('ALTER TABLE npc ADD picture VARCHAR(255) DEFAULT NULL, DROP picture_id');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86EE45BDBF');
        $this->addSql('DROP INDEX IDX_51CE6E86EE45BDBF ON hero');
        $this->addSql('ALTER TABLE hero ADD picture VARCHAR(255) DEFAULT NULL, DROP picture_id');
    }
}
