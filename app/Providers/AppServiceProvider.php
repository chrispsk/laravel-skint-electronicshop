<?php

namespace App\Providers;
use App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(array('public.master_public', 'public.default'), function($view){
			$toate = App\Produs::all();
			//dd($toate->toArray());
			//$toate = DB::table('produse')->paginate(2);
			//$toate->withPath('url');
			$view->with('fetches',$toate);
		});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
