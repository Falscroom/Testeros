<?php

declare(strict_types=1);

namespace App\Domain\Service;


use App\Domain\Dto\TestIdDto;
use App\Domain\Dto\TestResultDto;
use App\Domain\Model\Question;
use App\Domain\Model\Test;
use App\Persistence\Repository\Templates\TestTemplateRepository;
use App\Persistence\Repository\TestRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

readonly class TestService
{
    public function __construct(
        private TestTemplateRepository $templateRepository,
        private TestRepository $testRepository,
    ) {}

    public function newTest(): TestIdDto
    {
        $testTemplate = $this->templateRepository->find(1); //TODO rewrite b4 release
        $test = $testTemplate->toTest()->shuffle();

        $this->testRepository->save($test);

        return new TestIdDto($test->getId());
    }

    public function answer(Test $test, array $answerIds): ?Question
    {
        $test->answerCurrentQuestion($answerIds);
        $nextQuestion = $test->nextQuestion();

        $this->testRepository->save($test);

        return $nextQuestion;
    }

    public function result(Test $test): TestResultDto
    {
        return TestResultDto::fromCompletedTest($test);
    }
}
