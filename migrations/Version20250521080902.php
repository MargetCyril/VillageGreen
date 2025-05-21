<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250521080902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison ADD livrer_id INT DEFAULT NULL, ADD facture_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison ADD CONSTRAINT FK_31A531A4534C185D FOREIGN KEY (livrer_id) REFERENCES livrer (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison ADD CONSTRAINT FK_31A531A47F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_31A531A4534C185D ON bon_livraison (livrer_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_31A531A47F2DEE08 ON bon_livraison (facture_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture ADD id_panier_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture ADD CONSTRAINT FK_FE86641077482E5B FOREIGN KEY (id_panier_id) REFERENCES commande (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_FE86641077482E5B ON facture (id_panier_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE livrer DROP id_bon_livraison
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE livrer ADD id_bon_livraison VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison DROP FOREIGN KEY FK_31A531A4534C185D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison DROP FOREIGN KEY FK_31A531A47F2DEE08
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_31A531A4534C185D ON bon_livraison
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_31A531A47F2DEE08 ON bon_livraison
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison DROP livrer_id, DROP facture_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture DROP FOREIGN KEY FK_FE86641077482E5B
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_FE86641077482E5B ON facture
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture DROP id_panier_id
        SQL);
    }
}
