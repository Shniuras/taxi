<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180412114125 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE driver DROP cars, DROP trips');
        $this->addSql('ALTER TABLE trip DROP client, DROP car, DROP driver');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE driver ADD cars VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, ADD trips VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE trip ADD client VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, ADD car VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, ADD driver VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
