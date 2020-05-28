<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Repository\ExerciseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/exercise/{id}", methods={"POST"})
     */
    public function form(Request $request, $id = null) {
        if (!$request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        if (!$request->get('title')) {
            return $this->respondValidationError('Please provide a title!');
        }
        if (!$request->get('description')) {
            return $this->respondValidationError('Please provide a description!');
        }

        $exercise = null;
        if ($id) {
            $exercise = $this->em->getRepository(Exercise::class)->find($id);
        } else {
            $exercise = new Exercise();
        }
        $exercise->setName($request->get('title'));
        $exercise->setDescription($request->get('description'));

        $this->em->persist($exercise);
        $this->em->flush();

        return $this->respondCreated($this->em->getRepository(Exercise::class)->transform($exercise));
    }

    /**
     * @Route("/exercise/{id}/delete")
     */
    public function delete($id, ExerciseRepository $exerciseRepository) {
        $exercise = $this->em->getRepository(Exercise::class)->find($id);

        $this->em->remove($exercise);
        $this->em->flush();

        return $this->respond([['exercises' => $exerciseRepository->transformAll()]]);
    }
}