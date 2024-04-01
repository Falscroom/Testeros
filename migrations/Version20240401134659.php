<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240401134659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO question_template (id, text, answer_rule) VALUES
            (1, '1 + 1 = ', 'without_wrong'),
            (2, '2 + 2 = ', 'without_wrong'),
            (3, '3 + 3 = ', 'without_wrong'),
            (4, '4 + 4 = ', 'without_wrong'),
            (5, '5 + 5 = ', 'without_wrong'),
            (6, '6 + 6 = ', 'without_wrong'),
            (7, '7 + 7 = ', 'without_wrong'),
            (8, '8 + 8 = ', 'without_wrong'),
            (9, '9 + 9 = ', 'without_wrong'),
            (10, '10 + 10 = ', 'without_wrong');
        ");

        $this->addSql("INSERT INTO answer_template (question_id, text, is_correct) VALUES
            (1, '3', FALSE),
            (1, '2', TRUE),
            (1, '0', FALSE),
    
            (2, '4', TRUE),
            (2, '3 + 1', TRUE),
            (2, '10', FALSE),
    
            (3, '1 + 5', TRUE),
            (3, '1', FALSE),
            (3, '6', TRUE),
            (3, '2 + 4', TRUE),
    
            (4, '8', TRUE),
            (4, '4', FALSE),
            (4, '0', FALSE),
            (4, '0 + 8', TRUE),
    
            (5, '6', FALSE),
            (5, '18', FALSE),
            (5, '10', TRUE),
            (5, '9', FALSE),
            (5, '0', FALSE),
    
            (6, '3', FALSE),
            (6, '9', FALSE),
            (6, '0', FALSE),
            (6, '12', TRUE),
            (6, '5 + 7', TRUE),
    
            (7, '5', FALSE),
            (7, '14', TRUE),
    
            (8, '16', TRUE),
            (8, '12', FALSE),
            (8, '9', FALSE),
            (8, '5', FALSE),
    
            (9, '18', TRUE),
            (9, '9', FALSE),
            (9, '17 + 1', TRUE),
            (9, '2 + 16', TRUE),
    
            (10, '0', FALSE),
            (10, '2', FALSE),
            (10, '8', FALSE),
            (10, '20', TRUE)
        ");

        $this->addSql("INSERT INTO test_template (id, name, description) VALUES
            (1, 'Simple math test', 'example of a test')
        ");

        $this->addSql("INSERT INTO template_test_question (test_template_id, question_template_id) VALUES
            (1, 1),
            (1, 2),
            (1, 3),
            (1, 4),
            (1, 5),
            (1, 6),
            (1, 7),
            (1, 8),
            (1, 9),
            (1, 10)
        ");
    }
}
