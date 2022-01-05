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
    /**
     * @Route("/", name="prostages_accueil")
     */
    public function index(): Response
    {
      
		$repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
		$stages=$repositoryStage->findAll();
		return $this->render('prosta/index.html.twig',['stages'=>$stages,'controller_name'=>'Liste de Stage ']);
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
		$repositoryFomration=$this->getDoctrine()->getRepository(Fomration::class);
		$formations=$repositoryFomration->findAll();
		return $this->render('prosta/pageFormation.twig',['formations'=>$formations,'controller_name'=>'Tri par formation']);
		 
		
	}
	
	
	
	/**
	 * @Route ("/stages/{id}" , name ="detail_stages")
	 */
	 public function afficherStages ($id) : Response
	 {
		return $this->render('prosta/pageDetailStage.twig',['controller_name'=>'Details stage','id'=>$id]);
	 }

	 

	 /**
	* @Route ("/entreprises/{id}" , name ="stages-entreprise")
	*/

	 public function AfficherStageDe($id) 
	 {

		 $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
 
		 $entreprise=$repositoryEntreprise->find($id);
 
 
		 return $this->render('prosta/pageStageEntreprise.html.twig',['entreprise'=>$entreprise]);
 
	 }

	 /**
	* @Route ("/formation/{id}" , name ="formation_stage")
	*/



}

