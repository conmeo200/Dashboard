<?php

namespace App\Http\Controllers;

use App\Service\Notification\NotificationManager;
use Illuminate\Http\Request;

class NoticationController extends Controller
{
    protected $noticationService;

    public function __construct(NotificationManager $noticationService)
    {
        $this->noticationService = $noticationService;
    }

    public function index() {
        return $this->noticationService->notify('Test', ['phones']);
    }
}
