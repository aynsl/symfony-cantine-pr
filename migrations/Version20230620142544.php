<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620142544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_registration (child_id INT NOT NULL, registration_id INT NOT NULL, INDEX IDX_BEA42E0FDD62C21B (child_id), INDEX IDX_BEA42E0F833D8F43 (registration_id), PRIMARY KEY(child_id, registration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child_registration ADD CONSTRAINT FK_BEA42E0FDD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_registration ADD CONSTRAINT FK_BEA42E0F833D8F43 FOREIGN KEY (registration_id) REFERENCES registration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_reservation DROP FOREIGN KEY FK_984C2E7BB83297E7');
        $this->addSql('ALTER TABLE child_reservation DROP FOREIGN KEY FK_984C2E7BDD62C21B');
        $this->addSql('DROP TABLE child_reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE child ADD firstname VARCHAR(50) NOT NULL, DROP fisrtname, DROP sexe, CHANGE lastname lastname VARCHAR(50) NOT NULL, CHANGE age age INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user ADD lastname VARCHAR(50) DEFAULT NULL, CHANGE firstname firstname VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_reservation (child_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_984C2E7BDD62C21B (child_id), INDEX IDX_984C2E7BB83297E7 (reservation_id), PRIMARY KEY(child_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE child_reservation ADD CONSTRAINT FK_984C2E7BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_reservation ADD CONSTRAINT FK_984C2E7BDD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_registration DROP FOREIGN KEY FK_BEA42E0FDD62C21B');
        $this->addSql('ALTER TABLE child_registration DROP FOREIGN KEY FK_BEA42E0F833D8F43');
        $this->addSql('DROP TABLE child_registration');
        $this->addSql('DROP TABLE registration');
        $this->addSql('ALTER TABLE child ADD fisrtname VARCHAR(100) NOT NULL, ADD sexe VARCHAR(50) DEFAULT NULL, DROP firstname, CHANGE lastname lastname VARCHAR(100) NOT NULL, CHANGE age age SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP lastname, CHANGE firstname firstname VARCHAR(100) NOT NULL');
    }
}
