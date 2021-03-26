<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->json($products);
    }

    public function create(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setName("lotion");
        $product->setPrice("10");
        $entityManager->persist($product);
        $entityManager->flush();
        return $this->json($product);
    }
}
