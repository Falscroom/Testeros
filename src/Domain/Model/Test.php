<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Persistence\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'IDENTITY'), ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private string $description;

    #[ORM\Column]
    private int $currentQuestion = 0;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $user = null;

    //status?

    /** @var Collection<Question>  */
    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: "test", cascade: ["persist"], orphanRemoval: true)]
    private Collection $questions;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->questions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addQuestion(Question $question): self
    {
        $this->questions->add($question);

        return $this;
    }

    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function shuffle(): self
    {
        /** @var Question[] $questions */
        $questions = $this->questions->toArray();
        shuffle($questions);

        foreach ($questions as $question) {
            $answers = $question->getAnswers()->toArray();
            shuffle($answers);
            $question->setAnswers(new ArrayCollection($answers));
        }

        $this->questions = new ArrayCollection($questions);

        return $this;
    }

    public function answerCurrentQuestion(array $answerIds): void
    {
        /** @var Question $question */
        $question = $this->questions->get($this->currentQuestion);
        $question?->answer($answerIds);
    }

    public function getCurrentQuestion(): ?Question
    {
        return $this->questions->get($this->currentQuestion);
    }

    public function isFinished(): bool
    {
        return $this->questions->count() <= $this->currentQuestion;
    }

    public function nextQuestion(): ?Question
    {
        if (!$this->isFinished()) {
            $this->currentQuestion++;
        }

        return $this->questions->get($this->currentQuestion);
    }
}