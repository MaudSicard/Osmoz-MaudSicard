<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322131706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE music_gender (music_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_529FC9BB399BBB13 (music_id), INDEX IDX_529FC9BB708A0E0 (gender_id), PRIMARY KEY(music_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE music_gender ADD CONSTRAINT FK_529FC9BB399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_gender ADD CONSTRAINT FK_529FC9BB708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_CD52224AC54C8C93 ON music (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE music_gender');
        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224AC54C8C93');
        $this->addSql('DROP INDEX IDX_CD52224AC54C8C93 ON music');
        $this->addSql('ALTER TABLE music DROP type_id');
    }
}
