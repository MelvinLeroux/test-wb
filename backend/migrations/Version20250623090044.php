<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250623090044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measurement DROP FOREIGN KEY FK_2CE0D811AFC2B591');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D811AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B0AFC2B591');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B0AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measurement DROP FOREIGN KEY FK_2CE0D811AFC2B591');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D811AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B0AFC2B591');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B0AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
