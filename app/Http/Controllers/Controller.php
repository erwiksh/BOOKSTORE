<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//panggil model BukuModel
use App\Models\buku;
use App\Models\penerbit;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Controller extends BaseController
{
   use AuthorizesRequests, ValidatesRequests;
}
