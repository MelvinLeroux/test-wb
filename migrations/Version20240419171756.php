<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240419171756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sensor (id INT AUTO_INCREMENT NOT NULL, modules_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_BC8617B060D6DC42 (modules_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B060D6DC42 FOREIGN KEY (modules_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE measurement ADD sensor_id INT DEFAULT NULL, DROP created_at');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D811A247991F FOREIGN KEY (sensor_id) REFERENCES sensor (id)');
        $this->addSql('CREATE INDEX IDX_2CE0D811A247991F ON measurement (sensor_id)');
        $this->addSql('ALTER TABLE module ADD status TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE type name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measurement DROP FOREIGN KEY FK_2CE0D811A247991F');
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B060D6DC42');
        $this->addSql('DROP TABLE sensor');
        $this->addSql('DROP INDEX IDX_2CE0D811A247991F ON measurement');
        $this->addSql('ALTER TABLE measurement ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP sensor_id');
        $this->addSql('ALTER TABLE module DROP status, DROP created_at, CHANGE name type VARCHAR(255) NOT NULL');
    }
}
