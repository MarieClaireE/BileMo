<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProduitController extends AbstractController
{
    #[Route('/api/produits', name: 'list_produits', methods:['GET'])]
    public function getProductlist(ProduitRepository $produitRepository, SerializerInterface $serializer): JsonResponse
    {
			$productList = $produitRepository->findAll();
			$jsonProductlist = $serializer->serialize($productList, 'json');


				return new JsonResponse(
					$jsonProductlist, Response::HTTP_OK, [], true
				);
    }

		#[Route('/api/produits/{id}', name: 'details_produit', methods:['GET'] )]
		public function getDetailProduit(Produit $produit,
         SerializerInterface $serializer,
				ProduitRepository $produitRepository
		): JsonResponse
		{
			$jsonProduit = $serializer->serialize($produit, 'json');

			return new JsonResponse(
				$jsonProduit,
				Response::HTTP_OK,
				['accept' => 'json'],
				true
			);
		}
}
