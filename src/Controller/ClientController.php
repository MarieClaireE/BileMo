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


	const GETALLCUSTOMERS = "getAllCustomers";

	public function getRepository(): ClientRepository
	{
		return $this->em->getRepository(Client::class);
	}

	// client
	#[Route('api/liste/clients', name:'list_clients', methods:['GET'])]
	public function getClientList(Request $request, ClientRepository $repository): JsonResponse
	{

		$customerList = $this->cachePool->get(self::GETALLCUSTOMERS, function(ItemInterface $item) {
			$item->tag('customersCache');
			return $this->getRepository()->findAll();
		});

		$jsonCustomerList = $this->serializer->serialize($customerList, 'json', ['groups' => 'getClients', 'getProduits', 'getUtilisateurs']);
		return new JsonResponse($jsonCustomerList, Response::HTTP_OK, [], true);
	}

	#[Route('api/clients/{id}', name:'details_clients', methods:['GET'])]
	public function getDetailsClient(Client $client): JsonResponse
	{
		$jsonCustomer = $this->serializer->serialize($client, 'json', ['groups' => 'getClients', 'getProduits', 'getUtilisateurs']);

		return new JsonResponse($jsonCustomer, Response::HTTP_OK, ['accept' => 'json'], true);
	}

	#[Route('api/suppression/client/{id}', name:'delete_client', methods:['DELETE'])]
	#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour supprimer un client')]
	public function deleteClient(int $id): JsonResponse
	{
		$message = '';
		$client = $this->getRepository()->find($id);

		if(is_null($client)) {
			$message = 'Ce client n\'existe pas';
		} else {
			$this->cachePool->invalidateTags(['customersCache']);
			$this->em->remove($client);
			$this->em->flush();
			$message = 'Le client ' .$client->getFullname(). 'a été supprimé ! ';
		}

		return new JsonResponse($message, Response::HTTP_OK);
	}

}