<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\Request;
use Illuminate\Routing\Controller as BaseController;
use MacsiDigital\Zoom\Facades\Zoom;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
