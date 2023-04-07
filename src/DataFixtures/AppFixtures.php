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
	    // création d'un client 'admin'
	    $admin = new Client();
	    $admin->setCode("C01");
	    $admin->setRoles(['ROLE_ADMIN']);
	    $admin->setEmail('admin@bilemo.com');
	    $admin->setFullname('CLIENTAdmin');
	    $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'passwordAdmin'));
	    $manager->persist($admin);

			// création d'un client
	    $customer = new Client();
	    $customer->setCode("C02");
	    $customer->setRoles(['ROLE_USER']);
	    $customer->setEmail('customer@bilemo.com');
	    $customer->setFullname('CLIENTClient');
	    $customer->setPassword($this->userPasswordHasher->hashPassword($customer, 'passwordClient'));
	    $manager->persist($customer);

			// creation d'une vingtaine utilisateur
	    for ($i = 0; $i <= 20; $i++) {
		    $user = new Utilisateur();
				$user->setName("User one");
				$user->setEmail("user.$i@bilemo.com");
				$user->setCodeClient($admin->getCode());
				$user->setClient($admin);
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
