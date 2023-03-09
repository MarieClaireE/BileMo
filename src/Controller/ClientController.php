<?php

	namespace App\Controller;

	use App\Entity\Client;
	use App\Repository\ClientRepository;
	use Psr\Cache\InvalidArgumentException;
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
				public const CACHE_KEY_GETALLCUSTOMERS = "getAllCustomers";

				public function getRepository(): ClientRepository
	{
		return $this->em->getRepository(Client::class);
	}

				/**
				 * @return JsonResponse
				 * @throws InvalidArgumentException
				 */
				#[Route('api/clients/', name:'list_clients', methods:['GET'])]
				public function getClientList(): JsonResponse
					{
						$customerList = $this->cachePool->get (self::CACHE_KEY_GETALLCUSTOMERS, function (ItemInterface $item) {
							$item->tag ('customersCache');
							return $this->getRepository ()->findAll();
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

				#[Route('api/clients/', name:'delete_client', methods:['DELETE'])]
				#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour accéder à la liste des clients')]
				public function deleteClient(): JsonResponse
				{
					$response = '';
					$client = $this->getUser();
					if(is_null($client)) {
						$response = new JsonResponse(['error'=>'Une erreur est survenue lors de la suppression'], Response::HTTP_NOT_FOUND);
					} else {
						$this->cachePool->invalidateTags(['customersCache']);
						$this->em->remove($client);
						$this->em->flush();
						$response = new JsonResponse(['success' => 'Client supprimé avec succès'], Response::HTTP_OK);
					}

			return $response;
		}
	}