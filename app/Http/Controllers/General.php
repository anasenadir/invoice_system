<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class General extends Controller
{
    public function changeLanguage($locale)
    {
        try{

            if(array_key_exists($locale , config('locale.languages'))){
                Session::put('locale' , $locale);
                App::setLocale($locale);
                return back();
            }
            
        }catch(\Exception  $exception){
            return back();
        }   


        return back();
    }
}
