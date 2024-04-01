<?php

declare(strict_types=1);

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity]
class Answer implements JsonSerializable
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'IDENTITY'), ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column]
    private string $text;

    #[ORM\Column]
    private bool $isCorrect;

    #[ORM\Column]
    private bool $isSelected = false;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: "answers")]
    #[ORM\JoinColumn(name: "question_id", referencedColumnName: "id")]
    private Question $question;

    public function __construct(string $text, bool $isCorrect, Question $question)
    {
        $this->text = $text;
        $this->isCorrect = $isCorrect;
        $this->question = $question;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function isSelected(): bool
    {
        return $this->isSelected;
    }

    public function select(): self
    {
        $this->isSelected = true;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
        ];
    }
}