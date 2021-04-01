<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401121605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail ADD sender_id INT DEFAULT NULL, ADD recipient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movie CHANGE picture picture LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD picture LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail DROP sender_id, DROP recipient_id');
        $this->addSql('ALTER TABLE movie CHANGE picture picture VARCHAR(128) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP picture');
    }
}
