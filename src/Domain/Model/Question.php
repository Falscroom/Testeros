<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Model\AnswerRules\AnswerRuleInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JsonSerializable;

#[ORM\Entity]
class Question implements JsonSerializable
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'IDENTITY'), ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column]
    private string $text;

    #[ORM\Column(nullable: true)]
    private ?bool $isAnsweredCorrectly = null;

    #[ORM\Column(type: "answer_rule")]
    private AnswerRuleInterface $answerRule;

    #[ORM\ManyToOne(targetEntity: Test::class, inversedBy: "questions")]
    private Test $test;

    /** @var Collection<Answer>  */
    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: "question", cascade: ["persist"], orphanRemoval: true)]
    private Collection $answers;

    public function __construct(string $text, Test $test, AnswerRuleInterface $answerRule)
    {
        $this->text = $text;
        $this->test = $test;
        $this->answerRule = $answerRule;
        $this->answers = new ArrayCollection();
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isAnsweredCorrectly(): ?bool
    {
        return $this->isAnsweredCorrectly;
    }

    public function addAnswer(Answer $answer): self
    {
        $this->answers->add($answer);

        return $this;
    }

    public function setAnswers(Collection $answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    /** @return Collection<Answer> */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function answer(array $answerIds): self
    {
        $this->isAnsweredCorrectly = $this->answerRule->checkAnswers($answerIds, $this);

        foreach ($this->answers as $answer) {
            if (in_array($answer->getId(), $answerIds)){
                $answer->select();
            }
        }

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'answers' => $this->answers->toArray(),
        ];
    }
}