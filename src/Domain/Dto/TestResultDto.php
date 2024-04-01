<?php

declare(strict_types=1);

namespace App\Domain\Dto;

use App\Domain\Model\Question;
use App\Domain\Model\Test;

class TestResultDto
{
    /** @param QuestionResultDto[] $questions */
    public function __construct(public array $questions, public int $score, public int $correctAnswers, public int $wrongAnswers) {}

    public static function fromCompletedTest(Test $test): TestResultDto
    {
        $questions = $test->getQuestions()->map(
            fn (Question $q): QuestionResultDto => QuestionResultDto::fromQuestion($q)
        );

        $correctAnswers = 0;
        foreach ($questions as $question) {
            $correctAnswers += $question->isAnsweredCorrectly;
        }

        $score = (int) (100 * $correctAnswers)/$test->getQuestions()->count();
        $wrongAnswers = $test->getQuestions()->count() - $correctAnswers;

        return new self($questions->toArray(), $score, $correctAnswers, $wrongAnswers);
    }
}