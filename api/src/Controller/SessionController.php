<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * Get the last done workout session
     * 
     * @Route("/api/sessions/last", name="session_last", methods={"GET"})
     */
    public function index(SessionRepository $repo)
    {
        $lastSession = $repo->findLast();

        return $this->json($lastSession);
    }
}
