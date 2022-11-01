<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101002725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE categoria_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categoria (id INT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE despesas ADD categoria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE despesas ADD CONSTRAINT FK_73CC26923397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_73CC26923397707A ON despesas (categoria_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE despesas DROP CONSTRAINT FK_73CC26923397707A');
        $this->addSql('DROP SEQUENCE categoria_id_seq CASCADE');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP INDEX IDX_73CC26923397707A');
        $this->addSql('ALTER TABLE despesas DROP categoria_id');
    }
}
