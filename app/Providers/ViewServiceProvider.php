<?php

namespace App\Providers;

use App\P_Type;
use App\Poster;
use App\T_Performance;
use App\Theatre;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('part.nav-bar', function ($view) {
            $view->with('p_types', P_Type::all());
        });

        view()->composer('part.perf-types', function ($view) {
            $path = Request::path();
            if(str_contains($path, 'performances') || str_contains($path, 'posters')) {

                $i = -1; // Active index
                $p = '<div class="btn-group">';

                if(strpos($path, '/'))
                    $nm = substr($path, 0, strpos($path, '/'));
                else
                    $nm = $path;

                if (Request::has('by_type')) {
                    $i = Request::get('by_type');
                } else if (str_contains($path, '/')){
                    $id = substr($path, strpos($path, '/')+1);

                    if($nm == "performances")
                        $i = T_Performance::findOrFail($id)->perf->type_id;
                    else if($nm == "posters")
                        $i = Poster::findOrFail($id)->perf->type_id;
                }

                foreach (P_Type::all() as $v) {
                    $p .= "<a class='btn btn-info" . ($i == $v->id ? " selected" : "") ."' href='/$nm?by_type=$v->id'>$v->name</a> ";
                }

                $p .= '</div>';
                $view->with('perf_types', $p);
            } else {
                $view->with('perf_types', '');
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
