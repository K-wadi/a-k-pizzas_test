<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Pizza;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/cart', name: 'order_cart')]
    public function cart(Request $request, EntityManagerInterface $entityManager): Response
    {
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

    #[Route('/checkout', name: 'order_checkout')]
    public function checkout(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cart = $request->getSession()->get('cart', []);
        if (empty($cart)) {
            return $this->redirectToRoute('pizza_index');
        }

        $order = new Order();
        $order->setUser($this->getUser());
        $order->setStatus('To Do');

        foreach ($cart as $id => $quantity) {
            $pizza = $entityManager->getRepository(Pizza::class)->find($id);
            if ($pizza) {
                $orderItem = new OrderItem();
                $orderItem->setPizza($pizza);
                $orderItem->setQuantity($quantity);
                $order->addOrderItem($orderItem); // Correcte methode gebruiken
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

    #[Route('/orders', name: 'order_history')]
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
    }
}


