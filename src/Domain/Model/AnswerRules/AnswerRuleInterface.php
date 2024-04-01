<?php

namespace App\Domain\Model\AnswerRules;

use App\Domain\Model\Question;

interface AnswerRuleInterface
{
    public function checkAnswers(array $answerIds, Question $question): bool;
}