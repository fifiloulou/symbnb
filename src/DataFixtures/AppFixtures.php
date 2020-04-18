<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Utilisation de faker pour remplir des fausses données
        $faker = Factory::create('fR-r');

        // Utilisation de slugify pour transformer une chaine de caractères en slug
        $slugify = new Slugify();

        // Création d'une boucle qui va répéter 30 fois l'annonce
        for($i = 1; $i <= 30; $i++) {

            // Ici on créé une nouvelle annonce ad et on ajoute le use pour dire à php où elle se trouve
            $ad = new Ad();

            // On défini tous nos faker dans les variables
            $title = $faker->sentence();
            $slug =$slugify->slugify($title);
            $coverImage = $faker->imageUrl(1000,350);
            $introduction = $faker->paragraph(2);
            $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';


            // Création d'une annonce en utilisant les variables pour compléter l'annonce
            $ad->setTitle("$title")
            ->setSlug("$slug")
            ->setCoverImage("$coverImage")
            ->setIntroduction("$introduction")
            ->setContent("$content")
            ->setPrice(mt_rand(40, 200))
            ->setRooms(mt_rand(1, 5));
            
            // On fait persister l'annonce dans la base de données
            $manager->persist($ad);
        }

        // Et on l'écrit en base de données (requête sql)
        $manager->flush();
    }
}
