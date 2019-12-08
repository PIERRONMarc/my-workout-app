<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceRepository")
 * @ApiResource
 */
class Exercice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExerciceSession", mappedBy="exercice")
     */
    private $exerciceSessions;

    public function __construct()
    {
        $this->exerciceSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ExerciceSession[]
     */
    public function getExerciceSessions(): Collection
    {
        return $this->exerciceSessions;
    }

    public function addExerciceSession(ExerciceSession $exerciceSession): self
    {
        if (!$this->exerciceSessions->contains($exerciceSession)) {
            $this->exerciceSessions[] = $exerciceSession;
            $exerciceSession->setExercice($this);
        }

        return $this;
    }

    public function removeExerciceSession(ExerciceSession $exerciceSession): self
    {
        if ($this->exerciceSessions->contains($exerciceSession)) {
            $this->exerciceSessions->removeElement($exerciceSession);
            // set the owning side to null (unless already changed)
            if ($exerciceSession->getExercice() === $this) {
                $exerciceSession->setExercice(null);
            }
        }

        return $this;
    }
}
