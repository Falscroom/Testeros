<?php

declare(strict_types=1);

namespace App\Domain\Model\AnswerRules;

use App\Domain\Model\Question;

class WithoutWrongAnswerRule implements AnswerRuleInterface
{
    public function checkAnswers(array $answerIds, Question $question): bool
    {
        if (empty($answerIds)) {
            return false;
        }

        $mappedAnswers = [];
        foreach ($question->getAnswers() as $answer) {
            $mappedAnswers[$answer->getId()] = $answer;
        }

        foreach ($answerIds as $answerId) {
            if (!isset($mappedAnswers[$answerId]) || !$mappedAnswers[$answerId]->isCorrect()) {
                return false;
            }
        }

        return true;
    }
}