<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220924143317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dumpster (id INT AUTO_INCREMENT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, capacity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT DEFAULT NULL, receiver_id INT NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FCD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, route_json LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_2C420795741EEB9 (fk_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, dumpsters_id INT DEFAULT NULL, fk_user_id INT NOT NULL, fk_admin_id INT DEFAULT NULL, image_src LONGTEXT DEFAULT NULL, content LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_8004EBA5A177FE1 (dumpsters_id), INDEX IDX_8004EBA55741EEB9 (fk_user_id), INDEX IDX_8004EBA55603C1CE (fk_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C420795741EEB9 FOREIGN KEY (fk_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5A177FE1 FOREIGN KEY (dumpsters_id) REFERENCES dumpster (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA55741EEB9 FOREIGN KEY (fk_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA55603C1CE FOREIGN KEY (fk_admin_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCD53EDB6');
        $this->addSql('ALTER TABLE route DROP FOREIGN KEY FK_2C420795741EEB9');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5A177FE1');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA55741EEB9');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA55603C1CE');
        $this->addSql('DROP TABLE dumpster');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP TABLE `user`');
    }
}
