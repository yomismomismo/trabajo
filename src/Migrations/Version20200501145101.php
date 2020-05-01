<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501145101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE productoxpedido (id INT AUTO_INCREMENT NOT NULL, id_producto_id INT NOT NULL, id_pedido_id INT NOT NULL, UNIQUE INDEX UNIQ_63D1BE926E57A479 (id_producto_id), UNIQUE INDEX UNIQ_63D1BE92C861D91D (id_pedido_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE productoxpedido ADD CONSTRAINT FK_63D1BE926E57A479 FOREIGN KEY (id_producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE productoxpedido ADD CONSTRAINT FK_63D1BE92C861D91D FOREIGN KEY (id_pedido_id) REFERENCES pedidos (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE productoxpedido');
    }
}
