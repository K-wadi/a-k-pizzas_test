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
        $cart = $this->get('session')->get('cart', []);
        return $this->render('order/cart.html.twig', ['cart' => $cart]);
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
