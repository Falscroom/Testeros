<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Domain\Model\Test;
use App\Domain\Service\TestService;
use App\Presentation\Dto\AnswerIdsDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class TestController extends AbstractController
{
    public function __construct(private readonly TestService $service) {}

    #[Route('/start', methods: ['POST'])]
    public function newTest(): JsonResponse
    {
        return new JsonResponse($this->service->newTest());
    }

    #[Route('/{id}/answer', methods: ['PATCH'])]
    public function answer(Test $test, #[MapRequestPayload] AnswerIdsDto $answerIdsDto): JsonResponse
    {
        return new JsonResponse($this->service->answer($test, $answerIdsDto->answerIds));
    }

    #[Route('/{id}/current', methods: ['GET'])]
    public function current(Test $test): JsonResponse
    {
        return new JsonResponse($test->getCurrentQuestion());
    }

    #[Route('/{id}/results', methods: ['GET'])]
    public function results(Test $test): JsonResponse
    {
        if (!$test->isFinished()) {
            return new JsonResponse(status: 204);
        }

        return new JsonResponse($this->service->result($test));
    }
}
