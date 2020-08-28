<?php

namespace App\DataFixtures;

use App\Entity\Bibliotheque;
use App\Entity\Moment;
use App\Entity\Musee;
use App\Entity\Ouvrage;
use App\Entity\Pays;
use App\Entity\Referencer;
use App\Entity\Site;
use App\Entity\Visiter;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create("fr_FR");

        for ($p=0; $p < 5; $p++){
        	$pays = new Pays();
        	$pays->setCodePays($faker->numerify(strtoupper($faker->randomLetter) . "###"))
				 ->setNbHabitant($faker->numberBetween($min = 10000, $max = 10000000));
        	$manager->persist($pays);

        	//boucle association : Ouvrage, Site, Musee => Pays

			for ($i=0; $i < 2; $i++){
				//Musée Création
				$musee = new Musee();
				$musee	->setNumMus($faker->numerify('####'))
						->setNomMus($faker->company)
						->setNbLivres($faker->numberBetween($min = 1000, $max=50000))
						->setPays($pays);
				$manager->persist($musee);

				//Ouvrage création
				$ouvrage = new Ouvrage();
				$ouvrage->setISBN($faker->numerify("####"))
						->setTitre($faker->sentence($nbWords = 3, $variableNbWords = true))
						->setNbPage($faker->numberBetween($min = 100, $max = 1500))
						->setPays($pays);
				$manager->persist($ouvrage);

				//Site Création
				$site = new Site();
				$site->setNomSite($faker->city)
						->setAnneedecouv($faker->year)
						->setPays($pays);
				$manager->persist($site);

				//Boucle création bibliothèque, Referencer, Visiter
				for ($j=0; $j < 2; $j++){
					// Création Bibliothèque
					$bibliotheque = new Bibliotheque();
					$date = new DateTime($faker->date($format = 'Y-m-d', $max = 'now'));
					$bibliotheque->setDateAchat($date)
						->setNumMus($musee)
						->addISBN($ouvrage);
					$manager->persist($bibliotheque);

					// Création Referencer
					$referencement = new Referencer();
					$referencement->setNumeroPage($faker->numerify("##"))
						->setIsbn($ouvrage)
						->addSite($site);
					$manager->persist($referencement);

					// Création Moment
					$moment = new Moment();
					$moment->setJour($date);
					$manager->persist($moment);

					// Création Visiter
					$visite = new Visiter();
					$visite->setNbvisiteurs($faker->numberBetween($min = 50, $max = 800))
						->setMusee($musee)
						->addJour($moment);
					$manager->persist($visite);
				}
			}
		}
		$manager->flush();
    }
}
