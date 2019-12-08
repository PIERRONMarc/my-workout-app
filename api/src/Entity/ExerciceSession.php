<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceSessionRepository")
 */
class ExerciceSession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $weigth;

    /**
     * @ORM\Column(type="integer")
     */
    private $setNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exercice", inversedBy="exerciceSessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exercice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="exerciceSessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeigth(): ?float
    {
        return $this->weigth;
    }

    public function setWeigth(float $weigth): self
    {
        $this->weigth = $weigth;

        return $this;
    }

    public function getSetNumber(): ?int
    {
        return $this->setNumber;
    }

    public function setSetNumber(int $setNumber): self
    {
        $this->setNumber = $setNumber;

        return $this;
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
}
