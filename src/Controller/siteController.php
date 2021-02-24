<?php
// src/Controller/siteController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/")
*/

class siteController extends AbstractController
{
    /**
     * @Route("/", name = "web_root")
    */
    public function index()
    {
        return $this->render('site/index.html.twig', []);

    }
    
}
