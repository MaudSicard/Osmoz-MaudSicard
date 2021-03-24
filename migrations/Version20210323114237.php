<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323114237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(64) NOT NULL, author VARCHAR(64) NOT NULL, picture VARCHAR(128) DEFAULT NULL, status VARCHAR(128) NOT NULL, state INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_CBE5A331C54C8C93 (type_id), INDEX IDX_CBE5A331A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_gender (book_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_EE9001CF16A2B381 (book_id), INDEX IDX_EE9001CF708A0E0 (gender_id), PRIMARY KEY(book_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, media LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(64) NOT NULL, picture VARCHAR(128) DEFAULT NULL, status VARCHAR(128) NOT NULL, state INT NOT NULL, support VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_1D5EF26FC54C8C93 (type_id), INDEX IDX_1D5EF26FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_gender (movie_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_3E8097378F93B6FC (movie_id), INDEX IDX_3E809737708A0E0 (gender_id), PRIMARY KEY(movie_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(64) NOT NULL, artist VARCHAR(64) NOT NULL, picture VARCHAR(128) DEFAULT NULL, status VARCHAR(128) NOT NULL, state INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, support VARCHAR(64) NOT NULL, INDEX IDX_CD52224AC54C8C93 (type_id), INDEX IDX_CD52224AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_gender (music_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_529FC9BB399BBB13 (music_id), INDEX IDX_529FC9BB708A0E0 (gender_id), PRIMARY KEY(music_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, media LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_mail (user_id INT NOT NULL, mail_id INT NOT NULL, INDEX IDX_2BA7E081A76ED395 (user_id), INDEX IDX_2BA7E081C8776F01 (mail_id), PRIMARY KEY(user_id, mail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE book_gender ADD CONSTRAINT FK_EE9001CF16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_gender ADD CONSTRAINT FK_EE9001CF708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE movie_gender ADD CONSTRAINT FK_3E8097378F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_gender ADD CONSTRAINT FK_3E809737708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE music_gender ADD CONSTRAINT FK_529FC9BB399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_gender ADD CONSTRAINT FK_529FC9BB708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_mail ADD CONSTRAINT FK_2BA7E081A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_mail ADD CONSTRAINT FK_2BA7E081C8776F01 FOREIGN KEY (mail_id) REFERENCES mail (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_gender DROP FOREIGN KEY FK_EE9001CF16A2B381');
        $this->addSql('ALTER TABLE book_gender DROP FOREIGN KEY FK_EE9001CF708A0E0');
        $this->addSql('ALTER TABLE movie_gender DROP FOREIGN KEY FK_3E809737708A0E0');
        $this->addSql('ALTER TABLE music_gender DROP FOREIGN KEY FK_529FC9BB708A0E0');
        $this->addSql('ALTER TABLE user_mail DROP FOREIGN KEY FK_2BA7E081C8776F01');
        $this->addSql('ALTER TABLE movie_gender DROP FOREIGN KEY FK_3E8097378F93B6FC');
        $this->addSql('ALTER TABLE music_gender DROP FOREIGN KEY FK_529FC9BB399BBB13');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331C54C8C93');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FC54C8C93');
        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224AC54C8C93');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331A76ED395');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FA76ED395');
        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224AA76ED395');
        $this->addSql('ALTER TABLE user_mail DROP FOREIGN KEY FK_2BA7E081A76ED395');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_gender');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_gender');
        $this->addSql('DROP TABLE music');
        $this->addSql('DROP TABLE music_gender');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_mail');
    }
}
