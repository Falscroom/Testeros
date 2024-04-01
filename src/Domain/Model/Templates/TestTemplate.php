<?php

declare(strict_types=1);

namespace App\Domain\Model\Templates;

use App\Domain\Model\Test;
use App\Persistence\Repository\Templates\TestTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

#[ORM\Entity(repositoryClass: TestTemplateRepository::class)]
class TestTemplate
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'IDENTITY'), ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private string $description;

    /** @var Collection<QuestionTemplate>  */
    #[ManyToMany(targetEntity: QuestionTemplate::class, inversedBy: 'tests')]
    #[JoinTable(name: 'template_test_question')]
    private Collection $questions;

    public function __construct() {
        $this->questions = new ArrayCollection();
    }

    public function toTest(): Test
    {
        $test = new Test($this->name, $this->description);

        foreach ($this->questions as $question) {
            $test->addQuestion($question->toQuestion($test));
        }

        return $test;
    }
}
