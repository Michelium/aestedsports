<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController {

    protected $statusCode = 200;

    public function getStatusCode() {
        return $this->statusCode;
    }

    protected function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond($data, $headers = []) {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function respondWithErrors($errors, $headers = []) {
        $data = [
            'errors' => $errors,
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function respondUnauthorized($message = 'Not authorized!') {
        return $this->setStatusCode(401)->respondWithErrors($message);
    }

    public function respondValidationError($message = 'Validation errors')
    {
        return $this->setStatusCode(422)->respondWithErrors($message);
    }

    public function respondNotFound($message = 'Not found!')
    {
        return $this->setStatusCode(404)->respondWithErrors($message);
    }

    public function respondCreated($data = [])
    {
        return $this->setStatusCode(201)->respond($data);
    }
}