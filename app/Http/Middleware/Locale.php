<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(config('locale.status') ){
            if(Session::has('locale') && array_key_exists(Session::get('locale') ,  config('locale.languages'))){

                App::setlocale(Session::get('locale'));
                if(config('locale.languages')[Session::get('locale')][2]){
                    Session::put('lang_rtl' , true);
                }else{
                    Session::forget('lang_rtl');
                }

            }else{
                $userlanguages = preg_split('/[,;]/' , $request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userlanguages as $language) {
                    if(array_key_exists($language , config('locale.languages') )){
                        App::setlocale($language);

                        setlocale(LC_TIME , config('locale.languages')[$language][1]);


                        Carbon::setLocale(config('locale.languages')[$language][0]);


                        if(config('locale.languages')[$language][2]){
                            Session::put('lang_rtl' , true);
                            // session()->ge
                        }else{
                            Session::forget('lang_rtl');
                        }

                        break;
                    }
                }
            }
        }


        return $next($request);
    }
}
