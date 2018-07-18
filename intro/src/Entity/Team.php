<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
     * @ORM\Column(type="string", length=255)
     */
    private $coach;

    /**
     * @ORM\Column(type="integer")
     */
    private $foundationYear;


    public function __construct($name, $coach, $yearFoundation)
    {
      $this->setName($name);
      $this->setCoach($coach);
      $this->setFoundationYear($yearFoundation);
    }

    public function getId()
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

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(string $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getFoundationYear(): ?int
    {
        return $this->foundationYear;
    }

    public function setFoundationYear(int $foundationYear): self
    {
        $this->foundationYear = $foundationYear;

        return $this;
    }
}
