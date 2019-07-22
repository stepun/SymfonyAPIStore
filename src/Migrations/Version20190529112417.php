<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529112417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instock (id INT AUTO_INCREMENT NOT NULL, storage_id INT NOT NULL, product_id INT NOT NULL, transaction_id INT NOT NULL, balance NUMERIC(10, 2) NOT NULL, INDEX IDX_3CA8191F5CC5DB90 (storage_id), INDEX IDX_3CA8191F4584665A (product_id), INDEX IDX_3CA8191F2FC0CB0F (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, operation_id INT NOT NULL, instock_id INT NOT NULL, document_date DATE NOT NULL, document_number VARCHAR(50) NOT NULL, INDEX IDX_723705D144AC3583 (operation_id), INDEX IDX_723705D13236A383 (instock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE storage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instock ADD CONSTRAINT FK_3CA8191F5CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id)');
        $this->addSql('ALTER TABLE instock ADD CONSTRAINT FK_3CA8191F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE instock ADD CONSTRAINT FK_3CA8191F2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D144AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D13236A383 FOREIGN KEY (instock_id) REFERENCES instock (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D144AC3583');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D13236A383');
        $this->addSql('ALTER TABLE instock DROP FOREIGN KEY FK_3CA8191F2FC0CB0F');
        $this->addSql('ALTER TABLE instock DROP FOREIGN KEY FK_3CA8191F5CC5DB90');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE instock');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE storage');
    }
}
