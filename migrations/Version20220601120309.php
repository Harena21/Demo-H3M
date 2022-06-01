<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601120309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee CHANGE monday monday TINYINT(1) DEFAULT NULL, CHANGE tuesday tuesday TINYINT(1) DEFAULT NULL, CHANGE wednesday wednesday TINYINT(1) DEFAULT NULL, CHANGE thursday thursday TINYINT(1) DEFAULT NULL, CHANGE friday friday TINYINT(1) DEFAULT NULL, CHANGE saturday saturday TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee CHANGE monday monday INT DEFAULT NULL, CHANGE tuesday tuesday INT DEFAULT NULL, CHANGE wednesday wednesday INT DEFAULT NULL, CHANGE thursday thursday INT DEFAULT NULL, CHANGE friday friday INT DEFAULT NULL, CHANGE saturday saturday INT DEFAULT NULL');
    }
}
