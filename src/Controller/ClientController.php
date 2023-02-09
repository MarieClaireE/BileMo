<?php

	namespace App\Controller;

	use App\Entity\Client;
	use App\Repository\ClientRepository;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
	public function getClientList(Request $request, ClientRepository $repository): JsonResponse
	{
		$idCache = "getAllCustomers";

		$customerList = $this->cachePool->get($idCache, function(ItemInterface $item) {
			$item->tag('customersCache');
			return $this->getRepository()->findAll();
		});

		$jsonCustomerList = $this->serializer->serialize($customerList, 'json', ['groups' => 'getClients']);
		return new JsonResponse($jsonCustomerList, Response::HTTP_OK, [], true);
	}

	#[Route('api/clients/{id}', name:'details_clients', methods:['GET'])]
	public function getDetailsClient(Client $client): JsonResponse
	{
		$jsonCustomer = $this->serializer->serialize($client, 'json', ['group' => 'getClients']);

		return new JsonResponse($jsonCustomer, Response::HTTP_OK, ['accept' => 'json'], true);
	}

	#[Route('api/suppression/client/{id}', name:'delete_client', methods:['DELETE'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour accéder à la liste des clients')]
	public function deleteClient(Client $client): JsonResponse
	{
		$this->cachePool->invalidateTags(['getAllCustomers']);
		$this->em->remove($client);
		$this->em->flush();

		return new JsonResponse(null, Response::HTTP_NO_CONTENT);
	}

}