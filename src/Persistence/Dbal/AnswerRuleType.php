<?php

declare(strict_types=1);

namespace App\Persistence\Dbal;

use App\Domain\Model\AnswerRules\WithoutWrongAnswerRule;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use LogicException;

class AnswerRuleType extends StringType
{
    public const DB_CLASS_MAP = [
        'without_wrong' => WithoutWrongAnswerRule::class,
    ];

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!isset(self::DB_CLASS_MAP[$value])) {
            throw new LogicException('Answer rule type not exist, dont forget to update map.');
        }

        $className = self::DB_CLASS_MAP[$value];
        return new $className();
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $flippedMap = array_flip(self::DB_CLASS_MAP);

        if (!isset($flippedMap[$value::class])) {
            throw new LogicException('Answer rule type not exist, dont forget to update map.');
        }

        return $flippedMap[$value::class];
    }

    public function getName():string
    {
        return 'answer_rule';
    }
}