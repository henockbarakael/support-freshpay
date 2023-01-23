<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\AirtelController;
use App\Http\Controllers\API\MpesaController;
use App\Http\Controllers\API\OrangeController;
use App\Models\Contact;
use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        ini_set('max_execution_time', 300);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('Y-m-d H:i:s');
        return $todayDate;
    }

    public function index(){
        $contacts = Contact::all();
        return view("index", compact('contacts'));
    }

    public function merchantStatistiques(){
        $statistique = Http::get('http://127.0.0.1:8086/services/paydrc/merchant_stat');
        $result = $statistique->json();
        $todayDate = $this->todayDate();
        return view("api.statistique", compact('result','todayDate'));
    }

    public function bulkSelect(Request $request){
        $contact_ids = explode(",",$request->ids);
        $contacts = Contact::whereIn('id', $contact_ids)->get();
        return response()->json(['view' => view("bulk-update", compact('contacts'))->render(),'status'=>true,'donnee'=>$contacts,'message'=>"Transaction deleted successfully."]);
    }

    public function updateSelected(){
        $contact_ids = Session::get('contact_ids');
        $contacts = Contact::whereIn('id', $contact_ids)->get();
        return view("bulk-update", compact('contacts'));
    }

    public function updateAll(Request $request){
        $ids = $request->input('contact_id');
        $email_addresses = $request->input('email_address');
        $contact_numbers = $request->input('contact_number');
        $contact_types = $request->input('contact_type');

        foreach($ids as $k => $id){
            $values = array(
                'email_address' => $email_addresses[$k],
                'phone_number' => $contact_numbers[$k],
                'type' => $contact_types[$k],
            );

        DB::table('contacts')->where('id','=',$id)->update($values);

        }
        return redirect()->back()->with('success', true);
    }
    public function admin()
    {
        $statistique = Http::get('http://143.198.138.97/services/paydrc/statistiques');

        $res = $statistique->json();
                
        if ($res["mpesa_payout"] == null) {
            $credit_mpesa_success = 0;
            $credit_mpesa_submitted = 0;
            $credit_mpesa_pending = 0;
            $credit_mpesa_failed = 0;
        } else {
            $credit_mpesa_success = $res["mpesa_payout"][0]["success"];
            $credit_mpesa_submitted = $res["mpesa_payout"][0]["submitted"];
            $credit_mpesa_pending = $res["mpesa_payout"][0]["pending"];
            $credit_mpesa_failed = $res["mpesa_payout"][0]["failed"];
        }

        if ($res["orange_payout"] == null) {
            $credit_orange_success = 0;
            $credit_orange_submitted = 0;
            $credit_orange_pending = 0;
            $credit_orange_failed = 0;
        } else {
            $credit_orange_success = $res["orange_payout"][0]["success"];
            $credit_orange_submitted = $res["orange_payout"][0]["submitted"];
            $credit_orange_pending = $res["orange_payout"][0]["pending"];
            $credit_orange_failed = $res["orange_payout"][0]["failed"];
        }

        if ($res["airtel_payout"] == null) {
            $credit_airtel_success = 0;
            $credit_airtel_submitted = 0;
            $credit_airtel_pending = 0;
            $credit_airtel_failed = 0;
        } else {
            $credit_airtel_success = $res["airtel_payout"][0]["success"];
            $credit_airtel_submitted = $res["airtel_payout"][0]["submitted"];
            $credit_airtel_pending = $res["airtel_payout"][0]["pending"];
            $credit_airtel_failed = $res["airtel_payout"][0]["failed"];
        }

        if ($res["mpesa_charge"] == null) {
            $debit_mpesa_success = 0;
            $debit_mpesa_submitted = 0;
            $debit_mpesa_pending = 0;
            $debit_mpesa_failed = 0;
        } else {
            $debit_mpesa_success = $res["mpesa_charge"][0]["success"];
            $debit_mpesa_submitted = $res["mpesa_charge"][0]["submitted"];
            $debit_mpesa_pending = $res["mpesa_charge"][0]["pending"];
            $debit_mpesa_failed = $res["mpesa_charge"][0]["failed"];
        }

        if ($res["orange_charge"] == null) {
            $debit_orange_success = 0;
            $debit_orange_submitted = 0;
            $debit_orange_pending = 0;
            $debit_orange_failed = 0;
        } else {
            $debit_orange_success = $res["orange_charge"][0]["success"];
            $debit_orange_submitted = $res["orange_charge"][0]["submitted"];
            $debit_orange_pending = $res["orange_charge"][0]["pending"];
            $debit_orange_failed = $res["orange_charge"][0]["failed"];
        }

        if ($res["airtel_charge"] == null) {
            $debit_airtel_success = 0;
            $debit_airtel_submitted = 0;
            $debit_airtel_pending = 0;
            $debit_airtel_failed = 0;
        } else {
            $debit_airtel_success = $res["airtel_charge"][0]["success"];
            $debit_airtel_submitted = $res["airtel_charge"][0]["submitted"];
            $debit_airtel_pending = $res["airtel_charge"][0]["pending"];
            $debit_airtel_failed = $res["airtel_charge"][0]["failed"];
        }


        return view('dashboard.admin', compact(
            'credit_airtel_success','credit_orange_success','credit_mpesa_success',
            'debit_airtel_success','debit_orange_success','debit_mpesa_success',

            'credit_airtel_failed','credit_orange_failed','credit_mpesa_failed',
            'debit_airtel_failed','debit_orange_failed','debit_mpesa_failed',

            'credit_airtel_pending','credit_orange_pending','credit_mpesa_pending',
            'debit_airtel_pending','debit_orange_pending','debit_mpesa_pending',

            'credit_airtel_submitted','credit_orange_submitted','credit_mpesa_submitted',
            'debit_airtel_submitted','debit_orange_submitted','debit_mpesa_submitted'
        ));

    }

    public function finance()
    {
        return view('dashboard.finance');
    }

    public function manager()
    {
        $statistique = Http::get('http://127.0.0.1:8086/services/management/revenu');
        $success = Http::get('http://127.0.0.1:8086/services/paydrc/successful/sum_amount');

        $res = $statistique->json();
        $stmt = $success->json();

        if ($stmt["total_cdf"]== null) {
            $success_cdf = 0;
        }
        
        else{
            $success_cdf = $stmt["total_cdf"][0]["montant"];
        }

        if ($stmt["total_usd"]== null) {
            $success_usd = 0;
        }
        
        else{
            $success_usd = $stmt["total_usd"][0]["montant"];
        }

        if ($res["airtel_cdf"]== null) {
            $freshpay_airtel_cdf = 0;
            $telco_airtel_cdf = 0;
        }
        
        else{
            $freshpay_airtel_cdf = $res["airtel_cdf"][0]["freshpay"];
            $telco_airtel_cdf = $res["airtel_cdf"][0]["telco"];
        }
        
        if ($res["orange_cdf"] == null) {
            $freshpay_orange_cdf = 0;
            $telco_orange_cdf = 0;
        }
        else{
            $freshpay_orange_cdf = $res["orange_cdf"][0]["freshpay"];
            $telco_orange_cdf = $res["orange_cdf"][0]["telco"];
        }
        
        if ($res["vodacom_cdf"] == null) {
            $freshpay_vodacom_cdf = 0;
            $telco_vodacom_cdf = 0;
        }
        else{
            $freshpay_vodacom_cdf = $res["vodacom_cdf"][0]["freshpay"];
            $telco_vodacom_cdf = $res["vodacom_cdf"][0]["telco"];
        }
  
        if ($res["airtel_usd"]== null) {
            $freshpay_airtel_usd = 0;
            $telco_airtel_usd = 0;
        }

        else{
            $freshpay_airtel_usd = $res["airtel_usd"][0]["freshpay"];
            $telco_airtel_usd = $res["airtel_usd"][0]["telco"];
        }

        if ($res["orange_usd"] == null) {
            $freshpay_orange_usd = 0;
            $telco_orange_usd = 0;
        }
        else{
            $freshpay_orange_usd = $res["orange_usd"][0]["freshpay"];
            $telco_orange_usd = $res["orange_usd"][0]["telco"];
        }

        if ($res["vodacom_usd"] == null) {
            $freshpay_vodacom_usd = 0;
            $telco_vodacom_usd = 0;
        }
        else{
            $freshpay_vodacom_usd = $res["vodacom_usd"][0]["freshpay"];
            $telco_vodacom_usd = $res["vodacom_usd"][0]["telco"];
        }

        

        return view('dashboard.manager', compact(
            'freshpay_airtel_cdf',
            'freshpay_airtel_usd',
            'freshpay_orange_cdf',
            'freshpay_orange_usd',
            'freshpay_vodacom_cdf',
            'freshpay_vodacom_usd',

            'telco_airtel_cdf',
            'telco_airtel_usd',
            'telco_orange_cdf',
            'telco_orange_usd',
            'telco_vodacom_cdf',
            'telco_vodacom_usd',
            'success_cdf',
            'success_usd'
        ));
    }

    public function support_1()
    {
        return view('dashboard.support.level_1');
    }

    public function support_2()
    {
        return view('dashboard.support.level_2');
    }

    public function support_3()
    {
        return view('dashboard.support.level_3');
    }
}
