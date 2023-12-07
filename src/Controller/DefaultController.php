<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Entity\Email;
use App\Form\NewsletterType;
use App\Repository\ConcertRepository;
use App\Repository\EmailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function concerts(ConcertRepository $cr): Response
    {
        $concerts=$cr->findAll();
        $concertsPasses=array();
        return $this->render('default/concerts.html.twig', [
            'concert'=>$concerts,
            'concertsPasses' => $concertsPasses,
        ]);
    }



    #[Route("/concert/{id}", name: "app_concert")]
    public function voirConcert(Concert $concert): Response
    {
        return $this->render('default/concert.html.twig', [
            'concert'=>$concert
        ]);
    }


    #[Route("/newsletter", name: "app_newsletter")]
    public function formNewsletter(Request $request,EmailRepository $er): Response
    {
        $email=new Email();
        $form=$this->createForm(NewsletterType::class,$email);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $er->save($email, true);
            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/_formNewsletter.html.twig',[
            'formObject' => $form
        ]);
    }
}
