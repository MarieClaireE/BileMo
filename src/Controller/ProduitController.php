<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class ProduitController extends AbstractController
{

		private $repository;

		public function getRepository(): ProduitRepository
		{
			return $this->em->getRepository(Produit::class);
		}

    #[Route('/api/produits', name: 'list_produits', methods:['GET'])]
    public function getProductlist(
			Request $request, ProduitRepository $repository
    ): JsonResponse
    {
			$idCache = "getAllProducts";
			$productlist = $this->cachePool->get($idCache, function(ItemInterface $item) use ($repository) {
				$item->tag('productCache');
				return $this->getRepository()->findAll();
			}
			);

			$jsonProductlist = $this->serializer->serialize($productlist, 'json');

			return new JsonResponse(
				$jsonProductlist, Response::HTTP_OK, [], true
			);
    }

		#[Route('/api/produits/{id}', name: 'details_produit', methods:['GET'] )]
		public function getDetailProduit(Produit $produit,
		): JsonResponse
		{
			$jsonProduit = $this->serializer->serialize($produit, 'json');

			return new JsonResponse($jsonProduit,Response::HTTP_OK, ['accept' => 'json'],true);
		}

		#[Route('/api/produits/', name:'creation_produits', methods:['POST'] )]
		public function postProduit(Request $request, Produit $produit, ProduitRepository $repository)
		{
			$produit = $this->serializer->deserialize($request->getContent(), Produit::class, 'json');
			$this->em->persist($produit);
			$this->em->flush();

			$jsonProduit = $this->serializer->serialize($produit, 'json', ['groups' => 'getProducts']);
			$location = $this->urlGenerator->generate('detailProduit', ['id'=> $produit->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

			return new JsonResponse($jsonProduit, Response::HTTP_CREATED, ["Location" => $location], true);
		}
}
