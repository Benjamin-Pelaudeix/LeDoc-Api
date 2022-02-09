<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209152544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meet (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(255) NOT NULL, start_date_time DATETIME NOT NULL, notes VARCHAR(255) NOT NULL, is_video TINYINT(1) NOT NULL, is_urgent TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, gender_id INT NOT NULL, blood_group_id INT DEFAULT NULL, treatments_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, allergies VARCHAR(255) NOT NULL, height DOUBLE PRECISION NOT NULL, weight DOUBLE PRECISION NOT NULL, social_number INT NOT NULL, notes VARCHAR(255) NOT NULL, INDEX IDX_1ADAD7EB708A0E0 (gender_id), INDEX IDX_1ADAD7EB5F3AECE2 (blood_group_id), INDEX IDX_1ADAD7EB43E7654B (treatments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB5F3AECE2 FOREIGN KEY (blood_group_id) REFERENCES blood_group (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB43E7654B FOREIGN KEY (treatments_id) REFERENCES treatment (id)');
        $this->addSql('ALTER TABLE document ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A766B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_D8698A766B899279 ON document (patient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A766B899279');
        $this->addSql('DROP TABLE meet');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE tour');
        $this->addSql('ALTER TABLE blood_group CHANGE label label VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_D8698A766B899279 ON document');
        $this->addSql('ALTER TABLE document DROP patient_id, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE drug CHANGE label label VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE gender CHANGE label label VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE treatment CHANGE repeats repeats LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
