<?php

declare(strict_types=1);

namespace App\Domain\Model\Templates;

use App\Domain\Model\Answer;
use App\Domain\Model\Question;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AnswerTemplate
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'IDENTITY'), ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column]
    private string $text;

    #[ORM\Column]
    private bool $isCorrect;

    #[ORM\ManyToOne(targetEntity: QuestionTemplate::class, inversedBy: "answers")]
    private QuestionTemplate $question;

    public function toAnswer(Question $question): Answer
    {
        return new Answer($this->text, $this->isCorrect, $question);
    }
}