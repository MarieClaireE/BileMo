<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]

/**
 * @Serializer\XmlRoot("utilisateur")
 * @Hateoas\Relation("list", href="expr('/api/utilisateurs/')")
 * @Hateoas\Relation("self", href="expr('/api/utilisateurs/' ~ object.getId())")
 */
class Utilisateur
{
		#[Serializer\XmlAttribute]
		#[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getClients", "getProduits", "getUtilisateurs"])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["getClients", "getProduits", "getUtilisateurs"])]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(["getClients", "getProduits", "getUtilisateurs"])]
    private ?string $email = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Groups(["getClients", "getProduits", "getUtlisateurs"])]
    private ?string $codeClient = null;

		/** @Serializer\Exclude  */
		#[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCodeClient(): ?string
    {
        return $this->codeClient;
    }

    public function setCodeClient(?string $codeClient): self
    {
        $this->codeClient = $codeClient;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
