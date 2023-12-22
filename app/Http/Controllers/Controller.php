<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Employers;
use App\Models\User;
use App\Models\EmployersContactInfo;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
