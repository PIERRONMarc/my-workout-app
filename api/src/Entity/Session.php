<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $day;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExerciceSession", mappedBy="session", orphanRemoval=true)
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

    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;

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
            $exerciceSession->setSession($this);
        }

        return $this;
    }

    public function removeExerciceSession(ExerciceSession $exerciceSession): self
    {
        if ($this->exerciceSessions->contains($exerciceSession)) {
            $this->exerciceSessions->removeElement($exerciceSession);
            // set the owning side to null (unless already changed)
            if ($exerciceSession->getSession() === $this) {
                $exerciceSession->setSession(null);
            }
        }

        return $this;
    }
}
