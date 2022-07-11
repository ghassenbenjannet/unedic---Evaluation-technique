<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
/**
* @ORM\Table(name="Produit")
* @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
*/
class Produit
{
    public function __construct() {}
    public function  __clone() { }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()* 
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cat;
    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $prix;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $qte;


    public function getId(): ?int
    {
    return $this->id;
    }
    public function getNom(): ?string
    {
    return $this->nom;
    }
    public function setNom(string $nom): self
    {
    $this->nom = $nom;
    return $this;
    }
    public function getCat(): ?string
    {
    return $this->cat;
    }
    public function setCat(string $cat): self
    {
    $this->cat = $cat;
    return $this;
    }
    public function getPrix(): ?string
    {
    return $this->prix;
    }
    public function setPrix(string $prix): self
    {
    $this->prix = $prix;
    return $this;
    }
    public function getQte(): ?string
    {
    return $this->qte;
    }
    public function setQte(string $qte): self
    {
    $this->qte = $qte;
    return $this;
    }

    public function __toString() {
        return$this->id;
    }
}