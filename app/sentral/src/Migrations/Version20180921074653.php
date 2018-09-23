<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180921074653 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE venue (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(75) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invite (id INT AUTO_INCREMENT NOT NULL, activity_id INT NOT NULL, participant_id INT NOT NULL, role_id INT NOT NULL, arrived_at DATETIME DEFAULT NULL, INDEX IDX_C7E210D781C06096 (activity_id), INDEX IDX_C7E210D79D1C3019 (participant_id), INDEX IDX_C7E210D7D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, activity_id INT NOT NULL, participant_id INT NOT NULL, payed_by_id INT DEFAULT NULL, amount_cents INT NOT NULL, payed_at DATETIME DEFAULT NULL, INDEX IDX_6D28840D81C06096 (activity_id), INDEX IDX_6D28840D9D1C3019 (participant_id), INDEX IDX_6D28840D816F52CD (payed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATETIME DEFAULT NULL, INDEX IDX_AC74095A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_organiser (activity_id INT NOT NULL, organiser_id INT NOT NULL, INDEX IDX_711D6D4B81C06096 (activity_id), INDEX IDX_711D6D4BA0631C12 (organiser_id), PRIMARY KEY(activity_id, organiser_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organiser (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, phone VARCHAR(25) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, web VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, activity_id INT NOT NULL, participant_id INT NOT NULL, permitted_by_id INT DEFAULT NULL, permitted_at DATETIME DEFAULT NULL, INDEX IDX_E04992AA81C06096 (activity_id), INDEX IDX_E04992AA9D1C3019 (participant_id), INDEX IDX_E04992AABA3F28B2 (permitted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invite ADD CONSTRAINT FK_C7E210D781C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE invite ADD CONSTRAINT FK_C7E210D79D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invite ADD CONSTRAINT FK_C7E210D7D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D9D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D816F52CD FOREIGN KEY (payed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE activity_organiser ADD CONSTRAINT FK_711D6D4B81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_organiser ADD CONSTRAINT FK_711D6D4BA0631C12 FOREIGN KEY (organiser_id) REFERENCES organiser (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AA81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AA9D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AABA3F28B2 FOREIGN KEY (permitted_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A12469DE2');
        $this->addSql('ALTER TABLE invite DROP FOREIGN KEY FK_C7E210D79D1C3019');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D9D1C3019');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D816F52CD');
        $this->addSql('ALTER TABLE permission DROP FOREIGN KEY FK_E04992AA9D1C3019');
        $this->addSql('ALTER TABLE permission DROP FOREIGN KEY FK_E04992AABA3F28B2');
        $this->addSql('ALTER TABLE invite DROP FOREIGN KEY FK_C7E210D7D60322AC');
        $this->addSql('ALTER TABLE invite DROP FOREIGN KEY FK_C7E210D781C06096');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D81C06096');
        $this->addSql('ALTER TABLE activity_organiser DROP FOREIGN KEY FK_711D6D4B81C06096');
        $this->addSql('ALTER TABLE permission DROP FOREIGN KEY FK_E04992AA81C06096');
        $this->addSql('ALTER TABLE activity_organiser DROP FOREIGN KEY FK_711D6D4BA0631C12');
        $this->addSql('DROP TABLE venue');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE invite');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_organiser');
        $this->addSql('DROP TABLE organiser');
        $this->addSql('DROP TABLE permission');
    }
}
