<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027095529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dumpster (id INT AUTO_INCREMENT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, capacity INT NOT NULL, city VARCHAR(255) NOT NULL, street_number VARCHAR(255) NOT NULL, street_label LONGTEXT NOT NULL, postal_code VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id_id INT NOT NULL, receiver_id_id INT NOT NULL, content LONGTEXT NOT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_B6BD307F6061F7CF (sender_id_id), INDEX IDX_B6BD307FBE20CAB0 (receiver_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, team LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, fk_user_id_id INT NOT NULL, date_start DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', date_end DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', route_json LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_2C420796DE8AF9C (fk_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, dumpster_id_id INT DEFAULT NULL, fk_user_id_id INT NOT NULL, fk_admin_id_id INT DEFAULT NULL, image_src VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_8004EBA5BCBD9980 (dumpster_id_id), INDEX IDX_8004EBA56DE8AF9C (fk_user_id_id), INDEX IDX_8004EBA5B698C999 (fk_admin_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F6061F7CF FOREIGN KEY (sender_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FBE20CAB0 FOREIGN KEY (receiver_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C420796DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5BCBD9980 FOREIGN KEY (dumpster_id_id) REFERENCES dumpster (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA56DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5B698C999 FOREIGN KEY (fk_admin_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F6061F7CF');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FBE20CAB0');
        $this->addSql('ALTER TABLE route DROP FOREIGN KEY FK_2C420796DE8AF9C');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5BCBD9980');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA56DE8AF9C');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5B698C999');
        $this->addSql('DROP TABLE dumpster');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP TABLE user');
    }
}
