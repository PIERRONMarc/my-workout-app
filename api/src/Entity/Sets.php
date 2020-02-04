<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SetsRepository")
 */
class Sets
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"get_session", "get_exercice_session", "post_exercice_session"})
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"get_session", "get_exercice_session", "post_exercice_session"})
     */
    private $succeed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ExerciceSession", inversedBy="sets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exerciceSession;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSucceed(): ?bool
    {
        return $this->succeed;
    }

    public function setSucceed(bool $succeed): self
    {
        $this->succeed = $succeed;

        return $this;
    }

    public function getExerciceSession(): ?ExerciceSession
    {
        return $this->exerciceSession;
    }

    public function setExerciceSession(?ExerciceSession $exerciceSession): self
    {
        $this->exerciceSession = $exerciceSession;

        return $this;
    }
}
