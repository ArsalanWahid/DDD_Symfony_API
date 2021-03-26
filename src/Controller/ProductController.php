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
        $products = $this->getDoctrine()->getRepository(Product::class)->find(1);
        return $this->json($products->getName());
    }

    public function create(Request $request): Response
    {
        $product_name = isset($_REQUEST['product']) ? $_REQUEST['product'] : '';
        $product_price = isset($_REQUEST['price']) ? $_REQUEST['price'] : '';
        $entityManager = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setName($product_name);
        $product->setPrice($product_price);
        $entityManager->persist($product);
        $entityManager->flush();
        return $this->json("Product received".$product_name.$product_price);
    }
}
