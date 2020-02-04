<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 * @ApiResource(
 *      normalizationContext={"groups"={"read", "get_session"}},
 *      denormalizationContext={"groups"={"write"}}
 * )
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "get_session"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"write", "read", "get_session"})
     */
    private $day;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExerciceSession", mappedBy="session", orphanRemoval=true)
     * @Groups({"read", "get_session"})
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
