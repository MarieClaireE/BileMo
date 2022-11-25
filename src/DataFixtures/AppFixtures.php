<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Produit;
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

		    $client = new Client();
				$client->setCodeClient('CLI12');
				$client->setRoles(["ROLE_USER"]);
				$client->setEmail('client12@bilemo.com');
		    $client->setName('CLIENT');
				$client->setFirstname('Prénom');
				$client->setPassword($this->userPasswordHasher->hashPassword($client, 'password'));
				$manager->persist($client);


	    // création d'un client 'admin'
	    $admin = new Client();
	    $admin->setCodeClient('CLI11');
	    $admin->setRoles(["ROLE_ADMIN"]);
	    $admin->setEmail('admin@bilemo.com');
	    $admin->setName('CLIENTAdmin');
	    $admin->setFirstname('Prénom');
	    $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'passwordAdmin'));
	    $manager->persist($admin);

			// creation d'une vingtaine de produit
	      for($i = 0; $i <= 20 ; $i++)  {
					$produit = new Produit();
					$produit->setName('Produit ' . $i);
					$produit->setDescription('Description du produit ' . $i);
					$produit->setPrice(100,00);

	        $manager->persist($produit);
	      }

        $manager->flush();
    }
}
