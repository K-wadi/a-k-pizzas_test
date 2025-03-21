<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Pizza;
use App\Form\OrderType;
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
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $pizza = $entityManager->getRepository(Pizza::class)->find($id);
            if ($pizza) {
                $pizzas[] = ['pizza' => $pizza, 'quantity' => $quantity];
                $total += $pizza->getPrice() * $quantity;
            }
        }

        return $this->render('order/cart.html.twig', [
            'cart' => $pizzas,
            'total' => $total
        ]);
    }

    #[Route('/checkout', name: 'order_checkout', methods: ['GET', 'POST'])]
    public function checkout(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cart = $request->getSession()->get('cart', []);
        if (empty($cart)) {
            return $this->redirectToRoute('pizza_index');
        }

        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

        $pizzas = [];
        $total = 0;
        foreach ($cart as $id => $quantity) {
            $pizza = $entityManager->getRepository(Pizza::class)->find($id);
            if ($pizza) {
                $pizzas[] = ['pizza' => $pizza, 'quantity' => $quantity];
                $total += $pizza->getPrice() * $quantity;
            }
        }

        return $this->render('order/checkout.html.twig', [
            'form' => $form->createView(),
            'cart' => $pizzas,
            'total' => $total
        ]);
    }

    #[Route('/success', name: 'order_success')]
    public function success(OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findOneBy([], ['createdAt' => 'DESC']);
        
        if (!$order) {
            return $this->redirectToRoute('pizza_index');
        }

        $total = 0;
        foreach ($order->getOrderItems() as $item) {
            $total += $item->getPizza()->getPrice() * $item->getQuantity();
        }

        return $this->render('order/success.html.twig', [
            'order' => $order,
            'total' => $total
        ]);
    }

    #[Route('/history', name: 'order_history')]
    public function history(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([], ['createdAt' => 'DESC']);

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

        $validStatuses = ['To Do', 'In Progress', 'Done'];
        if (!in_array($status, $validStatuses)) {
            return $this->redirectToRoute('baker_dashboard');
        }

        $order->setStatus($status);
        $entityManager->flush();

        return $this->redirectToRoute('baker_dashboard');
    }

    #[Route('/add/{id}', name: 'order_add')]
    public function addToCart(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        $pizza = $entityManager->getRepository(Pizza::class)->find($id);
        if (!$pizza) {
            throw $this->createNotFoundException('Pizza niet gevonden!');
        }

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('order_cart');
    }

    #[Route('/remove/{id}', name: 'order_remove')]
    public function removeFromCart(int $id, Request $request): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $session->set('cart', $cart);
        }

        return $this->redirectToRoute('order_cart');
    }

    #[Route('/baker-dashboard', name: 'baker_dashboard')]
    public function bakerDashboard(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([], ['createdAt' => 'DESC']);
        
        return $this->render('order/baker_dashboard.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/track/{reference}', name: 'order_track')]
    public function track(string $reference, OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findOneBy(['orderReference' => $reference]);
        
        if (!$order) {
            throw $this->createNotFoundException('Bestelling niet gevonden.');
        }

        $total = 0;
        foreach ($order->getOrderItems() as $item) {
            $total += $item->getPizza()->getPrice() * $item->getQuantity();
        }

        return $this->render('order/track.html.twig', [
            'order' => $order,
            'total' => $total
        ]);
    }

    #[Route('/increase/{id}', name: 'order_increase')]
    public function increase(Pizza $pizza, Request $request): Response
    {
        $cart = $request->getSession()->get('cart', []);
        $id = $pizza->getId();
        
        if (!isset($cart[$id])) {
            $cart[$id] = 0;
        }
        
        $cart[$id]++;
        
        $request->getSession()->set('cart', $cart);
        
        return $this->redirectToRoute('order_cart');
    }

    #[Route('/decrease/{id}', name: 'order_decrease')]
    public function decrease(Pizza $pizza, Request $request): Response
    {
        $cart = $request->getSession()->get('cart', []);
        $id = $pizza->getId();
        
        if (isset($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }
        
        $request->getSession()->set('cart', $cart);
        
        return $this->redirectToRoute('order_cart');
    }
}
