<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180923101910 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE last_name last_name VARCHAR(100) DEFAULT NULL, CHANGE middle_name middle_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE invite CHANGE arrived_at arrived_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE payment CHANGE payed_by_id payed_by_id INT DEFAULT NULL, CHANGE payed_at payed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE activity ADD venue_id INT DEFAULT NULL, CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE distance distance DOUBLE PRECISION DEFAULT NULL, CHANGE travel_time_minutes travel_time_minutes DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A40A73EBA FOREIGN KEY (venue_id) REFERENCES venue (id)');
        $this->addSql('CREATE INDEX IDX_AC74095A40A73EBA ON activity (venue_id)');
        $this->addSql('ALTER TABLE organiser CHANGE phone phone VARCHAR(25) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE web web VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE permission CHANGE permitted_by_id permitted_by_id INT DEFAULT NULL, CHANGE permitted_at permitted_at DATETIME DEFAULT NULL');

        $this->addSql("INSERT INTO `category` VALUES (1,'Sport'),(2,'Education'),(3,'Charity');");
        $this->addSql("INSERT INTO `organiser` VALUES (1,'Taronga Foundation','1300 369 116','tarongafoundation@zoo.nsw.gov.au','https://taronga.org.au/');");
        $this->addSql("INSERT INTO `role` VALUES (1,'Student'),(2,'Parent'),(3,'Volunteer'),(4,'Other');");
        $this->addSql("INSERT INTO `user` VALUES (1,'mark.morrison@example.com','[]','123','Mark','Morrison',NULL),(2,'jjcook@example.com','[]','123','James','Cook',NULL),(3,'victoria@example.com','[]','123','Victoria','Parcker',NULL),(4,'Kirsty.Needham@example.com','[]','123','Kirsty','Needham',NULL);");
        $this->addSql("INSERT INTO `venue` VALUES (1,'Beauchamp Park',-33.7908509,151.185835,0),(2,'The Concourse',-33.7956504,151.1826746,0),(3,'Taronga Zoo',-33.8435428,151.2391531,0),(4,'The School',-33.7961912,151.1828072,1);");
        $this->addSql("INSERT INTO `activity` VALUES (1,2,'Visiting the Zoo!','<p>You can see <strong>all</strong> the endemic anumals in one place!</p>\r\n\r\n<p>Cost is <u>$50</u> per person.</p>','2018-10-15 10:00:00',8040,18,3),(2,1,'Charity Marathon','<p>Run for money, mate, run!</p>','2018-11-20 08:30:00',1276,3.7666666666667,1);");
        $this->addSql("INSERT INTO `invite` VALUES (1,1,1,1,NULL),(2,1,3,1,NULL),(3,1,2,3,NULL),(4,1,4,2,NULL);");
        $this->addSql("INSERT INTO `activity_organiser` VALUES (1,1);");
        $this->addSql("INSERT INTO `payment` VALUES (1,1,1,NULL,NULL,50.00),(2,1,3,4,'2018-09-24 10:00:00',50.00);");
        $this->addSql("INSERT INTO `permission` VALUES (1,1,3,4,'2018-09-24 10:00:00');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A40A73EBA');
        $this->addSql('DROP INDEX IDX_AC74095A40A73EBA ON activity');
        $this->addSql('ALTER TABLE activity DROP venue_id, CHANGE start_date start_date DATETIME DEFAULT \'NULL\', CHANGE distance distance DOUBLE PRECISION DEFAULT \'NULL\', CHANGE travel_time_minutes travel_time_minutes DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE invite CHANGE arrived_at arrived_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE organiser CHANGE phone phone VARCHAR(25) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE web web VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE payment CHANGE payed_by_id payed_by_id INT DEFAULT NULL, CHANGE payed_at payed_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE permission CHANGE permitted_by_id permitted_by_id INT DEFAULT NULL, CHANGE permitted_at permitted_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE last_name last_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE middle_name middle_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
