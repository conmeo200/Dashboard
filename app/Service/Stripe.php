<?php

use App\Service;
use Psy\Exception\ThrowUpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class Stripe {
    public $serect_key;

    public function __construct($serect_key) {
        if (empty($serect_key)) throw new NotFoundHttpException('Missing Key');
    }

    public function add() {}
    public function list() {}
}
