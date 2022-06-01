<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530131420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee ADD monday TINYINT(1) DEFAULT NULL, ADD tuesday TINYINT(1) DEFAULT NULL, ADD wednesday TINYINT(1) DEFAULT NULL, ADD thursday TINYINT(1) DEFAULT NULL, ADD friday TINYINT(1) DEFAULT NULL, ADD saturday TINYINT(1) DEFAULT NULL, DROP activites');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee ADD activites LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', DROP monday, DROP tuesday, DROP wednesday, DROP thursday, DROP friday, DROP saturday');
    }
}
