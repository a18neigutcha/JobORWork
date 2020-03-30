<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305075200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidato ADD oferta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675AFAFBF624 FOREIGN KEY (oferta_id) REFERENCES oferta (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_2867675AFAFBF624 ON candidato (oferta_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidato DROP FOREIGN KEY FK_2867675AFAFBF624');
        $this->addSql('DROP INDEX IDX_2867675AFAFBF624 ON candidato');
        $this->addSql('ALTER TABLE candidato DROP oferta_id');
    }
}
