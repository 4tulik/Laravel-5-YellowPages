<?php
namespace App\Http\Controllers;

use DB;
use Psy\getAll;
use Input;
use Response;

class SearchController extends Controller {

    public function search(){

        $wojewodztwa = DB::table('terc')->where('pow', "=", 0)->where('gmi', "=", 0)->get();

        $id = array();
        foreach ($wojewodztwa as $key => $value) {
            $id[] = $value->woj;
        }
        foreach ($id as $key => $value) {
            $ilosc[$value] = DB::table('podmiot')->where('woj', $value)->count();
        }
        foreach ($id as $key => $value) {
            $ilosc[$value] = DB::table('podmiot')->where('woj', $value)->count();
        }

        $term = Input::get('query');
        $podmioty = DB::table('podmiot')->where('search', 'like', '%'.$term.'%')->paginate(15);

        return view('home',[
            'podmioty' => $podmioty,
            'wojewodztwa' => $wojewodztwa,
            'ilosc' => $ilosc]);
    }
    public function autocomplete(){

        $term = strtolower((Input::get('term')));
        $data = DB::table('podmiot')->select('search')->distinct()->where('search', 'like', '%'.$term.'%')->groupBy('search')->take(10)->get();

        foreach ($data as $key => $value) {

            $return_array[] = $value->search;
        }
        return Response::json($return_array);
    }
}
