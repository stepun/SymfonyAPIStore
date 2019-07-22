<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529112912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instock DROP FOREIGN KEY FK_3CA8191F2FC0CB0F');
        $this->addSql('DROP INDEX IDX_3CA8191F2FC0CB0F ON instock');
        $this->addSql('ALTER TABLE instock DROP transaction_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instock ADD transaction_id INT NOT NULL');
        $this->addSql('ALTER TABLE instock ADD CONSTRAINT FK_3CA8191F2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id)');
        $this->addSql('CREATE INDEX IDX_3CA8191F2FC0CB0F ON instock (transaction_id)');
    }
}
