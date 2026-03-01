<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProductController extends AbstractController
{
    /**
     * Shows all products, ordered by creation date (newest first)
     * Accessible by everyone (authenticated or not)
     */
    #[Route('/product', name: 'app_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'title' => 'All Products',
            'show_actions' => false,
            'show_new_button' => false,
            'empty_message' => 'No products found. Be the first to publish one!',
        ]);
    }

    /**
     * Shows the authenticated user's own products
     * Requires login
     */
    #[Route('/product/my/products', name: 'app_my_products', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function myProducts(ProductRepository $productRepository): Response
    {
        // Filter products that belong to the authenticated user
        $products = $productRepository->findBy(
            ['owner' => $this->getUser()],
            ['createdAt' => 'DESC']
        );

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'title' => 'My Products',
            'show_actions' => true,
            'show_new_button' => true,
            'empty_message' => 'You have not published any products yet.',
        ]);
    }

    /**
     * Creates a new product
     * Requires login - the authenticated user becomes the owner
     */
    #[Route('/product/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Assign authenticated user as owner
            $product->setOwner($this->getUser());
            $product->setCreatedAt(new \DateTime());

            // If no image URL provided, use a random Picsum image
            if (!$product->getImage()) {
                $product->setImage('https://picsum.photos/seed/' . uniqid() . '/640/480');
            }

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Product "' . $product->getTitle() . '" created successfully!');

            return $this->redirectToRoute('app_product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/new.html.twig', ['form' => $form]);
    }

    /**
     * Shows a single product's details
     * Product is automatically fetched by Symfony via ParamConverter
     */
    #[Route('/product/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * Edits an existing product
     * Only the owner can edit - throws AccessDeniedException otherwise
     */
    #[Route('/product/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Product $product, EntityManagerInterface $em): Response
    {
        // Validate that the current user is the owner of the product
        if ($product->getOwner() !== $this->getUser()) {
            throw $this->createAccessDeniedException('You cannot edit this product.');
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Product updated successfully!');
            return $this->redirectToRoute('app_product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * Deletes a product
     * Only the owner can delete - CSRF token validated for security
     */
    #[Route('/product/{id}', name: 'app_product_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Product $product, EntityManagerInterface $em): Response
    {
        // Validate that the current user is the owner
        if ($product->getOwner() !== $this->getUser()) {
            throw $this->createAccessDeniedException('You cannot delete this product.');
        }

        // Validate the CSRF token to prevent cross-site request forgery
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->getPayload()->getString('_token'))) {
            $em->remove($product);
            $em->flush();
            $this->addFlash('success', 'Product deleted successfully!');
        }

        return $this->redirectToRoute('app_product_index');
    }
}