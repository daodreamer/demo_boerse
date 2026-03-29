<?php

namespace App\Controller;

use App\Repository\HomeDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    public function __construct(private readonly HomeDataRepository $homeData) {}

    #[Route('/api/home', name: 'api_home', methods: ['GET'])]
    public function home(): JsonResponse
    {
        return $this->json($this->homeData->getHomeData());
    }
}
