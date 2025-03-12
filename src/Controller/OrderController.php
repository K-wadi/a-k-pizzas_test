<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Pizza;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order/cart', name: 'order_cart')]
    public function cart()
    {
<<<<<<< HEAD
        $cart = $request->getSession()->get('cart', []);
        $pizzas = [];

        foreach ($cart as $id => $quantity) {
            $pizza = $entityManager->getRepository(Pizza::class)->find($id);
            if ($pizza) {
                $pizzas[] = ['pizza' => $pizza, 'quantity' => $quantity];
            }
        }

        return $this->render('order/cart.html.twig', [
            'cart' => $pizzas,
        ]);
    }

    #[Route('/order/checkout', name: 'order_checkout')]
    public function checkout(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Controleer of de gebruiker is ingelogd
        if (!$this->getUser()) {
            $this->addFlash('error', 'Je moet ingelogd zijn om een bestelling te plaatsen.');
            return $this->redirectToRoute('app_login');
        }

        $cart = $request->getSession()->get('cart', []);
        if (empty($cart)) {
            return $this->redirectToRoute('pizza_index');
        }

        $order = new Order();
        $order->setUser($this->getUser()); // Zorg ervoor dat een ingelogde gebruiker wordt opgeslagen
        $order->setStatus('To Do');

        foreach ($cart as $id => $quantity) {
            $pizza = $entityManager->getRepository(Pizza::class)->find($id);
            if ($pizza) {
                $orderItem = new OrderItem();
                $orderItem->setPizza($pizza);
                $orderItem->setQuantity($quantity);
                $order->addOrderItem($orderItem);
                $entityManager->persist($orderItem);
            }
        }

        $entityManager->persist($order);
        $entityManager->flush();

        $request->getSession()->set('cart', []);

        return $this->redirectToRoute('order_success');
    }



    #[Route('/success', name: 'order_success')]
    public function success(): Response
    {
        return $this->render('order/success.html.twig');
    }

    #[Route('/order/history', name: 'order_history')]
    public function history(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy(['user' => $this->getUser()], ['createdAt' => 'DESC']);

        return $this->render('order/history.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/update/{id}/{status}', name: 'order_update')]
    public function updateOrder(int $id, string $status, OrderRepository $orderRepository, EntityManagerInterface $entityManager): Response
    {
        $order = $orderRepository->find($id);
        if (!$order) {
            throw $this->createNotFoundException('Order niet gevonden.');
        }

        // Status-validatie: alleen toegestane wijzigingen
        $validStatuses = ['To Do', 'In Progress', 'Done'];
        if (!in_array($status, $validStatuses)) {
            return $this->redirectToRoute('baker_dashboard'); // Vermijd foutieve status-update
        }

        $order->setStatus($status);
        $entityManager->flush();

        return $this->redirectToRoute('baker_dashboard');
=======
        $cart = $this->get('session')->get('cart', []);
        return $this->render('order/cart.html.twig', ['cart' => $cart]);
>>>>>>> 254bd6ab6d06322005dcff067fee00edb811fc85
    }

    #[Route('/order/add/{id}', name: 'order_add')]
    public function addToCart(Pizza $pizza, Request $request)
    {
        $cart = $this->get('session')->get('cart', []);
        $cart[$pizza->getId()] = ($cart[$pizza->getId()] ?? 0) + 1;
        $this->get('session')->set('cart', $cart);
        return $this->redirectToRoute('order_cart');
    }

    #[Route('/order/checkout', name: 'order_checkout')]
    public function checkout(EntityManagerInterface $em)
    {
        $cart = $this->get('session')->get('cart', []);
        if (!$cart) return $this->redirectToRoute('pizza_index');

        $order = new Order();
        $order->setUser($this->getUser());
        foreach ($cart as $pizzaId => $quantity) {
            $pizza = $em->getRepository(Pizza::class)->find($pizzaId);
            $orderItem = new OrderItem();
            $orderItem->setPizza($pizza);
            $orderItem->setQuantity($quantity);
            $orderItem->setOrder($order);
            $em->persist($orderItem);
        }

        $em->persist($order);
        $em->flush();

        $this->get('session')->remove('cart');
        return $this->redirectToRoute('order_success');
    }

    #[Route('/order/success', name: 'order_success')]
    public function success()
    {
        return $this->render('order/success.html.twig');
    }
}
