<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Memo;
use App\Categories;
use App\Leter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $links = Session::get('routes');
            $sent =  Memo::where("sender",  (string)Auth::id())->paginate();
            $recieved = Memo::where("reciever",  (string)Auth::id())->paginate();
            $sentl =  Leter::where("sender",  (string)Auth::id())->paginate();
            $recievedl = Leter::where("reciever",  (string)Auth::id())->paginate();
            $users = User::with("category")->where("id","!=", Auth::id())->get()->all();
            $categories = Categories::all();
            $staff = User::where('categories_id', 6)->get()->all();
           

// dd($sent);
            //  Auth::logout();
            $view->with(compact('links', 'sent', 'recieved', 'sentl', 'recievedl', 'users', 'categories', 'staff'));
        });
    }
}
