<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/teacher')]
class TeacherController extends AbstractController
{
    #[Route('/index', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }
    #[Route('/show/{class}')]
    function showTeacher($class)
    {
        return new Response("Bonjour " . $class);
    }

    #[Route('/', name: 'test')]
    public function test(): Response
    {
        return $this->render('author/test.html.twig', []);
    }
}
