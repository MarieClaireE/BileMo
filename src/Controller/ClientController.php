<?php

	namespace App\Controller;

	use App\Entity\Client;
	use App\Repository\ClientRepository;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
	use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
	use Symfony\Contracts\Cache\ItemInterface;


	class ClientController extends AbstractController
{
	public function getRepository(): ClientRepository
	{
		return $this->em->getRepository(Client::class);
	}

	// client
	#[Route('api/liste/clients', name:'list_clients', methods:['GET'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour accéder à la liste des clients')]
	public function getClientList(Request $request, ClientRepository $repository): JsonResponse
	{
		$customerList = $this->getRepository()->findAll();
		$jsonCustomerList = $this->serializer->serialize($customerList, 'json', ['groups' => 'getClients']);
		return new JsonResponse($jsonCustomerList, Response::HTTP_OK, [], true);
	}

	#[Route('api/clients/{id}', name:'details_clients', methods:['GET'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour accéder à la liste des clients')]
	public function getDetailsClient(Client $client): JsonResponse
	{
		$jsonCustomer = $this->serializer->serialize($client, 'json', ['group' => 'getClients']);

		return new JsonResponse($jsonCustomer, Response::HTTP_OK, ['accept' => 'json'], true);
	}

	#[Route('api/clients/', name:'creation_client', methods:['POST'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour accéder à la liste des clients')]
	public function postclient()
	{}

	#[Route('api/suppression/client/{id}', name:'delete_client', methods:['DELETE'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour accéder à la liste des clients')]
	public function deleteClient(Client $client): JsonResponse
	{
		$this->em->remove($client);
		$this->em->flush();

		return new JsonResponse(null, Response::HTTP_NO_CONTENT);
	}

	// utilisateur
	#[Route('api/liste/utilisateurs/by/{email}', name:'liste_utilisateurs_by_client', methods:['GET'])]
	public function getlistusersbycustomer(Request $request, string $email): JsonResponse
	{
		$email = $request->attributes->get('email');
		$client = $this->getRepository()->findOneBy(['email' => $email]);

		$users = $this->getRepository()->findBy(['parent' => $client->getId()]);

		$jsonUsers = $this->serializer->serialize($users, 'json', ['groups' => 'getClients']);

		return new JsonResponse($jsonUsers, Response::HTTP_OK, [], true);
	}

	#[Route('api/liste/utilisateurs', name:'liste_utilisateurs', methods:['GET'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\’avez pas les droits requis pour accéder à la liste des utilisateurs')]
	public function getlistUsers(Request $request): JsonResponse
	{
		$users = $this->getRepository()->getUsers();
		$jsonUsers = $this->serializer->serialize($users, 'json', ['groups' => 'getClients']);

		return new JsonResponse($jsonUsers, Response::HTTP_OK, [], true);
	}

	#[Route('api/detail/utilisateurs/{id}/by/{email}', name:'details_utilisateurs', methods:['GET'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\’avez pas les droits requis pour accéder à la liste des utilisateurs')]
	public function getDetailsUser(Request $request, int $id, string $email): JsonResponse
	{
		$client = $this->getRepository()->findOneBy(['email' => $email]);
		$user = $this->getRepository()->findOneBy(['id' => $id, 'parent' => $client->getId()]);

		$jsonUser = $this->serializer->serialize($user, 'json', ['groups' => 'getClients']);

		return new JsonResponse($jsonUser, Response::HTTP_OK, ['accept'=> 'json', true]);
	}


	#[Route('api/create/utilisateurs/by/{email}', name:'ajout_utilisateur', methods:['POST'])]
	#[isGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour ajouter un utilisateur')]
	public function postAddUsers(Request $request, string $email): JsonResponse
	{

		$client = $this->getRepository()->findOneBy(['email' => $email]);

		$user = $this->serializer->deserialize(
			$request->getContent(),
			Client::class,
			'json'
		);
		$content = $request->getContent();
		$clientId = $content['parent'] ?? -1;

		if($clientId === $client->getId()) {
			$user->setParent($this->getRepository()->find($clientId));
		}

		$this->em->persist($user);
		$this->em->flush();

		$jsonUser = $this->serializer->serialize(
			$user,
			'json',
			['groups' => 'getClients']
		);

		$location = $this->urlGenerator->generate(
			'details_utilisateurs',
			['id' => $user->getId()],
			UrlGeneratorInterface::ABSOLUTE_URL
		);

		return new JsonResponse(
			$jsonUser,
			Response::HTTP_CREATED,
			['location' => $location],
			true
		);
	}

	#[Route('api/suppression/utilisateur/{id}/by/{email}', name:'suppression_utilisateur', methods:['DELETE'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droit requis pour supprimer cet utilisateur')]
	public function deleteUser(Request $request, int $id, string $email): JsonResponse
	{
		$message = '';

		$client = $this->getRepository()->findOneBy(['email' => $email]);

		$user = $this->getRepository()->findOneBy(['id' => $id, 'parent' => $client->getId()]);

		if($user === null) {
			$message = 'Vous ne pouvez pas supprimer cet utilisateur';
		} else {
			$this->em->remove($user);
			$this->em->flush();
			$message = 'Utilisateur ' .$user->getFullname().' a été supprimé';
		}

		return new JsonResponse($message, JsonResponse::HTTP_OK);
	}
}