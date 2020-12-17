<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123185916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_categories_articles (articles_id INT NOT NULL, categories_articles_id INT NOT NULL, INDEX IDX_C9B60CE01EBAF6CC (articles_id), INDEX IDX_C9B60CE010C0F0BE (categories_articles_id), PRIMARY KEY(articles_id, categories_articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_categories_articles ADD CONSTRAINT FK_C9B60CE01EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_categories_articles ADD CONSTRAINT FK_C9B60CE010C0F0BE FOREIGN KEY (categories_articles_id) REFERENCES categories_articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE articles_categories_articles');
    }
}
