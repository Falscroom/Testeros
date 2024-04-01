<?php

declare(strict_types=1);

namespace App\Domain\Dto;

use App\Domain\Model\Answer;
use App\Domain\Model\Question;

class QuestionResultDto
{
    /** @param AnswerResultDto[] $answers */
    public function __construct(
        public string $text,
        public ?bool $isAnsweredCorrectly,
        public array $answers,
    ) {}

    public static function fromQuestion(Question $question): self
    {
        $answers = $question->getAnswers()->map(fn (Answer $a): AnswerResultDto => AnswerResultDto::fromAnswer($a));

        return new self($question->getText(), $question->isAnsweredCorrectly(), $answers->toArray());
    }
}