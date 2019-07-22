<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529171145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D13236A383');
        $this->addSql('DROP INDEX IDX_723705D13236A383 ON transaction');
        $this->addSql('ALTER TABLE transaction CHANGE instock_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D14584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_723705D14584665A ON transaction (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D14584665A');
        $this->addSql('DROP INDEX IDX_723705D14584665A ON transaction');
        $this->addSql('ALTER TABLE transaction CHANGE product_id instock_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D13236A383 FOREIGN KEY (instock_id) REFERENCES instock (id)');
        $this->addSql('CREATE INDEX IDX_723705D13236A383 ON transaction (instock_id)');
    }
}
