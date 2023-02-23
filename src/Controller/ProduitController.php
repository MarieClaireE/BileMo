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

		public const GETALLPRODUCTS = "getAllProducts";
		public const GETALLPRODUCTSBYCUSTOMER = "getAllProductsBycustomer";

		private $repository;

		public function getRepository(): ProduitRepository
		{
			return $this->em->getRepository(Produit::class);
		}

    #[Route('/api/produits', name: 'list_produits', methods:['GET'])]
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

		#[Route('api/produits/by/{emailClient}', name:'list-produits-by-client', methods:['GET'])]
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

		#[Route('/api/produits/{id}', name:'suppression_produits', methods:['DELETE'] )]
		public function deleteProduit(Request $request, int $id): JsonResponse
		{
			$response = '';
			$produit = $this->getRepository()->find($id);

			if($produit === null) {
				$response = new JsonResponse(['error' => 'Une erreur est survenue lors de la suppression du produit'], Response::HTTP_NOT_FOUND);
			} else {
				$this->cachePool->invalidateTags(['productCache', 'productByCustomerCache']);
				$this->em->remove($produit);
				$this->em->flush();
				$response = new JsonResponse(['success' => 'Produit supprimé avec succès']);
			}
			return $response;
		}

		#[Route('api/produits/{id}', name: 'update_product', methods:['PUT'])]
		public function updateProduit(Request $request, int $id): JsonResponse
		{
			$response = '';

			$produit = $this->getRepository()->find($id);

			if($produit ===  null) {
				$response = new JsonResponse(['error' => 'Une erreur est survenue lors la modification du produit'], Response::HTTP_NOT_FOUND);
			} else {
				$updateProduct = $this->serializer->deserialize(
					$request->getContent(),
					Produit::class,
					'json',
					[AbstractNormalizer::OBJECT_TO_POPULATE => $produit]);

				$this->em->persist($updateProduct);
				$this->em->flush();

				$response = new JsonResponse(['success' => 'Produit modifié avec succès']);
			}

			return $response;
		}

}
