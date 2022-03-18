<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318134916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blood_group (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, name VARCHAR(255) NOT NULL, upload_at DATETIME NOT NULL, is_ordonnance TINYINT(1) NOT NULL, INDEX IDX_D8698A766B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drug (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meet (id INT AUTO_INCREMENT NOT NULL, tour_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, start_date_time DATETIME NOT NULL, notes VARCHAR(255) NOT NULL, is_video TINYINT(1) NOT NULL, is_urgent TINYINT(1) NOT NULL, is_missed_meet TINYINT(1) NOT NULL, INDEX IDX_E9F6D3CE15ED8D43 (tour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meet_patient (meet_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_7D9A25E13BBBF66 (meet_id), INDEX IDX_7D9A25E16B899279 (patient_id), PRIMARY KEY(meet_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, gender_id INT NOT NULL, blood_group_id INT DEFAULT NULL, treatments_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, allergies VARCHAR(255) NOT NULL, height DOUBLE PRECISION NOT NULL, weight DOUBLE PRECISION NOT NULL, social_number VARCHAR(255) NOT NULL, notes VARCHAR(255) NOT NULL, INDEX IDX_1ADAD7EB708A0E0 (gender_id), INDEX IDX_1ADAD7EB5F3AECE2 (blood_group_id), INDEX IDX_1ADAD7EB43E7654B (treatments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE treatment (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, repeats LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_98013C316B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE treatment_drug (treatment_id INT NOT NULL, drug_id INT NOT NULL, INDEX IDX_8028B62F471C0366 (treatment_id), INDEX IDX_8028B62FAABCA765 (drug_id), PRIMARY KEY(treatment_id, drug_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A766B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE meet_patient ADD CONSTRAINT FK_7D9A25E13BBBF66 FOREIGN KEY (meet_id) REFERENCES meet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meet_patient ADD CONSTRAINT FK_7D9A25E16B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB5F3AECE2 FOREIGN KEY (blood_group_id) REFERENCES blood_group (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB43E7654B FOREIGN KEY (treatments_id) REFERENCES treatment (id)');
        $this->addSql('ALTER TABLE treatment ADD CONSTRAINT FK_98013C316B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE treatment_drug ADD CONSTRAINT FK_8028B62F471C0366 FOREIGN KEY (treatment_id) REFERENCES treatment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE treatment_drug ADD CONSTRAINT FK_8028B62FAABCA765 FOREIGN KEY (drug_id) REFERENCES drug (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB5F3AECE2');
        $this->addSql('ALTER TABLE treatment_drug DROP FOREIGN KEY FK_8028B62FAABCA765');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB708A0E0');
        $this->addSql('ALTER TABLE meet_patient DROP FOREIGN KEY FK_7D9A25E13BBBF66');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A766B899279');
        $this->addSql('ALTER TABLE meet_patient DROP FOREIGN KEY FK_7D9A25E16B899279');
        $this->addSql('ALTER TABLE treatment DROP FOREIGN KEY FK_98013C316B899279');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE15ED8D43');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB43E7654B');
        $this->addSql('ALTER TABLE treatment_drug DROP FOREIGN KEY FK_8028B62F471C0366');
        $this->addSql('DROP TABLE blood_group');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE drug');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE meet');
        $this->addSql('DROP TABLE meet_patient');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE tour');
        $this->addSql('DROP TABLE treatment');
        $this->addSql('DROP TABLE treatment_drug');
    }
}
