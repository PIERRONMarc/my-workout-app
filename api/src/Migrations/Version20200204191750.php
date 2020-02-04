<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200204191750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sets (id INT AUTO_INCREMENT NOT NULL, exercice_session_id INT NOT NULL, weight DOUBLE PRECISION NOT NULL, succeed TINYINT(1) NOT NULL, INDEX IDX_948D45D195499665 (exercice_session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sets ADD CONSTRAINT FK_948D45D195499665 FOREIGN KEY (exercice_session_id) REFERENCES exercice_session (id)');
        $this->addSql('ALTER TABLE exercice_session DROP weigth, DROP set_number');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sets');
        $this->addSql('ALTER TABLE exercice_session ADD weigth DOUBLE PRECISION NOT NULL, ADD set_number INT NOT NULL');
    }
}
