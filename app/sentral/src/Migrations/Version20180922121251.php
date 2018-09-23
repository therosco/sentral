<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180922121251 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE last_name last_name VARCHAR(100) DEFAULT NULL, CHANGE middle_name middle_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE invite CHANGE arrived_at arrived_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD amount NUMERIC(15, 2) NOT NULL, DROP amount_cents, CHANGE payed_by_id payed_by_id INT DEFAULT NULL, CHANGE payed_at payed_at DATETIME DEFAULT NULL');
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
        $this->addSql('ALTER TABLE payment ADD amount_cents INT NOT NULL, DROP amount, CHANGE payed_by_id payed_by_id INT DEFAULT NULL, CHANGE payed_at payed_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE permission CHANGE permitted_by_id permitted_by_id INT DEFAULT NULL, CHANGE permitted_at permitted_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE last_name last_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE middle_name middle_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
