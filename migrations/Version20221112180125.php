<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112180125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        //admin
        //$this->addSql("insert into public.users values (1,'controle_financeiro@cf.com.br','{\"ROLE_USER\"}','$2y$13$8xcj5aYpaGu4oicC/UTuReSGPxT9FiJh1FYxjcQ9aqnMj8MRiw9ne')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
