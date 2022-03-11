<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        
    }


    /**
	* @Route ("/Inscription" , name ="app_inscription")
	*/
		
    public function ajouterUtilisateur(Request $requestHttp, EntityManagerInterface $manager)

    {
        //Creatio d'un utilisateur vide 

	    $utilisateur = new User();

	//création de l'objet formulaire de saise d'un utilisateur

	$formulaireUtilisateur = $this->createForm(UserType::class,$utilisateur);
	
	$formulaireUtilisateur->handleRequest($requestHttp);

	if ($formulaireUtilisateur->isSubmitted())
	{
		$manager->persist($utilisateur);
		$manager->flush();
		return $this->redirectToRoute('pageListeEntreprise');
	}

	return $this-> render('Security/Utilisateur.html.twig',['vueFormulaire'=>$formulaireUtilisateur->createView()]);


    }   






}
