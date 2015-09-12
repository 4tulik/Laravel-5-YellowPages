<?php
namespace App\Http\Controllers;

use DB;
use Psy\getAll;
use Input;
use View;

class ItemController extends Controller {

    public function index()
    {
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
        return view('home', [
            'wojewodztwa' => $wojewodztwa,
            'ilosc' => $ilosc]);

    }

    public function showPowiaty($woj=null){
        if(isset($woj)){
            $wojewodztwo = DB::table('terc')->where('woj', '=', $woj)->where('pow', "=", 0)->where('gmi', "=", 0)->first();
            $powiat = DB::table('terc')->where('woj', '=', $woj)->where('pow', "=", 0)->where('gmi', "=", 0)->first();
            $powiaty = DB::table('terc')->where('woj', "=", $woj)->where('gmi', "=", 0)->where('nazpod', "!=", 'miasto na prawach powiatu')->get();
            $miasta = DB::table('terc')->where('woj', "=", $woj)->where('gmi', "=", 0)->where('nazpod', "=", 'miasto na prawach powiatu')->get();
            $podmioty = DB::table('podmiot')->where('woj', $woj)->paginate(15);
            $id = array();
            foreach ($powiaty as $key => $value) {
                $id[] = $value->pow;
            }
            foreach ($miasta as $key => $value) {
                $id[] = $value->pow;
            }
            $ilosc = array();
            foreach ($id as $key => $value) {
                $ilosc[$value] = DB::table('podmiot')->where('woj', '=', $woj)->where('pow', $value)->count();
            }

            return view('home',[
                'wojewodztwo' => $wojewodztwo,
                'powiat' => $powiat,
                'powiaty' => $powiaty,
                'miasta' => $miasta,
                'podmioty' => $podmioty,
                'ilosc' => $ilosc]);
        }
    }
    public function showGminy($woj=null, $pow=null){
        if(isset($pow)){
            $wojewodztwo = DB::table('terc')->where('woj', '=', $woj)->where('pow', "=", 0)->where('gmi', "=", 0)->first();
            $powiat = DB::table('terc')->where('woj', '=', $woj)->where('pow', "=", 0)->where('gmi', "=", 0)->first();
            $powiaty = DB::table('terc')->where('woj', "=", $woj)->where('gmi', "=", 0)->where('nazpod', "!=", 'miasto na prawach powiatu')->get();
            $gminy = DB::table('terc')->where('woj', "=", $woj)->where('pow', $pow)->get();
            $miasta_gminy = DB::table('terc')->where('woj', "=", $woj)->where('gmi', "=", 0)->where('nazpod', "=", 'miasto na prawach powiatu')->get();
            $podmioty = DB::table('podmiot')->where('woj', $woj)->where('pow', $pow)->paginate(15);

            $iloscMiasta = array();
            foreach ($miasta_gminy as $key => $value) {
                $id_miasta[] = $value->pow;
            }
            foreach ($id_miasta as $key => $value) {
                $iloscMiasta[$value] = DB::table('podmiot')->where('woj', '=', $woj)->where('pow', $value)->count();
            }

            $id_gminy = array();
            foreach ($gminy as $key => $value) {
                $id_gminy[] = $value->gmi;
            }
            $iloscGminy = array();
            foreach ($id_gminy as $key => $value) {
                $iloscGminy[$value] = DB::table('podmiot')->where('woj', '=', $woj)->where('pow', $pow)->where('gmi', $value)->count();
            }

            return view('home',[
                'powiat' => $powiat,
                'gminy' => $gminy,
                'miasta_gminy' => $miasta_gminy,
                'podmioty' => $podmioty,
                'iloscMiasta' => $iloscMiasta,
                'iloscGminy' => $iloscGminy,

                ]); }
        }
        public function showGmina($woj=null,$pow=null, $gmi=null){
            if(isset($gmi)){
                $wojewodztwo = DB::table('terc')->where('woj', '=', $woj)->where('pow', "=", 0)->where('gmi', "=", 0)->first();
                $powiat = DB::table('terc')->where('woj', '=', $woj)->where('pow', "=", 0)->where('gmi', "=", 0)->first();
                $powiaty = DB::table('terc')->where('woj', "=", $woj)->where('gmi', "=", 0)->first();
                $gminy = DB::table('terc')->where('woj', "=", $woj)->where('pow', $pow)->get();
                $podmioty = DB::table('podmiot')->where('woj', $woj)->where('pow', $pow)->where('gmi', $gmi)->paginate(15);
                $id = array();
                foreach ($gminy as $key => $value) {
                    $id[] = $value->gmi;
                }
                $ilosc = array();
                foreach ($id as $key => $value) {
                    $ilosc[$value] = DB::table('podmiot')->where('woj', '=', $woj)->where('pow', $pow)->where('gmi', $value)->count();
                }
                $where = "AND pow = $pow";
                $id_gminy = array();
                foreach ($gminy as $key => $value) {
                    $id_gminy[] = $value->gmi;
                }
                $iloscGminy = array();
                foreach ($id_gminy as $key => $value) {
                    $iloscGminy[$value] = DB::table('podmiot')->where('woj', '=', $woj)->where('pow', $pow)->where('gmi', $value)->count();
                }
                return view('home',[
                    'powiat' => $powiat,
                    'gminy' => $gminy,
                    'podmioty' => $podmioty,
                    'iloscGminy' => $iloscGminy,
                    ]); }
            }
            public function showItem(\App\Models\Podmiot $item, $slug)
            {
              $id = substr($slug, -7);
              $podmiot=$item->find($id);
              $miejscowosc='';
              $ulica='';
              $nr_domu='';
              if(isset($podmiot->miejscowosc))
                $miejscowosc=$podmiot->miejscowosc;
              if(isset($podmiot->ulica))
                $ulica=$podmiot->ulica;
              if(isset($podmiot->nr_domu))
                $nr_domu=$podmiot->nr_domu;
              $jsonMap = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=Polska+$miejscowosc+$ulica+$nr_domu&key=AIzaSyAACLJzwQ2tDvgBHkwIkoOxh7dxJawN6U0");    // Get all reviews that are not spam for the product and paginate them
              $jsonMap = json_decode($jsonMap);
              $jsonMap = $jsonMap->results[0];
              $location = $jsonMap->geometry->location;

              $reviews = $podmiot->reviews()
                  ->with('user')
                  ->approved()->notSpam()
                  ->orderBy('created_at','desc')
                  ->paginate(100);

              $wojewodztwa = DB::table('terc')
                  ->where('pow', "=", 0)
                  ->where('gmi', "=", 0)
                  ->get();


              $id = array();
              foreach ($wojewodztwa as $key => $value) {
                 $id[] = $value->woj;
              }
              foreach ($id as $key => $value) {
                  $ilosc[$value] = DB::table('podmiot')
                  ->where('woj', $value)->count();
              }
              foreach ($id as $key => $value) {
                  $ilosc[$value] = DB::table('podmiot')
                  ->where('woj', $value)->count();
              }

              return View::make('home',
                array('podmiot'=>$podmiot,
                  'reviews'=>$reviews),
                [ 'wojewodztwa' => $wojewodztwa,
                  'ilosc' => $ilosc,
                  'location' => $location ]);
            }
            public function addItem(\App\Models\Podmiot $request){

                $data = $request->all();

                $category = \App\Models\Podmiot::create($data);

                return $this->redirect('additem');
            }
}
