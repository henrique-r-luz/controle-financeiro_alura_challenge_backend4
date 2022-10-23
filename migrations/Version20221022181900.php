<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221022181900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE despesas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE receita_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE despesas (id INT NOT NULL, descricao VARCHAR(255) NOT NULL, valor NUMERIC(15, 2) NOT NULL, data DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE receita (id INT NOT NULL, descricao VARCHAR(255) NOT NULL, valor NUMERIC(15, 2) NOT NULL, data DATE NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE despesas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE receita_id_seq CASCADE');
        $this->addSql('DROP TABLE despesas');
        $this->addSql('DROP TABLE receita');
    }
}
