<?php

declare(strict_types=1);

namespace App\Persistence\Repository\Templates;

use App\Domain\Model\Templates\TestTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestTemplate>
 *
 * @method null|TestTemplate find($id, $lockMode = null, $lockVersion = null)
 * @method null|TestTemplate findOneBy(array $criteria, array $orderBy = null)
 * @method TestTemplate[] findAll()
 * @method TestTemplate[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestTemplateRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestTemplate::class);
    }
}