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
    public function statsPatients(EntityManagerInterface $em, int $periodicity = 1): JsonResponse
    {
        $nbDocuments =  count($em->getRepository(Document::class)->getOrdonnancesBetweenDates($periodicity));
        $nbMeets = count($em->getRepository(Meet::class)->getMeetsBetweenDates($periodicity));
        $nbVideoMeets = count($em->getRepository(Meet::class)->getVideoMeetsBetweenDates($periodicity));
        $nbUrgencies = count($em->getRepository(Meet::class)->getUrgentMeetsBetweenDates($periodicity));
        $nbMissedMeets = count($em->getRepository(Meet::class)->getMissedMeetsBetweenDates($periodicity));
        return new JsonResponse(['orders' => $nbDocuments, 'meets' => $nbMeets, 'videoMeets' => $nbVideoMeets, 'urgencies' => $nbUrgencies, 'missedMeets' => $nbMissedMeets]);
    }
}
