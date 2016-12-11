<?php

namespace App\Providers;

use App\P_Type;
use App\Performance;
use App\Poster;
use App\T_Performance;
use App\Theatre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;

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
            $a = [ // Main array
                'month' =>    0,
                'type' =>     0,
                'theatre' =>  0,
                'name' =>     0,
                'day' =>      0,
                'time'=>      0,
            ];

            if ( $this->hasOnePar($a) ) { // If has parameters [performances?by_type=1&...]
                $nm = $path;

                foreach ($a as $k => $v)
                    if ($t = Request::get('by_' . $k)) $a[$k] = $t; // Change value if not null

            } else if (strpos($path, '/')) { // If it's performance [performance/1]
                $nm = substr($path, 0, strpos($path, '/'));

                $t = T_Performance::findOrFail(substr($path, strpos($path, '/') + 1));

                $a['type'] = $t->perf->type_id;
                $a['theatre'] = $t->theatre_id;

            } else { // If model's index
                $nm = $path;
            }

            // Create clear button. Here because $nm is not changed
            $cl = "<a href='/$nm' class='btn btn-primary'>" . trans('global.clear') . "</a>";


            // Reconstruct request url
            $nm .= '?';

            foreach ($a as $k => $v)
                $nm .= $v > 0 ? "by_$k=$v&" : '';

            $nm = rtrim($nm, '?');
            $nm = rtrim($nm, '&');

            $r = '';

            // Add 'Month' menu
            if ($path == 'posters') {
                $r .= $this->getMenu($nm, $a, 'month');
            }

            // Add 'Type' menu
            $r .= $this->getMenu($nm, $a, 'type');


            // Add 'More' and 'Clear' buttons
            $r .= '<a  href="#" class="btn btn-primary" data-toggle="collapse" data-target="#perf-types" style="margin-right:10px">' . trans('models.perf-more') . '</a>';
            $r .= $cl . '</div>';


            // Start 'More' menu
            $b = ['theatre'=>0, 'name'=>0, 'day'=>0, 'time'=>0];
            $open = $this->hasOnePar($b);
            $r .= '<div class="perf-types"><div class="collapse'. ($open ? ' open in' : '') .'" id="perf-types">';

            // Add 'Theatre' menu
            foreach ($b as $k => $v)
                $r .= $this->getMenu($nm, $a, $k);

            // Close 'More' menu
            $r .= '</div></div>';

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
     * @param $a
     * @param $t_type
     * @return string
     */
    public function getMenu($url, $a, $t_type):string
    {
        $t_id = $a[$t_type];
        $t_name = $this->getDefName($a, $t_type);
        $collection = $this->getCont($t_type);

        // Replace old id with new
        $url = preg_replace("/by_$t_type=\\d+&*/", '', $url);

        if ($url == 'performances' || $url == 'posters')
            $url .= '?';

        if ($url[strlen($url) - 1] != '?')
            $url .= '&';

        // Return menu
        $p = "<div class='btn-group dropdown' style='margin-right: 10px;'>  
            <a href='/$url$t_id' class='btn btn-primary'  data-hover='dropdown' >$t_name</a>
            <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
            <ul class='dropdown-menu' role='menu'>            
            ";

        $p .= '<li><a href="/'. rtrim($url, '?') . '" >'. trans('models.perf-none') . '</a>';
        $url .= 'by_' . $t_type . '=';

        if (is_array($collection))
            for ($i = 1 ; $i < count($collection)+1 ; $i++)
                $p .= "<li><a href='/$url$i'>".$collection[$i-1]."</a></li>";
        else
            foreach ($collection as $v)
                $p .= "<li><a href='/$url$v->id'>$v->name</a></li>";

        $p .= '</ul></div>';
        return $p;
    }

    private function hasOnePar(array $a): bool
    {
        $r = false;
        foreach($a as $k => $v)
            $r = $r || Request::has('by_' . $k);

        return $r;
    }

    /**
     * @param $a
     * @param $n
     * @return string
     */
    public function getDefName($a, $n):string
    {
        $i = $a[$n];
        if ($i > 0) {
            switch ($n) {
                case 'month': return trans('global.months')[$i-1];
                case 'type': return P_Type::findOrFail($i)->name;

                case 'theatre': return Theatre::findOrFail($i)->name;
                case 'name': return Performance::findOrFail($i)->name;
                case 'day': return trans('global.days')[$i-1];
                case 'time': return $this->getTimeCont()[$i-1];

                default:  return 'ERROR';
            }
        } else {
            return trans('models.perf-'. $n .'-default');
        }
    }

    /**
     * Get Array or Container for sort type
     *
     * @param $n
     * @return mixed
     */
    private function getCont($n)
    {
        switch ($n) {
            case 'month':   return trans('global.months');
            case 'type':    return P_Type::all();

            case 'theatre': return Theatre::all();
            case 'name':    return Performance::all();
            case 'day':     return trans('global.days');
            case 'time':    return $this->getTimeCont();

            default: return [];
        }
    }


    /**
     * Get all possible poster times for 'Time' sort
     *
     * @return array
     */
    private function getTimeCont()
    {
        $r = [];
        $a = DB::select('select distinct DATE_FORMAT(date, \'%H:%i\') AS \'time\' FROM posters');

        foreach($a as $v)
            $r[] = $v->time;

        return $r;
    }
}
