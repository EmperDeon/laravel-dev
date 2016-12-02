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
     * Get partial for types, theatres and months
     *
     * @return string - final menu
     */
    function getSorts()
    {
        $path = Request::path();
        if (str_contains($path, 'performances') || str_contains($path, 'posters')) {

            $i_tp = $i_th = $i_mn = 0;

            if (Request::has('by_type')
                || Request::has('by_theatre')
                || Request::has('by_month')
            ) { // If has parameters [performances?by_type=1&...]
                $nm = $path;

                if ($t = Request::get('by_type')) $i_tp = $t; // Change value if not null
                if ($t = Request::get('by_theatre')) $i_th = $t;
                if ($t = Request::get('by_month')) $i_mn = $t;

            } else if (strpos($path, '/')) { // If it's performance [performance/1]
                $nm = substr($path, 0, strpos($path, '/'));

                $t = T_Performance::findOrFail(substr($path, strpos($path, '/') + 1));

                $i_tp = $t->perf->type_id;
                $i_th = $t->theatre_id;
                // TODO: Add months

            } else { // If model's index
                $nm = $path;
            }

            // Create clear button. Here because $nm is not changed
            $cl = "<a href='/$nm' class='btn btn-primary'  data-hover='dropdown' >" . trans('global.clear') . "</a>";


            // Reconstruct request url
            $nm .= '?';
            $nm .= $i_tp > 0 ? 'by_type=' . $i_tp . '&' : '';
            $nm .= $i_th > 0 ? 'by_theatre=' . $i_th . '&' : '';
            $nm .= $i_mn > 0 ? 'by_month=' . $i_mn : '';

            $nm = rtrim($nm, '?');
            $nm = rtrim($nm, '&');


            // Add 'Type' menu
            $t_name = $i_tp > 0 ? P_Type::findOrFail($i_tp)->name : trans('models.perf-types-default');
            $r = $this->getMenu($nm, $i_tp, $t_name, 'by_type', P_Type::all());


            // Add 'Theatre' menu
            $t_name = $i_th > 0 ? Theatre::findOrFail($i_th)->name : trans('models.perf-theatres-default');
            $r .= $this->getMenu($nm, $i_th, $t_name, 'by_theatre', Theatre::all());


            if ($path == 'posters') {
                $mon = trans('global.months');
                $t_name = $i_mn > 0 ? $mon[$i_mn-1] : trans('models.perf-theatres-default');
                $r .= $this->getMenu($nm, $i_mn, $t_name, 'by_month', $mon);

            }

            // Add 'Clear' button
            $r .= $cl;

            return $r;
        } else {
            return '';
        }
    }


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('part.nav-bar', function ($view) {
            $view->with('p_types', P_Type::all());
            $view->with('theatres', Theatre::all());
        });

        view()->composer('part.perf-types', function ($view) {
            $view->with('perf_types', $this->getSorts());

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

    /**
     * @param $url
     * @param $t_id
     * @param $t_name
     * @param $t_type
     * @param $collection
     * @return string
     * @internal param $t_link
     */
    public function getMenu($url, $t_id, $t_name, $t_type, $collection):string
    {
        // Replace old id with new
        $url = preg_replace("/$t_type=\\d+&*/", '', $url);

        if ($url == 'performances' || $url == 'posters')
            $url .= '?';

        if ($url[strlen($url) - 1] != '?')
            $url .= '&';

        $url .= $t_type . '=';

        // Return menu
        $p = "<div class='btn-group dropdown' style='margin-right: 10px;'>  
            <a href='/$url$t_id' class='btn btn-primary'  data-hover='dropdown' >$t_name</a>
            <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
            <ul class='dropdown-menu' role='menu'>
            ";

        $p .= '<li><a href=""';
        if (is_array($collection))
            for ($i = 1 ; $i < 13 ; $i++)
                $p .= "<li><a href='/$url$i'>".$collection[$i-1]."</a></li>";
        else
            foreach ($collection as $v)
                $p .= "<li><a href='/$url$v->id'>$v->name</a></li>";

        $p .= '</ul></div>';
        return $p;
    }
}
