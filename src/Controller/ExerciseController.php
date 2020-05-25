<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class ExerciseController extends ApiController {

    /**
     * @Route("/admin/exercise")
     */
    public function moviesAction() {
        return $this->respond([
            [
                'title' => 'The Princess Bride',
                'count' => 0
            ]
        ]);
    }
}