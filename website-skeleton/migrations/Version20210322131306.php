<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322131306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_gender (movie_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_3E8097378F93B6FC (movie_id), INDEX IDX_3E809737708A0E0 (gender_id), PRIMARY KEY(movie_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_gender ADD CONSTRAINT FK_3E8097378F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_gender ADD CONSTRAINT FK_3E809737708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26FC54C8C93 ON movie (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE movie_gender');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FC54C8C93');
        $this->addSql('DROP INDEX IDX_1D5EF26FC54C8C93 ON movie');
        $this->addSql('ALTER TABLE movie DROP type_id');
    }
}
