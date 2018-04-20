<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalculatorController extends Controller
{
    /**
     * @Route("/calculator", name="calculator")
     */
    public function index()
    {
        return $this->render('calculator/index.html.twig', [
            'controller_name' => 'CalculatorController',
        ]);
    }

    public function add($a, $b)
    {
        return $a + $b;
    }
}
