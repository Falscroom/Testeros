<?php

declare(strict_types=1);

namespace App\Domain\Dto;

class TestIdDto
{
    public function __construct(public int $testId)
    {

    }
}