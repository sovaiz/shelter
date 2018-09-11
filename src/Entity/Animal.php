<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */
class Animal
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="integer")
   */
  private $kindName;

  /**
   * @ORM\Column(type="string", length=127)
   */
  private $sobriquet;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $dateOfPlacement;

  /**
   * @ORM\Column(type="datetime")
   */
  private $dateOfCreation;

  /**
   * @ORM\Column(type="datetime")
   */
  private $dateOfChange;


  public function __construct()
  {
    $currentDate = new \DateTime("NOW");

    $this->dateOfCreation = $currentDate;
    $this->dateOfChange   = $currentDate;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getKindName(): ?int
  {
    return $this->kindName;
  }

  public function setKindName(int $kindName): self
  {
    $this->kindName = $kindName;

    return $this;
  }

  public function getSobriquet(): ?string
  {
    return $this->sobriquet;
  }

  public function setSobriquet(string $sobriquet): self
  {
    $this->sobriquet = $sobriquet;

    return $this;
  }

  public function getDateOfPlacement(): ?\DateTimeInterface
  {
    return $this->dateOfPlacement;
  }

  public function setDateOfPlacement(?\DateTimeInterface $dateOfPlacement): self
  {
    $this->dateOfPlacement = $dateOfPlacement;

    return $this;
  }

  public function getDateOfCreation(): ?\DateTimeInterface
  {
    return $this->dateOfCreation;
  }

  public function setDateOfCreation(\DateTimeInterface $dateOfCreation): self
  {
    $this->dateOfCreation = $dateOfCreation;

    return $this;
  }

  public function getDateOfChange(): ?\DateTimeInterface
  {
    return $this->dateOfChange;
  }

  public function setDateOfChange(\DateTimeInterface $dateOfChange): self
  {
    $this->dateOfChange = $dateOfChange;

    return $this;
  }
}
