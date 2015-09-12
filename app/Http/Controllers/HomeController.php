<?php
namespace App\Http\Controllers;

use DB;
use Psy\getAll;
use Input;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth');
	}

	/*
	* Show the application dashboard to the user.
	*
	* @return Response
	*/
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
			private	function showMiejscowsci($string){
				$sql = "SELECT\n"
				. " COUNT(*) AS podmioty_ilosc, miejscowosc\n"
				. "FROM podmiot\n"
				. "WHERE miejscowosc IS NOT NULL $string \n"
				. "GROUP By miejscowosc\n"
				. "ORDER BY podmioty_ilosc DESC LIMIT 0, 5 ";
				return $miejscowosci = DB::select( DB::raw($sql) );
			}
		}
