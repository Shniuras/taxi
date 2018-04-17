<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SimpleController extends Controller
{
    /**
     * @Route("/simple", name="simple")
     */
    public function index()
    {
        return $this->render('simple/index.html.twig');
    }
}
