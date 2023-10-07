<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    private $authors = array(
        array('id' => 1, 'picture' => '/images/TH.jpg', 'username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/TH.jpg', 'username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/images/TH.jpg', 'username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
    );
    #[Route('/index', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/showAuthor/{name}')]
    function showTeacher($name)
    {
        return $this->render('author/test.html.twig', ['n' => $name]);
    }
    #[Route('/list')]
    function list()
    {

        return $this->render('author/list.html.twig', ['auth' => $this->authors]);
    }
    #[Route('/AuthorDetails/{id}', name: 'AD')]
    function AuthorDetails($id)
    {
        return $this->render('author/show.html.twig', [
            'i' => $id,
            'auth' => $this->authors
        ]);
    }
}
