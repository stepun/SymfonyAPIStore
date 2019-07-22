<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends AbstractController
{
    /**
     * @Route("/hello/{name}")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($name, LoggerInterface $logger)
    {
        $logger->info("Saying hello to $name!");
        //return new JsonResponse(['author' => $name]);
        return $this->render('default/index.html.twig', [
                        'name' => $name,
                    ]);
    }
}