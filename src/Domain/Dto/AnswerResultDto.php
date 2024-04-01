<?php

declare(strict_types=1);

namespace App\Domain\Dto;

use App\Domain\Model\Answer;

class AnswerResultDto
{
    public function __construct(
        public string $text,
        public bool $isSelected,
        public bool $isCorrect,
    ) {}

    public static function fromAnswer(Answer $answer): self
    {
        return new self($answer->getText(), $answer->isSelected(), $answer->isCorrect());
    }
}