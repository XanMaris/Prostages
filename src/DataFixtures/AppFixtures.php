<?php 


namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Fomration;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {   
        $faker= \Faker\Factory::create('fr_FR'); 

            //creation entreprise 

        for ($i=0;$i<10;$i++)
        {

            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setAdresse($faker->address );
            $entreprise->setURLsite($faker->url);
            $entreprise->setActivite($faker->realtext());
            
            $entreprises[]=$entreprise;
            $manager->persist($entreprise);
        }
        
        $Formation = array (

            "DUT info"=> "Diplome Universitaire et Technologique Informatique",
            "BAC"=> "Diplome du baccalaureat",
            "CAP coiffure" => "Certificat d'aptitude professionnelle de coiffure",
        );

        foreach($Formation as $nomCourt => $nomLong)
    {
            $formation=new Fomration();
            $formation->setNomCourt($nomCourt);
            $formation->setNom($nomLong);
            $manager->persist($formation);
    } 
        
           //creation stage 

        for ($i=0;$i<10;$i++)
        {
            //numero aleatoire
            $numeroEntreprise = $faker->numberBetween($min=0, $max=9);
            $stage = new Stage();
            $stage->setTitre($faker->realtext());
            $stage->setDescription($faker->realtext());
            $stage->setEmail($faker->email);

            $stage->addFormation($formation);


            $stage->setEntreprise($entreprises[$numeroEntreprise]);
            $entreprises[$numeroEntreprise]->addStage($stage);
            
            $manager->persist($stage);
        }
    
        
        
        


        $manager->flush();
     }


}
