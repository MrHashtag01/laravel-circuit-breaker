<?php
    
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon; 


class CrudController extends Controller
{
    public function index()
    {
        $req = Http::get('https://domain.com/api');
        $response = json_decode($req->body());
  
        dd($response);
    }
}
