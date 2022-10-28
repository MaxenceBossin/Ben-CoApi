<?php

namespace App\Controller;

use App\Entity\Dumpster;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @Route("/api", name="api_")
 */
class DumpsterController extends AbstractController
{
    // Fonction d'ajout des bennes
    #[Route('/addDumpster', name: 'app_addDumpster')]
    public function addDumpster(ManagerRegistry $doctrine, HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request(
            'GET',
            'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=points-dapport-volontaire-dechets-et-moyens-techniques&q=&rows=5&facet=commune&facet=details_source_geoloc&facet=details_source_attributaire&facet=type_flux&facet=prestataire&facet=centre_ville&facet=zone&refine.flux=R%C3%A9cup%27verre&refine.commune=Toulouse'
        );

        $benne = json_decode($response->getContent());
        $benneInfo = $benne->records;
        dump($benneInfo);

        foreach ($benneInfo as $benneInfos) {
            $longitude = $benneInfos->geometry->coordinates[0];
            $latitude = $benneInfos->geometry->coordinates[1];
            $commune = $benneInfos->fields->commune;
            $voie = $benneInfos->fields->voie;
            $numeroVoie = $benneInfos->fields->numero_voie;
            $codePostal = $benneInfos->fields->code_postal;

            $entityManager = $doctrine->getManager();

            $dumpster = new Dumpster();

            $dumpster->setLongitude($longitude);
            $dumpster->setLatitude($latitude);
            $dumpster->setCapacity(0);
            $dumpster->setCity($commune);
            $dumpster->setStreetLabel($voie);
            $dumpster->setStreetNumber($numeroVoie);
            $dumpster->setPostalCode($codePostal);
            $entityManager->persist($dumpster);
            $entityManager->flush();
        }

        return $this->redirect('../api/showDumpster');
    }

    // Fonction d'affichage de toutes les bennes
    #[Route('/showDumpster', name: 'app_showDumpster')]
    public function showDumpster(ManagerRegistry $doctrine): Response
    {
        $dumpster = $doctrine->getRepository(Dumpster::class)->findAll();

        $tab = [];

        foreach ($dumpster as $dumpsters) {
            $tab[] = [
                "id" => $dumpsters->getId(),
                "latitude" => $dumpsters->getLatitude(),
                "longitude" => $dumpsters->getLongitude(),
                "capacity" => $dumpsters->getCapacity(),
                "commune" => $dumpsters->getCity(),
                "voie" => $dumpsters->getStreetLabel(),
                "numero_voie" => $dumpsters->getStreetNumber(),
                "code_postal" => $dumpsters->getPostalCode()
            ];
        }
        return $this->json($tab);
    }

}
