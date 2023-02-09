<?php

	namespace App\Controller;

	use App\Entity\Client;
	use App\Entity\Utilisateur;
	use App\Repository\ClientRepository;
	use App\Repository\UtilisateurRepository;
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

		public function getRepository(): UtilisateurRepository
		{
			return $this->em->getRepository(Utilisateur::class);
		}

		#[Route('api/liste/utilisateurs/by/{email}', name:'liste_utilisateurs_par_clients', methods:['GET'])]
		public function getListUsersByCustomer(Request $request, string $email,
		                                       UtilisateurRepository $repository): JsonResponse
		{
			$idCache = "getAllUsersByCustomer";
			$usersList = $this->cachePool->get($idCache,
			function(ItemInterface $item) use ($repository, $email) {
				$item->tag('usersByCustomerCache');

				$client = $this->em->getRepository(Client::class)->findOneBy(['email' => $email]);
				$users = $this->getRepository()->findBy(['codeClient' => $client->getCode()]);

				return $this->serializer->serialize($users, 'json',['groups' => 'getUtilisateurs']);
			});

			return new JsonResponse($usersList, Response::HTTP_OK, [], true);
		}

		#[Route('api/liste/utilisateurs', name:'liste_utilisateurs', methods:['GET'])]
		public function getListUsers(Request $request): JsonResponse
		{

			$idCache = "getAllUsers";
			$usersList = $this->cachePool->get(
				$idCache,
				function(ItemInterface $item) {
					$item->tag('usersCache');
					return $this->getRepository()->findAll();
				}
			);

			$jsonUsers = $this->serializer->serialize($usersList, 'json', ['groups' => 'getUtilisateurs']);

			return new JsonResponse($jsonUsers, Response::HTTP_OK, [], true);
		}

		#[Route('api/details/utilisateurs/{id}/by/{email}', name:'details_utilisateurs', methods:['GET'])]
		public function getDetailsUsers(Request $request, int $id, string $email): JsonResponse
		{
			$client = $this->em->getRepository(Client::class)->findOneBy(['email' => $email]);
			$user = $this->getRepository()->findOneBy(['id' => $id, 'codeClient' => $client->getCode()]);

			$jsonUser = $this->serializer->serialize($user, 'json', ['groups' => 'getUtilisateurs']);

			return new JsonResponse($jsonUser, Response::HTTP_OK, ['accept' => 'json'], true);
		}

		#[Route('api/ajout/utilisateurs/by/{email}', name:'ajout_utilisateurs_by_client', methods:['POST'])]
		public function postUsersByCustomer(Request $request, string $email): JsonResponse
		{
			$client = $this->em->getRepository(Client::class)->findOneBy(['email'=> $email]);

			$user = $this->serializer->deserialize(
				$request->getContent(),
				Utilisateur::class,
				'json'
			);

			if(!is_null($client)) {
				$user->setCodeClient($client->getCode());
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
		public function putUpdateUsers(Request $request, string $email ): JsonResponse
		{
			$message = '';

			$user = $this->getRepository()->findOneBy(['email' => $email]);

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
		public function deleteUsers(Request $request, string $email): JsonResponse
		{
			$message = '';

			$user = $this->getRepository()->findOneBy(['email' => $email]);

			if(is_null($user)) {
				$message = "Cet utilisateur n'existe pas";
			} else {
				$name = $user->getName();
				$this->cachePool->invalidateTags(['getAllUsers', 'getAllUsersByCustomer']);
				$this->em->remove($user);
				$this->em->flush();

				$message = "L'utilisateur $name a été supprimé ! ";
			}

			return new JsonResponse($message, Response::HTTP_OK);
		}
	}