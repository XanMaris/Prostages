<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105123054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stage_fomration (stage_id INT NOT NULL, fomration_id INT NOT NULL, INDEX IDX_105D87F72298D193 (stage_id), INDEX IDX_105D87F7F7DC7FEB (fomration_id), PRIMARY KEY(stage_id, fomration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stage_fomration ADD CONSTRAINT FK_105D87F72298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_fomration ADD CONSTRAINT FK_105D87F7F7DC7FEB FOREIGN KEY (fomration_id) REFERENCES fomration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369A4AEAFEA ON stage (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stage_fomration');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369A4AEAFEA');
        $this->addSql('DROP INDEX IDX_C27C9369A4AEAFEA ON stage');
        $this->addSql('ALTER TABLE stage DROP entreprise_id');
    }
}
