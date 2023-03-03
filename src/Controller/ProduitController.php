<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Produit;
use App\Repository\ClientRepository;
use App\Repository\ProduitRepository;
use PHPUnit\Util\Json;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class ProduitController extends AbstractController
{

		const GETALLPRODUCTS = "getAllProducts";
		const GETALLPRODUCTSBYCUSTOMER = "getAllProductsBycustomer";

		private $repository;

		public function getRepository(): ProduitRepository
		{
			return $this->em->getRepository(Produit::class);
		}

    #[Route('/api/liste/produits', name: 'list_produits', methods:['GET'])]
    public function getProductlist(Request $request, ProduitRepository $repository): JsonResponse
    {
			$productlist = $this->cachePool->get(self::GETALLPRODUCTS, function(ItemInterface $item) use ($repository) {
				$item->tag('productCache');
				return $this->getRepository()->findAll();
			});
			$jsonProductlist = $this->serializer->serialize($productlist, 'json', ['groups' => 'getProduits']);

			return new JsonResponse(
				$jsonProductlist, Response::HTTP_OK, [], true
			);
    }

		#[Route('api/liste/produits/by/{emailClient}', name:'list-produits-by-client', methods:['GET'])]
		public function getProductListByClient(Request $request, ProduitRepository $repository, string $emailClient, ClientRepository $clientRepository): JsonResponse
		{
			$products = $this->cachePool->get(self::GETALLPRODUCTSBYCUSTOMER, function(ItemInterface $item, ) use ($repository, $clientRepository, $emailClient) {
				$item->tag('productByCustomerCache');
				$client = $clientRepository->findByEmail($emailClient);
				return $this->getRepository()->findByCustomer($client);
			});

			$jsonProducts = $this->serializer->serialize($products, 'json', ['groups' => 'getProduits']);
			return new JsonResponse($jsonProducts, Response::HTTP_OK, [], true);
		}

		#[Route('/api/produits/{id}', name: 'details_produit', methods:['GET'] )]
		public function getDetailProduit(Produit $produit): JsonResponse
		{
			$jsonProduit = $this->serializer->serialize($produit, 'json', ['groups' => 'getProduits']);

			return new JsonResponse($jsonProduit,Response::HTTP_OK, ['accept' => 'json'],true);
		}

		#[Route('/api/produits/by/{email}', name:'creation_produits', methods:['POST'] )]
		public function postProduit(Request $request, string $email): JsonResponse
		{
			/**
			 * @var ClientRepository $clientRepo
			 */
			$clientRepo = $this->em->getRepository(Client::class);
			$client = $clientRepo->findByEmail($email);


			$produit = $this->serializer->deserialize(
				$request->getContent(),
				Produit::class,
				'json'
			);

			if(!is_null($client)) {
				$produit->setClient($client);
			}

			$this->em->persist($produit);
			$this->em->flush();

			$jsonProduct = $this->serializer->serialize(
					$produit,
					'json',
					['groups' => 'getProduits']
				);

			$location = $this->urlGenerator->generate(
				'details_produit',
				['id' => $produit->getId()],
				UrlGeneratorInterface::ABSOLUTE_URL
			);

			return new JsonResponse(
				$jsonProduct,
				Response::HTTP_CREATED,
				['location' => $location],
				true);
		}

		#[Route('/api/suppression/produits/{id}', name:'suppression_produits', methods:['DELETE'] )]
		#[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits requis pour supprimer un produit')]
		public function deleteProduit(Request $request, int $id): JsonResponse
		{
			$message = '';

			$produit = $this->getRepository()->find($id);

			if($produit === null) {
				$message = 'Vous ne pouvez pas supprimer ce produit';
			} else {
				$this->cachePool->invalidateTags(['productCache', 'productByCustomerCache']);
				$this->em->remove($produit);
				$this->em->flush();
				$message = 'Produit \'' .$produit->getName(). '\' a été supprimé';
			}


			return new JsonResponse($message, Response::HTTP_OK);
		}

		#[Route('api/update/produits/{id}', name: 'update_product', methods:['PUT'])]
		#[IsGranted('ROLE_ADMIN', message:'Vous n\’avez pas les droits requis pour modifier un produit')]
		public function updateProduit(Request $request, int $id): JsonResponse
		{
			$message = '';

			$produit = $this->getRepository()->find($id);

			if($produit ===  null) {
				$message = 'Aucun produit trouvé';
			} else {
				$updateProduct = $this->serializer->deserialize(
					$request->getContent(),
					Produit::class,
					'json',
					[AbstractNormalizer::OBJECT_TO_POPULATE => $produit]);

				$this->em->persist($updateProduct);
				$this->em->flush();

				$message = 'Produit \'' .$produit->getName(). '\' mis à jour';
			}


			return new JsonResponse($message, JsonResponse::HTTP_OK);
		}

}
