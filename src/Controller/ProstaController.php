<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Fomration;
use App\Entity\Stage;

class ProstaController extends AbstractController
{
    
		//PAGE D ACCUEIL LISTE DE STAGE
	/**
     * @Route("/", name="prostages_accueil")
     */
    public function index(): Response
    {
      
		$repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
		$stages=$repositoryStage->findAll();
		return $this->render('prosta/index.html.twig',['stages'=>$stages,'controller_name'=>'Liste de Stage ']);
    }
	
		//PAGE D ACCUEIL LISTE DE DES ENTREPRISES ( si click sur filtrer par entreprise)
	/**
	* @Route ("/entreprises" , name =" pageListeEntreprise ")
	*/
	public function afficherEntreprises () : Response
	{
		
		
		$repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
		$entreprises=$repositoryEntreprise->findAll();
		return $this->render('prosta/pageListeEntreprise.html.twig',['entreprises'=>$entreprises,'controller_name'=>'Tri par Entreprise']);
	}
	
		//PAGE D ACCUEIL LISTE DE DES FORMATIONS ( si click sur filtrer par formation)
	/**
	* @Route ("/formations" , name ="prostages_formations ")
	*/
	public function afficherFormations () : Response
	{
		$repositoryFomration=$this->getDoctrine()->getRepository(Fomration::class);
		$formations=$repositoryFomration->findAll();
		return $this->render('prosta/pageListeFormations.html.twig',['formations'=>$formations,'controller_name'=>'Tri par formation']);
		 
		
	}
	
	
		//PAGE QUI AFFICHE LES DETAILS D UN STAGE SI CLICK DESSUS
	/**
	 * @Route ("/stages/{id}" , name ="detail_stages")
	 */
	 public function afficherStages (Stage $stage) : Response
	 {
		// $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
		// $stage = $repositoryStage->find($id);


		return $this->render('prosta/pageDetailStage.html.twig',['stage'=>$stage,'controller_name'=>'Details stage']);
	 }

	 
	 	//PAGE QUI AFFICHE LES STAGE DE L ENTREPRISE CLICKE

	 /**
	* @Route ("/entreprises/{id}" , name ="stages-entreprise")
	*/

	 public function AfficherStageDeEntreprise(Entreprise $entreprise) 
	 {

		//  $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
 
		//  $entreprise=$repositoryEntreprise->find($id);
 
 
		 return $this->render('prosta/pageStageEntreprise.html.twig',['entreprise'=>$entreprise]);
 
	 }

	 		//PAGE QUI AFFICHE LES STAGE DE LA FORMATION CLICKE
	 /**
	* @Route ("/formations/{id}" , name ="StagesDeformation")
	*/
	 public function AfficherStageDeFormation(Fomration $formation) : Response
	{

		// $repositoryFormation=$this->getDoctrine()->getRepository(Fomration::class);

		// $formation=$repositoryFormation->find($id);


		return $this->render('prosta/pageStageParFormation.html.twig',['formation'=>$formation]);

	}




}

