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
		const GETALLUSERSBYCUSTOMER = "getAllUsersByCustomer";
		const GETALLUSERS = "getAllUsers";

		public function getRepository(): UtilisateurRepository
		{
			return $this->em->getRepository(Utilisateur::class);
		}

		#[Route('api/liste/utilisateurs/by/{email}', name:'liste_utilisateurs_par_clients', methods:['GET'])]
		public function getListUsersByCustomer(Request $request, string $email,
		                                       UtilisateurRepository $repository): JsonResponse
		{
			$usersList = $this->cachePool->get(self::GETALLUSERSBYCUSTOMER,
			function(ItemInterface $item) use ($repository, $email) {
				$item->tag('usersByCustomerCache');
				$client = $this->em->getRepository(Client::class)->findByEmail($email);
				$users = $this->getRepository()->findByClient($client);
				return $users;
			});

			$jsonListUsers = $this->serializer->serialize($usersList, 'json', ['groups' => 'getUtilisateurs']);

			return new JsonResponse($jsonListUsers, Response::HTTP_OK, [], true);
		}

		#[Route('api/liste/utilisateurs', name:'liste_utilisateurs', methods:['GET'])]
		public function getListUsers(Request $request): JsonResponse
		{

			$usersList = $this->cachePool->get(
				self::GETALLUSERS,
				function(ItemInterface $item) {
					$item->tag('usersCache');
					return $this->getRepository()->findAll();
				}
			);

			$jsonUsers = $this->serializer->serialize($usersList, 'json', ['groups' => 'getUtilisateurs']);

			return new JsonResponse($jsonUsers, Response::HTTP_OK, [], true);
		}

		#[Route('api/details/utilisateurs/{id}', name:'details_utilisateurs', methods:['GET'])]
		public function getDetailsUsers(Request $request, int $id): JsonResponse
		{
			$user = $this->getRepository()->find($id);
			$jsonUser = $this->serializer->serialize($user, 'json', ['groups' => 'getUtilisateurs']);
			return new JsonResponse($jsonUser, Response::HTTP_OK, ['accept' => 'json'], true);
		}

		#[Route('api/ajout/utilisateurs/by/{email}', name:'ajout_utilisateurs_by_client', methods:['POST'])]
		public function postUsersByCustomer(Request $request, string $email): JsonResponse
		{
			$client = $this->em->getRepository(Client::class)->findByEmail($email);

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

		#[Route('api/update/utilisateurs/{email}', name:'update_utilisateurs', methods:['PUT'])]
		#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour modifier un utilisateur')]
		public function putUpdateUsers(Request $request, string $email ): JsonResponse
		{
			$message = '';

			$user = $this->getRepository()->findByEmail($email);

			if(is_null($user)) {
				$message = 'Cet utilisateur n\'existe pas';
			} else {
				$updateUser = $this->serializer->deserialize(
					$request->getContent(),
					Utilisateur::class,
					'json',
					[AbstractNormalizer::OBJECT_TO_POPULATE => $user]
				);

				$this->em->persist($updateUser);
				$this->em->flush();

				$message = 'L‘utilisateur '. $user->getName() .' a été mis à jour';
			}

			return new JsonResponse($message, JsonResponse::HTTP_OK);
		}

		#[Route('api/suppression/utilisateurs/{email}', name:'delete_utilisateurs', methods:['DELETE'])]
		#[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas les droits requis pour supprimer un utilisateur')]
		public function deleteUsers(Request $request, string $email): JsonResponse
		{
			$message = '';

			$user = $this->getRepository()->findByEmail($email);


			if(is_null($user)) {
				$message = "Cet utilisateur n'existe pas";
			} else {
				$name = $user->getName();
				$this->cachePool->invalidateTags(['usersCache', 'usersByCustomerCache']);
				$this->em->remove($user);
				$this->em->flush();

				$message = "L'utilisateur $name a été supprimé ! ";
			}

			return new JsonResponse($message, Response::HTTP_OK);
		}
	}