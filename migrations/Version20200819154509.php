<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819154509 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bibliotheque (id INT AUTO_INCREMENT NOT NULL, num_mus_id INT DEFAULT NULL, date_achat DATE NOT NULL, INDEX IDX_4690D34D6D319670 (num_mus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bibliotheque_ouvrage (bibliotheque_id INT NOT NULL, ouvrage_id INT NOT NULL, INDEX IDX_C4865FEB4419DE7D (bibliotheque_id), INDEX IDX_C4865FEB15D884B5 (ouvrage_id), PRIMARY KEY(bibliotheque_id, ouvrage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moment (id INT AUTO_INCREMENT NOT NULL, jour DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musee (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, num_mus INT NOT NULL, nom_mus VARCHAR(255) NOT NULL, nb_livres INT NOT NULL, INDEX IDX_8884C873A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ouvrage (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, isbn INT NOT NULL, nb_page INT NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_52A8CBD8A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, code_pays VARCHAR(255) NOT NULL, nb_habitant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referencer (id INT AUTO_INCREMENT NOT NULL, isbn_id INT DEFAULT NULL, numero_page INT NOT NULL, INDEX IDX_E8191D0AAFFF1118 (isbn_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referencer_site (referencer_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_59F50F07F0D184D2 (referencer_id), INDEX IDX_59F50F07F6BD1646 (site_id), PRIMARY KEY(referencer_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, nom_site VARCHAR(255) NOT NULL, anneedecouv INT NOT NULL, INDEX IDX_694309E4A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiter (id INT AUTO_INCREMENT NOT NULL, musee_id INT NOT NULL, nbvisiteurs INT NOT NULL, INDEX IDX_300A0915D90009CE (musee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiter_moment (visiter_id INT NOT NULL, moment_id INT NOT NULL, INDEX IDX_64CD6D804DBBF6CC (visiter_id), INDEX IDX_64CD6D80ABE99143 (moment_id), PRIMARY KEY(visiter_id, moment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bibliotheque ADD CONSTRAINT FK_4690D34D6D319670 FOREIGN KEY (num_mus_id) REFERENCES musee (id)');
        $this->addSql('ALTER TABLE bibliotheque_ouvrage ADD CONSTRAINT FK_C4865FEB4419DE7D FOREIGN KEY (bibliotheque_id) REFERENCES bibliotheque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bibliotheque_ouvrage ADD CONSTRAINT FK_C4865FEB15D884B5 FOREIGN KEY (ouvrage_id) REFERENCES ouvrage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musee ADD CONSTRAINT FK_8884C873A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE ouvrage ADD CONSTRAINT FK_52A8CBD8A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE referencer ADD CONSTRAINT FK_E8191D0AAFFF1118 FOREIGN KEY (isbn_id) REFERENCES ouvrage (id)');
        $this->addSql('ALTER TABLE referencer_site ADD CONSTRAINT FK_59F50F07F0D184D2 FOREIGN KEY (referencer_id) REFERENCES referencer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE referencer_site ADD CONSTRAINT FK_59F50F07F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE visiter ADD CONSTRAINT FK_300A0915D90009CE FOREIGN KEY (musee_id) REFERENCES musee (id)');
        $this->addSql('ALTER TABLE visiter_moment ADD CONSTRAINT FK_64CD6D804DBBF6CC FOREIGN KEY (visiter_id) REFERENCES visiter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visiter_moment ADD CONSTRAINT FK_64CD6D80ABE99143 FOREIGN KEY (moment_id) REFERENCES moment (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bibliotheque_ouvrage DROP FOREIGN KEY FK_C4865FEB4419DE7D');
        $this->addSql('ALTER TABLE visiter_moment DROP FOREIGN KEY FK_64CD6D80ABE99143');
        $this->addSql('ALTER TABLE bibliotheque DROP FOREIGN KEY FK_4690D34D6D319670');
        $this->addSql('ALTER TABLE visiter DROP FOREIGN KEY FK_300A0915D90009CE');
        $this->addSql('ALTER TABLE bibliotheque_ouvrage DROP FOREIGN KEY FK_C4865FEB15D884B5');
        $this->addSql('ALTER TABLE referencer DROP FOREIGN KEY FK_E8191D0AAFFF1118');
        $this->addSql('ALTER TABLE musee DROP FOREIGN KEY FK_8884C873A6E44244');
        $this->addSql('ALTER TABLE ouvrage DROP FOREIGN KEY FK_52A8CBD8A6E44244');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4A6E44244');
        $this->addSql('ALTER TABLE referencer_site DROP FOREIGN KEY FK_59F50F07F0D184D2');
        $this->addSql('ALTER TABLE referencer_site DROP FOREIGN KEY FK_59F50F07F6BD1646');
        $this->addSql('ALTER TABLE visiter_moment DROP FOREIGN KEY FK_64CD6D804DBBF6CC');
        $this->addSql('DROP TABLE bibliotheque');
        $this->addSql('DROP TABLE bibliotheque_ouvrage');
        $this->addSql('DROP TABLE moment');
        $this->addSql('DROP TABLE musee');
        $this->addSql('DROP TABLE ouvrage');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE referencer');
        $this->addSql('DROP TABLE referencer_site');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE visiter');
        $this->addSql('DROP TABLE visiter_moment');
    }
}
