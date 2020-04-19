<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        // Indique où récupèrer les données de la table ad(les annonces)Mis en commentaire car remplacer par la ligne du dessus
        // $repo = $this->getDoctrine()->getRepository(Ad::class);

        // Précise de quelle manière récupérer les données
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     * 
     * @Route("/ads/{slug}", name="ads_show")
     *
     * @return Response
     */
    public function show(Ad $ad) {
        // Récupère l'annonce qui correspond au slug 
        //$ad = $repo->findOneBySlug($slug); cette ligne a été remplacé par ad $ad au dessus

        return $this->render('ad/show.html.twig', [
           'ad' => $ad 
        ]);
    }
}
