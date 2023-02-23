<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
	private $userPasswordHasher;

	public function __construct(
		UserPasswordHasherInterface $userPasswordHasher
	)
	{
		$this->userPasswordHasher = $userPasswordHasher;
	}
    public function load(ObjectManager $manager): void
    {
			// creation de 1 client 'normal'
	    $superClient = new Client();
	    $superClient->setCode("C02");
	    $superClient->setRoles(['ROLE_ADMIN']);
	    $superClient->setEmail('client14@bilemo.com');
	    $superClient->setFullname('CLIENT2 name');
	    $superClient->setPassword($this->userPasswordHasher->hashPassword($superClient, 'password'));
	    $manager->persist($superClient);

	    // création d'un client 'admin'
	    $admin = new Client();
	    $admin->setCode("C01");
	    $admin->setRoles(['ROLE_ADMIN']);
	    $admin->setEmail('admin@bilemo.com');
	    $admin->setFullname('CLIENTAdmin');
	    $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'passwordAdmin'));
	    $manager->persist($admin);

			// creation d'une vingtaine utilisateur
	    for ($i = 0; $i <= 20; $i++) {
		    $user = new Utilisateur();
				$user->setName("User one");
				$user->setEmail("user@bilemo.com");
				$user->setCodeClient("C01");
				$manager->persist($user);
	    }

			// creation d'une vingtaine de produit
	      for($i = 0; $i <= 20 ; $i++)  {
					$produit = new Produit();
					$produit->setName('Produit ' . $i);
					$produit->setDescription('Description du produit ' . $i);
					$produit->setPrice(100,00);
					$produit->setClient($admin);

	        $manager->persist($produit);
	      }

        $manager->flush();
    }
}
