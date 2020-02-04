<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceSessionRepository")
 * @ApiResource(
 *      normalizationContext={"groups"={"get_exercice_session"}},
 *      denormalizationContext={"groups"={"post_exercice_session"}}
 * )
 */
class ExerciceSession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get_session", "get_exercice_session"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exercice", inversedBy="exerciceSessions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_session", "get_exercice_session", "post_exercice_session"})
     */
    private $exercice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="exerciceSessions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("post_exercice_session")
     */
    private $session;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sets", mappedBy="exerciceSession", orphanRemoval=true, cascade={"persist", "remove"})
     * @Groups({"get_session", "get_exercice_session", "post_exercice_session"})
     */
    private $sets;

    public function __construct()
    {
        $this->sets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExercice(): ?exercice
    {
        return $this->exercice;
    }

    public function setExercice(?exercice $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getSession(): ?session
    {
        return $this->session;
    }

    public function setSession(?session $session): self
    {
        $this->session = $session;

        return $this;
    }

    /**
     * @return Collection|Sets[]
     */
    public function getSets(): Collection
    {
        return $this->sets;
    }

    public function addSet(Sets $set): self
    {
        if (!$this->sets->contains($set)) {
            $this->sets[] = $set;
            $set->setExerciceSession($this);
        }

        return $this;
    }

    public function removeSet(Sets $set): self
    {
        if ($this->sets->contains($set)) {
            $this->sets->removeElement($set);
            // set the owning side to null (unless already changed)
            if ($set->getExerciceSession() === $this) {
                $set->setExerciceSession(null);
            }
        }

        return $this;
    }
}
