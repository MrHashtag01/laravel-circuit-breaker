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
        $limiter = app(RateLimiter::class);
        $actionKey = 'crud_name';
        $threshold = 6;
  
        try {
            if ($limiter->tooManyAttempts($actionKey, $threshold)) {
                return $this->failOrFallback();
            }
            $req = Http::timeout(4)->get('https://domain.com/api');
            $res = json_decode($req->body());
    
            dd($res);
        } catch (Exception $exception) {
            $limiter->hit($actionKey, Carbon::now()->addMinutes(16));
            return $this->failOrFallback();
        }
    }
}
