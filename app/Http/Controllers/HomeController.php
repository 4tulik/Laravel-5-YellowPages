<?php namespace App\Http\Controllers;

use DB;
use Psy\getAll;

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
		$wojewodztwa = DB::table('wojewodztwo')->get();

		$id = array();
		foreach ($wojewodztwa as $key => $value) {
			$id[] = $value->id;
		}
		foreach ($id as $key => $value) {
			$ilosc[$value] = DB::table('podmiot')->where('wojewodztwo_id', $value)->count();
		}
		foreach ($id as $key => $value) {
			$ilosc[$value] = DB::table('podmiot')->where('wojewodztwo_id', $value)->count();
		}
		$sql = "SELECT\n"
		. " COUNT(*) AS podmioty_ilosc, miejscowosc\n"
		. "FROM podmiot\n"
		. "WHERE miejscowosc IS NOT NULL\n"
		. "GROUP By miejscowosc\n"
		. "ORDER BY podmioty_ilosc DESC LIMIT 0, 5 ";
		$miejscowosci = DB::select( DB::raw($sql) );

		return view('home', [
			'miejscowosci' => $miejscowosci,
			'wojewodztwa' => $wojewodztwa,
			'ilosc' => $ilosc]);

	}
	public function showPowiaty($woj=null){
		if(isset($woj)){
			$wojewodztwo = DB::table('wojewodztwo')->where('id', $woj)->first();
			$powiat = DB::table('powiat')->where('wojewodztwo_id', $woj)->first();
			$powiaty = DB::table('powiat')->where('wojewodztwo_id', $woj)->get();
			$podmioty = DB::table('podmiot')->where('wojewodztwo_id', $woj)->paginate(15);
			$id = array();
			foreach ($powiaty as $key => $value) {
				$id[] = $value->id;
			}
			$ilosc = array();
			foreach ($id as $key => $value) {
				$ilosc[$value] = DB::table('podmiot')->where('powiat_id', $value)->count();
			}
		//	var_dump($wojewodztwo);
		//	die();
			return view('home',[
				'wojewodztwo' => $wojewodztwo,
				'powiat' => $powiat,
				'powiaty' => $powiaty,
				'podmioty' => $podmioty,
				'ilosc' => $ilosc]);
		}
	}
	public function showGminy($woj=null, $pow=null){
		if(isset($pow)){
			$powiat_wojewodztwo = DB::table('wojewodztwo')->where('id', $woj)->first();
			$powiat = DB::table('powiat')->where('id', $pow)->first();
			$gminy = DB::table('gmina')->where('powiat_id', $pow)->get();
			$podmioty = DB::table('podmiot')->where('powiat_id', $pow)->paginate(15);
			$id = array();
			foreach ($gminy as $key => $value) {
				$id[] = $value->id;
			}
			$ilosc = array();
			foreach ($id as $key => $value) {
				$ilosc[$value] = DB::table('podmiot')->where('gmina_id', $value)->count();
			}
			return view('home',[
				'powiat_wojewodztwo' => $powiat_wojewodztwo,
				'powiat' => $powiat,
				'gminy' => $gminy,
				'podmioty' => $podmioty,
				'ilosc' => $ilosc]);
		}
	}
	public function showGmina($pow=null, $gmi=null){
		$gminy = DB::table('gmina')->where('powiat_id', $pow)->get();
		$podmioty = DB::table('podmiot')->where('gmina_id', $gmi)->paginate(15);
		$id = array();
		foreach ($gminy as $key => $value) {
			$id[] = $value->id;
		}
		$ilosc = array();
		foreach ($id as $key => $value) {
			$ilosc[$value] = DB::table('podmiot')->where('gmina_id', $value)->count();
		}

		return view('home', ['gminy' => $gminy,
			'podmioty' => $podmioty,
			'ilosc' => $ilosc
			]);
	}
	// function showMiasta(){

	// 	return $miescowoscPodmioty = DB::table('podmioty')
 //                 ->select('miejscowosc', DB::raw('count(*) as total'))
 //                 ->groupBy('miejscowosc')
 //                 ->take(5);

	// }
}
	// public function showUlice($gmi=null){
	// 		$ulice = DB::table('ulica')->where('gmina_id', $gmi)->get();
	// 		$podmioty = DB::table('podmiot')->where('gmina_id', $gmi)->paginate(15);
	// 		$id = array();
	// 		foreach ($ulice as $key => $value) {
	// 			$id[] = $value->id;
	// 		}
	// 		$ilosc = array();
	// 		foreach ($id as $key => $value) {
	// 			$ilosc[$value] = DB::table('podmiot')->where('ulica_id', $value)->count();
	// 		}
	// 		return view('home', ['ulice' => $ulice,
	// 			'podmioty' => $podmioty,
	// 			'ilosc' => $ilosc
	// 			]);
	// }
