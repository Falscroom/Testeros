<?php

declare(strict_types=1);

namespace App\Domain\Model\Templates;

use App\Domain\Model\AnswerRules\AnswerRuleInterface;
use App\Domain\Model\Question;
use App\Domain\Model\Test;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class QuestionTemplate
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'IDENTITY'), ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column]
    private string $text;

    #[ORM\Column(type: "answer_rule")]
    private AnswerRuleInterface $answerRule;

    #[ORM\ManyToMany(targetEntity: TestTemplate::class, mappedBy: "questions")]
    private Collection $tests;

    /** @var Collection<AnswerTemplate> $answers*/
    #[ORM\OneToMany(targetEntity: AnswerTemplate::class, mappedBy: 'question')]
    private Collection $answers;

    public function __construct() {
        $this->tests = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    public function toQuestion(Test $test): Question
    {
        $question = new Question($this->text, $test, $this->answerRule);

        foreach ($this->answers as $answer) {
            $question->addAnswer($answer->toAnswer($question));
        }

        return $question;
    }
}
