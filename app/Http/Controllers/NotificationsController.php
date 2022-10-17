<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\RealTimeMessage;

class NotificationsController extends Controller
{
    public function index()
    {
        event(new RealTimeMessage('status'));
    }
}
