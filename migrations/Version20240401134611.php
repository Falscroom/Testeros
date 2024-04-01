<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240401134611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id SERIAL NOT NULL, question_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, is_correct BOOLEAN NOT NULL, is_selected BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE answer_template (id SERIAL NOT NULL, question_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B02A1EE61E27F6BF ON answer_template (question_id)');
        $this->addSql('CREATE TABLE question (id SERIAL NOT NULL, test_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, is_answered_correctly BOOLEAN DEFAULT NULL, answer_rule VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E1E5D0459 ON question (test_id)');
        $this->addSql('CREATE TABLE question_template (id SERIAL NOT NULL, text VARCHAR(255) NOT NULL, answer_rule VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE test (id SERIAL NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, current_question INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D87F7E0CA76ED395 ON test (user_id)');
        $this->addSql('CREATE TABLE test_template (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE template_test_question (test_template_id INT NOT NULL, question_template_id INT NOT NULL, PRIMARY KEY(test_template_id, question_template_id))');
        $this->addSql('CREATE INDEX IDX_38DF333F5AA4B406 ON template_test_question (test_template_id)');
        $this->addSql('CREATE INDEX IDX_38DF333FE6DED035 ON template_test_question (question_template_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_template ADD CONSTRAINT FK_B02A1EE61E27F6BF FOREIGN KEY (question_id) REFERENCES question_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE template_test_question ADD CONSTRAINT FK_38DF333F5AA4B406 FOREIGN KEY (test_template_id) REFERENCES test_template (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE template_test_question ADD CONSTRAINT FK_38DF333FE6DED035 FOREIGN KEY (question_template_id) REFERENCES question_template (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer_template DROP CONSTRAINT FK_B02A1EE61E27F6BF');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E1E5D0459');
        $this->addSql('ALTER TABLE test DROP CONSTRAINT FK_D87F7E0CA76ED395');
        $this->addSql('ALTER TABLE template_test_question DROP CONSTRAINT FK_38DF333F5AA4B406');
        $this->addSql('ALTER TABLE template_test_question DROP CONSTRAINT FK_38DF333FE6DED035');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE answer_template');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_template');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE test_template');
        $this->addSql('DROP TABLE template_test_question');
        $this->addSql('DROP TABLE "user"');
    }
}
