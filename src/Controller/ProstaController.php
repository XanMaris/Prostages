<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Fomration;
use App\Entity\Stage;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProstaController extends AbstractController
{
    
		//PAGE D ACCUEIL LISTE DE STAGE
	/**
     * @Route("/", name="prostages_accueil")
     */
    public function index(): Response
    {
      
		$repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
		$stages=$repositoryStage->ListeDeStages();
		return $this->render('prosta/index.html.twig',['stages'=>$stages,'controller_name'=>'Liste de Stage ']);
    }
	
		//PAGE D ACCUEIL LISTE DE DES ENTREPRISES ( si click sur filtrer par entreprise)
	/**
	* @Route ("/entreprises" , name ="pageListeEntreprise")
	*/
	public function afficherEntreprises () : Response
	{
		
		
		$repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
		$entreprises=$repositoryEntreprise->TrieParEntreprise();
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
	* @Route ("/entreprises/{nom}" , name ="stages-entreprise")
	*/

	public function AfficherStageParEntreprise($nom) : Response
	{


		$repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
		$stages = $repositoryStage->stageParEntreprise($nom);


		return $this->render('prosta/pageStageEntreprise.html.twig',['stages'=>$stages]);

	}


	 		//PAGE QUI AFFICHE LES STAGE DE LA FORMATION CLICKE
	 /**
	* @Route ("/formations/{nom}" , name ="StagesDeformation")
	*/
	 public function AfficherStageDeFormation($nom) : Response
	{

		 $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);

		 $Stages=$repositoryStage->stageParFormation($nom);
		 


		return $this->render('prosta/pageStageParFormation.html.twig',['stages'=>$Stages]);

	}


	/**
	* @Route ("/AjouterEntreprise" , name ="Ajouter entreprise")
	*/
		
public function ajouterEntreprise(Request $requestHttp, EntityManagerInterface $manager)

{
	$entreprises = new Entreprise();

	//création de l'objet formulaire 

	$formulaireEntreprise = $this->createFormBuilder($entreprises)
							->add('nom')
							->add('adresse')
							->add('activite',TextareaType::class)
							->add('URLsite',Urltype::class)
							->add('Ajouter',SubmitType::class)
							->getForm();

	
	$formulaireEntreprise->handleRequest($requestHttp);

	if ($formulaireEntreprise->isSubmitted())
	{
		$manager->persist($entreprises);
		$manager->flush();
		return $this->redirectToRoute('pageListeEntreprise');
	}

	return $this-> render('prosta/pageFormulaireDeSaisie.html.twig',['vueFormulaire'=>$formulaireEntreprise->createView()]);


}

}

