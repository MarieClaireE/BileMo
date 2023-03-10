<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
/**
 * @ApiResource(
 *   security="is_granted('ROLE_USER')
 *   itemOperations={
 *      "get" = {"security" = "is_granted('ROLE_USER') and object == client"}
 *   },
 *   collectionOperations={
 *       "get",
 *       "post" = {
 *            "security" = "is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *        },
 *        "login" = {
 *            "security" = "is_granted('IS_AUTHENTICATED_ANONYMOUSLY')
 *            "route_name" = "api_login_check"
 *            "method" = "POST"
 *            "openapi_context" = {
 *                 "summary" = "Login method",
 *                 "requestBody" = {
 *                     "description" = "Get token",
 *                     "content" = {
 *                         "application/json" = {
 *                             "schema" = {
 *                                 "type" = "object",
 *                                 "required" = {
 *                                     "username",
 *                                     "password"
 *                                 },
 *                                 "properties" = {
 *                                     "username" = {
 *                                         "type" = "string"
 *                                     },
 *                                     "password" = {
 *                                         "type" = "string"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *          }
 * )
 */
class Client implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getClients", "getProduits", "getUtilisateurs"])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(["getClients", "getProduits", "getUtilisateurs"])]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(["getClients", "getProduits", "getUtilisateurs"])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 10, nullable:true)]
    private ?string $code = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $fullname = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Produit::class)]
    private Collection $produits;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Utilisateur::class)]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

		/**
		 * Méthode getUsername qui permet de retourner le champ qui est utilisé pour l'authentification.
		 *
		 * @return string
		 */
		public function getUsername(): string {
			return $this->getUserIdentifier();
		}

  public function getCode(): ?string
  {
      return $this->code;
  }

  public function setCode(string $code): self
  {
      $this->code = $code;

      return $this;
  }

  public function getFullname(): ?string
  {
      return $this->fullname;
  }

  public function setFullname(?string $fullname): self
  {
      $this->fullname = $fullname;

      return $this;
  }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setClient($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getClient() === $this) {
                $produit->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setClient($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getClient() === $this) {
                $utilisateur->setClient(null);
            }
        }

        return $this;
    }
}
