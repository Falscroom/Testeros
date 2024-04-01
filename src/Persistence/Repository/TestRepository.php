<?php

declare(strict_types=1);

namespace App\Persistence\Repository;

use App\Domain\Model\Templates\TestTemplate;
use App\Domain\Model\Test;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Test>
 *
 * @method null|Test find($id, $lockMode = null, $lockVersion = null)
 * @method null|Test findOneBy(array $criteria, array $orderBy = null)
 * @method Test[] findAll()
 * @method Test[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    public function save(Test $test): void
    {
        $this->getEntityManager()->persist($test);
        $this->getEntityManager()->flush();
    }
}