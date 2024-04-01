<?php

declare(strict_types=1);

namespace App\Presentation\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class AnswerIdsDto
{
    public function __construct(
        #[Assert\All([
            new Assert\Type(
                type: 'integer',
                message: 'Each answer ID must be an integer.'
            )
        ])]
        public array $answerIds,
    ) {}
}