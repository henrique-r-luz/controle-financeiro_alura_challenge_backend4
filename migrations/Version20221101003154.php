<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101003154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(1,'Alimentação');");
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(2,'Saúde');");
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(3,'Moradia');");
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(4,'Transporte');");
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(5,'Eduvação');");
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(6,'Lazer');");
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(7,'Imprevisto');");
        $this->addSql("INSERT INTO public.categoria (id,nome) VALUES(8,'Outras');");
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM public.categoria");
        // this down() migration is auto-generated, please modify it to your needs
    }
}
