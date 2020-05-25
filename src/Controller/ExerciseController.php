<?php

namespace App\Controller;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ExerciseController extends ApiController {

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @Route("/exercise/findall", methods={"GET"})
     */
    public function findAll() {
        $exercises = $this->em->getRepository(Exercise::class)->transformAll();

        return $this->respond([
            [
                'exercises' => $exercises,
            ]
        ]);
    }
}