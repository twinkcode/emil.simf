<?php

namespace App\Controller;

use App\DTO\CalculatePriceDTO;
use App\Entity\Country;
use App\Entity\Product;
use App\Form\CalculatePriceType;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(ProductRepository $product): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $product->findAll()
        ]);
    }

    #[Route('/products/calculate-price', name: 'calculate_price')]
    public function calculatePrice(Request $request, PersistenceManagerRegistry $doctrine)
    {
        $calculatePriceDTO = new CalculatePriceDTO();
        $form = $this->createForm(CalculatePriceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData()->product;
            $taxNumber = $form->getData()->taxNumber;
            $countryPrefix = preg_replace('/\d/','',$taxNumber);
            $countryRepository = $doctrine->getRepository(Country::class);
            $country = $countryRepository->findOneBy(['prefix'=>$countryPrefix]);
            $price =  $product->getPrice() + ($product->getPrice() * $country->getTaxPercentage() / 100) ;
        }

        return $this->render('product/calculate_price.html.twig', [
            'form' => $form->createView(),
            'calculatePriceDTO' => $calculatePriceDTO,
            'price' => $price ?? null,
            'country' => isset($country) ? $country->getName() : null,
            'selectedProduct' => isset($product) ? $product->getName() : null,
        ]);

    }

    #[Route('/products/new', name: 'product_new')]
    public function new(Request $request,  PersistenceManagerRegistry $doctrine)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            return $this->redirectToRoute('app_products');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
