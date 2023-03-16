<?php

	namespace App\Controller;

	use App\Entity\Client;
	use App\Entity\Utilisateur;
	use App\Repository\ClientRepository;
	use App\Repository\UtilisateurRepository;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
	use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
	use Symfony\Contracts\Cache\ItemInterface;


	class UtilisateurController extends AbstractController
	{
		public const CACHE_KEY_GETALLUSERSBYCUSTOMER = "getAllUsersByCustomer";
		public const CACHE_KEY_GETALLUSERS = "getAllUsers";

		public function getRepository(): UtilisateurRepository
		{
			return $this->em->getRepository(Utilisateur::class);
		}

		/**
		 * @return JsonResponse
		 * @throws InvalidArgumentException
		 */
		#[Route('api/utilisateurs/', name:'liste_utilisateurs_par_clients', methods:['GET'])]
		public function getListUsersByCustomer(UtilisateurRepository $repository): JsonResponse
		{
			$usersList = $this->cachePool->get(self::CACHE_KEY_GETALLUSERSBYCUSTOMER,
				function (ItemInterface $item) use ($repository) {
					$item->tag('usersByCustomerCache');
					$client = $this->getUser();
					return $this->getRepository()->findByClient($client);;
				});

			$jsonListUsers = $this->serializer->serialize($usersList, 'json', ['groups' => 'getUtilisateurs']);

			return new JsonResponse($jsonListUsers, Response::HTTP_OK, [], true);
		}

		#[Route('api/utilisateurs', name:'liste_utilisateurs', methods:['GET'])]
		#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour consulter la liste des utilisateurs')]
		public function getListUsers(): JsonResponse
		{

			$usersList = $this->cachePool->get(
				self::CACHE_KEY_GETALLUSERS,
				function(ItemInterface $item) {
					$item->tag('usersCache');
					return $this->getRepository()->findAll();
				}
			);

			$jsonUsers = $this->serializer->serialize($usersList, 'json', ['groups' => 'getUtilisateurs']);

			return new JsonResponse($jsonUsers, Response::HTTP_OK, [], true);
		}

		#[Route('api/utilisateurs/{id}', name:'details_utilisateurs', methods:['GET'])]
		public function getDetailsUsers(int $id): JsonResponse
		{
			$user = $this->getRepository()->find($id);
			$jsonUser = $this->serializer->serialize($user, 'json', ['groups' => 'getUtilisateurs']);
			return new JsonResponse($jsonUser, Response::HTTP_OK, ['accept' => 'json'], true);
		}

		#[Route('api/utilisateurs', name:'ajout_utilisateurs_by_client', methods:['POST'])]
		public function postUsersByCustomer(Request $request): JsonResponse
		{
			$client = $this->getUser();

			$user = $this->serializer->deserialize(
				$request->getContent(),
				Utilisateur::class,
				'json'
			);

			if(!is_null($client)) {
					$user->setCodeClient($client->getCode());
					$user->setClient($client);
			}

			$this->em->persist($user);
			$this->em->flush();

			$jsonUser = $this->serializer->serialize(
				$user,
				'json',
				['groups' => 'getUtilisateurs']
			);

			$location = $this->urlGenerator->generate(
				'details_utilisateurs',
				['id' => $user->getId()],
				UrlGeneratorInterface::ABSOLUTE_URL
			);

			return new JsonResponse($jsonUser, Response::HTTP_CREATED, ['location' => $location], true);
		}

		#[Route('api/utilisateurs/{id}', name:'update_utilisateurs', methods:['PUT'])]
		public function putUpdateUsers(Request $request, int $id ): JsonResponse
		{
			$response = '';

			$user = $this->getRepository()->find($id);

			if(is_null($user)) {
				$response = new JsonResponse(['error' => 'Une erreur est survenue lors de la modification de l\'utilisateur'], Response::HTTP_NOT_FOUND);
			} else {
				$updateUser = $this->serializer->deserialize(
					$request->getContent(),
					Utilisateur::class,
					'json',
					[AbstractNormalizer::OBJECT_TO_POPULATE => $user]
				);

				$this->em->persist($updateUser);
				$this->em->flush();

				$response = new JsonResponse(['success' => 'Utilisateur modifié avec succès'], Response::HTTP_OK);
			}

			return $response;
		}

		#[Route('api/utilisateurs/{id}', name:'delete_utilisateurs', methods:['DELETE'])]
		public function deleteUsers(int $id): JsonResponse
		{
			$response = '';

			$user = $this->getRepository()->find($id);


			if(is_null($user)) {
				$response = new JsonResponse(['error' => 'Une erreur est survenue lors de la suppression de l\'utilisateur'], Response::HTTP_NOT_FOUND);
			} else {
				$name = $user->getName();
				$this->cachePool->invalidateTags(['usersCache', 'usersByCustomerCache']);
				$this->em->remove($user);
				$this->em->flush();

				$response = new JsonResponse(['success' => 'Utilisateur supprimé avec succès'], Response::HTTP_OK);;
			}

			return $response;
		}
	}