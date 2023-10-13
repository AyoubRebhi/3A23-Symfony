<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Author;

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
    #[Route('/AfficherAuthor', name: "Afficher")]
    function AfficherAuthor(AuthorRepository $repo)
    {
        $authors = $repo->findAll();

        return $this->render('author/showAuthor.html.twig', ['authorTable' => $authors]);
    }

    #[Route('/Details/{id}', name: 'Details')]
    function Details($id, AuthorRepository $repo)
    {
        $author = $repo->find($id);

        return $this->render('author/showDetails.html.twig', ['author' => $author]);
    }
    #[Route('/DeleteAuthor/{id}', name: 'DeleteAuthor')]
    function DeleteAuthor($id, AuthorRepository $repo, ManagerRegistry $manager)
    {
        $author = $repo->find($id);
        $em = $manager->getManager();
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute('Afficher');
    }
    #[Route('/Add')]
    function AddAuthor(ManagerRegistry $manager)
    {
        //Sna3na new manager 
        $author = new Author();
        //fct bech yasn3ou username w email
        $author->setUsername('Youbi');
        $author->setEmail('youbi@gmail.com');
        //recuperation de donnée
        $em = $manager->getManager();
        $em->persist($author);
        //refresh ll table
        $em->flush();
        //redirection ll nafs route
        return $this->redirectToRoute('Afficher');
    }
}
