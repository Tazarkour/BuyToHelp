<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611144254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coupons (id INT AUTO_INCREMENT NOT NULL, ngo_id INT DEFAULT NULL, product_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, percentage INT NOT NULL, INDEX IDX_F5641118526B9FA3 (ngo_id), INDEX IDX_F56411184584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dealers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, link LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ngo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, link LONGTEXT NOT NULL, img VARCHAR(255) NOT NULL, cathegory VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, dealer_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, link LONGTEXT NOT NULL, INDEX IDX_D34A04AD249E6EA1 (dealer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT FK_F5641118526B9FA3 FOREIGN KEY (ngo_id) REFERENCES ngo (id)');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT FK_F56411184584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD249E6EA1 FOREIGN KEY (dealer_id) REFERENCES dealers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD249E6EA1');
        $this->addSql('ALTER TABLE coupons DROP FOREIGN KEY FK_F5641118526B9FA3');
        $this->addSql('ALTER TABLE coupons DROP FOREIGN KEY FK_F56411184584665A');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE dealers');
        $this->addSql('DROP TABLE ngo');
        $this->addSql('DROP TABLE product');
    }
}
