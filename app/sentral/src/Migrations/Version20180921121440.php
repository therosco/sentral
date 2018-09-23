<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180921121440 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(100) NOT NULL, ADD last_name VARCHAR(100) DEFAULT NULL, ADD middle_name VARCHAR(100) DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE invite CHANGE arrived_at arrived_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE payment CHANGE payed_by_id payed_by_id INT DEFAULT NULL, CHANGE payed_at payed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE activity CHANGE start_date start_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE organiser CHANGE phone phone VARCHAR(25) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE web web VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE permission CHANGE permitted_by_id permitted_by_id INT DEFAULT NULL, CHANGE permitted_at permitted_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity CHANGE start_date start_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE invite CHANGE arrived_at arrived_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE organiser CHANGE phone phone VARCHAR(25) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE web web VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE payment CHANGE payed_by_id payed_by_id INT DEFAULT NULL, CHANGE payed_at payed_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE permission CHANGE permitted_by_id permitted_by_id INT DEFAULT NULL, CHANGE permitted_at permitted_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user DROP first_name, DROP last_name, DROP middle_name, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
