<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Meet;
use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Comment\Doc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    #[Route('/api/stats/{periodicity}', name:'api_stats')]
    public function statsPatients(EntityManagerInterface $em, int $periodicity): JsonResponse
    {
        $nbDocuments =  count($em->getRepository(Document::class)->getOrdonnancesBetweenDates($periodicity));
        $nbMeets = count($em->getRepository(Meet::class)->getMeetsBetweenDates($periodicity));
        $nbVideoMeets = count($em->getRepository(Meet::class)->findBy(['isVideo' => true]));
        $nbUrgencies = count($em->getRepository(Meet::class)->findBy(['isUrgent' => true]));
        $nbMissedMeets = count($em->getRepository(Meet::class)->findBy(['isMissedMeet' => true]));
        return new JsonResponse(['orders' => $nbDocuments, 'meets' => $nbMeets, 'videoMeets' => $nbVideoMeets, 'urgencies' => $nbUrgencies, 'missedMeets' => $nbMissedMeets]);
    }
}
