<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;

class ProstaController extends AbstractController
{
    /**
     * @Route("/", name="prostages_accueil")
     */
    public function index(): Response
    {
      
		return $this->render('prosta/index.html.twig',['controller_name'=>'Liste de Stage ']);
    }
	
	/**
	* @Route ("/entreprises" , name =" prostages_entreprises ")
	*/
	public function afficherEntreprises () : Response
	{
		
		
		$repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
 
		$entreprises=$repositoryEntreprise->findAll();

		return $this->render('prosta/pageListeEntreprise.twig',['entreprises'=>$entreprises,'controller_name'=>'Tri par Entreprise']);
	}
	
	/**
	* @Route ("/formations" , name ="prostages_formations ")
	*/
	public function afficherFormations () : Response
	{
		
		return $this->render('prosta/pageFormation.twig',['controller_name'=>'Tri par formation']);
		 
		
	}
	
	
	
	/**
	 * @Route ("/stages/{id}" , name =" openclassdut_stages ")
	 */
	 public function afficherStages ($id) : Response
	 {
		return $this->render('prosta/pageDetailStage.twig',['controller_name'=>'Details stage','id'=>$id]);
	 }

	 

	 /**
	* @Route ("/entreprise/{id}" , name ="prostages/trierPar ")
	*/
	 public function AfficherStageDe($id) 
	 {
		 $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
 
		 $entreprise=$repositoryEntreprise->find($id);
 
		 $repositoryStage=$this-getDoctrine()->getRepository(Stage::class);
 
		 $stages=$repositoryStage->findBy('Entreprises'->$entreprise);
 
		 return this->redirectToRoute('listeStage.html.twig',['stages'=>$stages]);
 
	 }



}

