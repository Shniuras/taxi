<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416103447 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car_driver (car_id INT NOT NULL, driver_id INT NOT NULL, INDEX IDX_90E902BC3C6F69F (car_id), INDEX IDX_90E902BC3423909 (driver_id), PRIMARY KEY(car_id, driver_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_driver ADD CONSTRAINT FK_90E902BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_driver ADD CONSTRAINT FK_90E902BC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clients ADD trips_id INT NOT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E746C2C0C FOREIGN KEY (trips_id) REFERENCES trip (id)');
        $this->addSql('CREATE INDEX IDX_C82E746C2C0C ON clients (trips_id)');
        $this->addSql('ALTER TABLE trip ADD car_id INT NOT NULL, ADD driver_id INT NOT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('CREATE INDEX IDX_7656F53BC3C6F69F ON trip (car_id)');
        $this->addSql('CREATE INDEX IDX_7656F53BC3423909 ON trip (driver_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE car_driver');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E746C2C0C');
        $this->addSql('DROP INDEX IDX_C82E746C2C0C ON clients');
        $this->addSql('ALTER TABLE clients DROP trips_id');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3C6F69F');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3423909');
        $this->addSql('DROP INDEX IDX_7656F53BC3C6F69F ON trip');
        $this->addSql('DROP INDEX IDX_7656F53BC3423909 ON trip');
        $this->addSql('ALTER TABLE trip DROP car_id, DROP driver_id');
    }
}
