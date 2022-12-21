<?php

namespace App\Http\Controllers;

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

    public function index(){
        $contacts = Contact::all();
        return view("index", compact('contacts'));
    }

    public function bulkSelect(Request $request){

        $contact_ids = explode(",",$request->ids);
     
        $contacts = Contact::whereIn('id', $contact_ids)->get();

        return response()->json(['view' => view("bulk-update", compact('contacts'))->render(),'status'=>true,'donnee'=>$contacts,'message'=>"Transaction deleted successfully."]);

        // return view("bulk-update", compact('contacts'));

    }

    public function updateSelected(){

        $contact_ids = Session::get('contact_ids');
        $contacts = Contact::whereIn('id', $contact_ids)->get();
        return view("bulk-update", compact('contacts'));

    }

    public function updateAll(Request $request)

    {

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
    public function airtel_debit(){
        $totals = DB::table('drc_send_money_transac')
        // ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'Successful' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'airtel' then 1 end) as success")
        ->selectRaw("count(case when status = 'Failed' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'airtel' then 1 end) as failed")
        ->selectRaw("count(case when status = 'Pending' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'airtel' then 1 end) as pending")
        ->selectRaw("count(case when status = 'Submitted' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'airtel' then 1 end) as submitted")
        ->first();
        return $totals;
    }
    public function orange_debit(){
        $totals = DB::table('drc_send_money_transac')
        // ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'Successful' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as success")
        ->selectRaw("count(case when status = 'Failed' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as failed")
        ->selectRaw("count(case when status = 'Pending' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as pending")
        ->selectRaw("count(case when status = 'Submitted' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as submitted")
        ->first();
        return $totals;
    }
    public function mpesa_debit(){
        $totals = DB::table('drc_send_money_transac')
        // ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'Successful' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'mpesa' then 1 end) as success")
        ->selectRaw("count(case when status = 'Failed' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'mpesa' then 1 end) as failed")
        ->selectRaw("count(case when status = 'Pending' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'mpesa' then 1 end) as pending")
        ->selectRaw("count(case when status = 'Submitted' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'mpesa' then 1 end) as submitted")
        ->first();
        return $totals;
    }
    public function admin()
    {

       $airtel = $this->airtel_debit();
       $orange = $this->orange_debit();
       $mpesa = $this->mpesa_debit();

       $tt = [$airtel,$orange,$mpesa];

        dd($tt);
        
        $client = new Client();
        $response = $client->request('GET','http://167.71.131.224:4500/services/daily_transactions', ['timeout' => 60000]);
        $responseBody = json_decode($response->getBody(), true);
        $airtel_charge = $responseBody["airtel_charge"];
        $orange_charge = $responseBody["orange_charge"];
        $vodacom_charge = $responseBody["vodacom_charge"];
        $airtel_payout = $responseBody["airtel_payout"];
        $orange_payout = $responseBody["orange_payout"];
        $vodacom_payout = $responseBody["vodacom_payout"];
        $global_payout = $responseBody["global_payout"];
        $global_charge = $responseBody["global_charge"];


        if ($global_payout == null) {
            $credit_success = 0;
            $credit_failed = 0;
            $credit_pending = 0;
            $credit_submitted = 0;
        }
        else {
            foreach ($global_payout as $key => $value) {
                $data_2[] = $value["status"];
                $credit = array_count_values($data_2);
            }
            if (array_key_exists('Successful', $credit)) {
                $credit_success = $credit["Successful"];
            }
            else {
                $credit_success = 0;
            }
            if (array_key_exists('Failed', $credit)) {
                $credit_failed = $credit["Failed"];
            }
            else {
                $credit_failed = 0;
            }
            if (array_key_exists('Pending', $credit)) {
                $credit_pending = $credit["Pending"];
            }
            else {
                $credit_pending = 0;
            }
            if (array_key_exists('Submitted', $credit)) {
                $credit_submitted = $credit["Submitted"];
            }
            else {
                $credit_submitted = 0;
            }
            $total_payout = $credit_submitted + $credit_failed + $credit_pending + $credit_success;
            $percent_success_payout = number_format(($credit_success * 100) / ($total_payout),2);
            $percent_pending_payout =number_format(($credit_pending * 100) / ($total_payout),2);
            $percent_failed_payout = number_format(($credit_failed * 100) / ($total_payout),2);
            $percent_submitted_payout = number_format(($credit_submitted * 100) / ($total_payout),2);
        }

        if ($vodacom_payout == null) {
            $credit_vodacom_success = 0;
            $credit_vodacom_failed = 0;
            $credit_vodacom_pending = 0;
            $credit_vodacom_submitted = 0;

            $total_vodacom_charge = $credit_vodacom_submitted + $credit_vodacom_failed + $credit_vodacom_pending + $credit_vodacom_success;
            $p_vcredit_success = 0;
            $p_vcredit_pending = 0;
            $p_vcredit_failed = 0;
            $p_vcredit_submitted = 0;
        }
        else {
            foreach ($vodacom_payout as $key => $value) {
                $data_3[] = $value["status"];
                $vodacomp = array_count_values($data_3);
            }
            if (array_key_exists('Successful', $vodacomp)) {
                $credit_vodacom_success = $vodacomp["Successful"];
            }
            else {
                $credit_vodacom_success = 0;
            }
            if (array_key_exists('Failed', $vodacomp)) {
                $credit_vodacom_failed = $vodacomp["Failed"];
            }
            else {
                $credit_vodacom_failed = 0;
            }
            if (array_key_exists('Pending', $vodacomp)) {
                $credit_vodacom_pending = $vodacomp["Pending"];
            }
            else {
                $credit_vodacom_pending = 0;
            }
            if (array_key_exists('Submitted', $vodacomp)) {
                $credit_vodacom_submitted = $vodacomp["Submitted"];
            }
            else {
                $credit_vodacom_submitted = 0;
            }
            $total_vodacom_charge = $credit_vodacom_submitted + $credit_vodacom_failed + $credit_vodacom_pending + $credit_vodacom_success;
            if ($total_vodacom_charge == 0) {
                $p_vcredit_success = number_format(($credit_vodacom_success * 100),2);
            $p_vcredit_pending =number_format(($credit_vodacom_pending * 100),2);
            $p_vcredit_failed = number_format(($credit_vodacom_failed * 100),2);
            $p_vcredit_submitted = number_format(($credit_vodacom_submitted * 100),2);
            }
            else {
                $p_vcredit_success = number_format(($credit_vodacom_success * 100) / ($total_vodacom_charge),2);
            $p_vcredit_pending =number_format(($credit_vodacom_pending * 100) / ($total_vodacom_charge),2);
            $p_vcredit_failed = number_format(($credit_vodacom_failed * 100) / ($total_vodacom_charge),2);
            $p_vcredit_submitted = number_format(($credit_vodacom_submitted * 100) / ($total_vodacom_charge),2);
            }
            
        }

        if ($airtel_payout == null) {
            $credit_airtel_success = 0;
            $credit_airtel_failed = 0;
            $credit_airtel_pending = 0;
            $credit_airtel_submitted = 0;

            $p_acredit_success = 0;
            $p_acredit_pending = 0;
            $p_acredit_failed = 0;
            $p_acredit_submitted = 0;
        }
        else {
            foreach ($airtel_payout as $key => $value) {
                $data_4[] = $value["status"];
                $airtelp = array_count_values($data_4);
            }
            if (array_key_exists('Successful', $airtelp)) {
                $credit_airtel_success = $airtelp["Successful"];
            }
            else {
                $credit_airtel_success = 0;
            }
            if (array_key_exists('Failed', $airtelp)) {
                $credit_airtel_failed = $airtelp["Failed"];
            }
            else {
                $credit_airtel_failed = 0;
            }
            if (array_key_exists('Pending', $airtelp)) {
                $credit_airtel_pending = $airtelp["Pending"];
            }
            else {
                $credit_airtel_pending = 0;
            }
            if (array_key_exists('Submitted', $airtelp)) {
                $credit_airtel_submitted = $airtelp["Submitted"];
            }
            else {
                $credit_airtel_submitted = 0;
            }
            $total_airtel_charge = $credit_airtel_submitted + $credit_airtel_failed + $credit_airtel_pending + $credit_airtel_success;
            $p_acredit_success = number_format(($credit_airtel_success * 100) / ($total_airtel_charge),2);
            $p_acredit_pending =number_format(($credit_airtel_pending * 100) / ($total_airtel_charge),2);
            $p_acredit_failed = number_format(($credit_airtel_failed * 100) / ($total_airtel_charge),2);
            $p_acredit_submitted = number_format(($credit_airtel_submitted * 100) / ($total_airtel_charge),2);
        }

        if ($orange_payout == null) {
            $credit_orange_success = 0;
            $credit_orange_failed = 0;
            $credit_orange_pending = 0;
            $credit_orange_submitted = 0;
            $p_ocredit_success = 0;
            $p_ocredit_pending = 0;
            $p_ocredit_failed = 0;
            $p_ocredit_submitted = 0;
        }
        else {
            foreach ($orange_payout as $key => $value) {
                $data_5[] = $value["status"];
                $orangep = array_count_values($data_5);
            }
            if (array_key_exists('Successful', $orangep)) {
                $credit_orange_success = $orangep["Successful"];
            }
            else {
                $credit_orange_success = 0;
            }
            if (array_key_exists('Failed', $orangep)) {
                $credit_orange_failed = $orangep["Failed"];
            }
            else {
                $credit_orange_failed = 0;
            }
            if (array_key_exists('Pending', $orangep)) {
                $credit_orange_pending = $orangep["Pending"];
            }
            else {
                $credit_orange_pending = 0;
            }
            if (array_key_exists('Submitted', $orangep)) {
                $credit_orange_submitted = $orangep["Submitted"];
            }
            else {
                $credit_orange_submitted = 0;
            }
            $total_orange_charge = $credit_orange_submitted + $credit_orange_failed + $credit_orange_pending + $credit_orange_success;
            $p_ocredit_success = number_format(($credit_orange_success * 100) / ($total_orange_charge),2);
            $p_ocredit_pending =number_format(($credit_orange_pending * 100) / ($total_orange_charge),2);
            $p_ocredit_failed = number_format(($credit_orange_failed * 100) / ($total_orange_charge),2);
            $p_ocredit_submitted = number_format(($credit_orange_submitted * 100) / ($total_orange_charge),2);
        }

        ####################################################################################################"

        if ($global_charge == null) {
            $debit_success = 0;
            $debit_failed = 0;
            $debit_pending = 0;
            $debit_submitted = 0;
            
        }
        else {
            foreach ($global_charge as $key => $value) {
                $result_2[] = $value["status"];
                $debit = array_count_values($result_2);
            }
            if (array_key_exists('Successful', $debit)) {
                $debit_success = $debit["Successful"];
            }
            else {
                $debit_success = 0;
            }
            if (array_key_exists('Failed', $debit)) {
                $debit_failed = $debit["Failed"];
            }
            else {
                $debit_failed = 0;
            }
            if (array_key_exists('Pending', $debit)) {
                $debit_pending = $debit["Pending"];
            }
            else {
                $debit_pending = 0;
            }
            if (array_key_exists('Submitted', $debit)) {
                $debit_submitted = $debit["Submitted"];
            }
            else {
                $debit_submitted = 0;
            }
            $total_charge = $debit_submitted + $debit_failed + $debit_pending + $debit_success;
            $percent_success = number_format(($debit_success * 100) / ($total_charge),2);
            $percent_pending =number_format(($debit_pending * 100) / ($total_charge),2);
            $percent_failed = number_format(($debit_failed * 100) / ($total_charge),2);
            $percent_submitted = number_format(($debit_submitted * 100) / ($total_charge),2);
        }

        if ($vodacom_charge == null) {
            $debit_vodacom_success = 0;
            $debit_vodacom_failed = 0;
            $debit_vodacom_pending = 0;
            $debit_vodacom_submitted = 0;

            $p_vdebit_success = 0;
            $p_vdebit_pending = 0;
            $p_vdebit_failed = 0;
            $p_vdebit_submitted = 0;
        }
        else {
            foreach ($vodacom_charge as $key => $value) {
                $result_3[] = $value["status"];
                $vodacom = array_count_values($result_3);
            }
            if (array_key_exists('Successful', $vodacom)) {
                $debit_vodacom_success = $vodacom["Successful"];
            }
            else {
                $debit_vodacom_success = 0;
            }
            if (array_key_exists('Failed', $vodacom)) {
                $debit_vodacom_failed = $vodacom["Failed"];
            }
            else {
                $debit_vodacom_failed = 0;
            }
            if (array_key_exists('Pending', $vodacom)) {
                $debit_vodacom_pending = $vodacom["Pending"];
            }
            else {
                $debit_vodacom_pending = 0;
            }
            if (array_key_exists('Submitted', $vodacom)) {
                $debit_vodacom_submitted = $vodacom["Submitted"];
            }
            else {
                $debit_vodacom_submitted = 0;
            }
            $total_mpesa_charge = $debit_vodacom_submitted + $debit_vodacom_failed + $debit_vodacom_pending + $debit_vodacom_success;
            if ($total_mpesa_charge == 0) {
                $p_vdebit_success = number_format(($debit_vodacom_success * 100),2);
            $p_vdebit_pending =number_format(($debit_vodacom_pending * 100),2);
            $p_vdebit_failed = number_format(($debit_vodacom_failed * 100),2);
            $p_vdebit_submitted = number_format(($debit_vodacom_submitted * 100),2);
            }
            else {
                $p_vdebit_success = number_format(($debit_vodacom_success * 100) / ($total_mpesa_charge),2);
            $p_vdebit_pending =number_format(($debit_vodacom_pending * 100) / ($total_mpesa_charge),2);
            $p_vdebit_failed = number_format(($debit_vodacom_failed * 100) / ($total_mpesa_charge),2);
            $p_vdebit_submitted = number_format(($debit_vodacom_submitted * 100) / ($total_mpesa_charge),2);
            }
            
        }

        if ($airtel_charge == null) {
            $debit_airtel_success = 0;
            $debit_airtel_failed = 0;
            $debit_airtel_pending = 0;
            $debit_airtel_submitted = 0;
            $p_adebit_success = 0;
            $p_adebit_pending = 0;
            $p_adebit_failed = 0;
            $p_adebit_submitted = 0;
        }
        else {
            foreach ($airtel_charge as $key => $value) {
                $result_4[] = $value["status"];
                $airtel = array_count_values($result_4);
            }
            if (array_key_exists('Successful', $airtel)) {
                $debit_airtel_success = $airtel["Successful"];
            }
            else {
                $debit_airtel_success = 0;
            }
            if (array_key_exists('Failed', $airtel)) {
                $debit_airtel_failed = $airtel["Failed"];
            }
            else {
                $debit_airtel_failed = 0;
            }
            if (array_key_exists('Pending', $airtel)) {
                $debit_airtel_pending = $airtel["Pending"];
            }
            else {
                $debit_airtel_pending = 0;
            }
            if (array_key_exists('Submitted', $airtel)) {
                $debit_airtel_submitted = $airtel["Submitted"];
            }
            else {
                $debit_airtel_submitted = 0;
            }
            $total_airtel_charge = $debit_airtel_submitted + $debit_airtel_failed + $debit_airtel_pending + $debit_airtel_success;
            $p_adebit_success = number_format(($debit_airtel_success * 100) / ($total_airtel_charge),2);
            $p_adebit_pending =number_format(($debit_airtel_pending * 100) / ($total_airtel_charge),2);
            $p_adebit_failed = number_format(($debit_airtel_failed * 100) / ($total_airtel_charge),2);
            $p_adebit_submitted = number_format(($debit_airtel_submitted * 100) / ($total_airtel_charge),2);
        }

        if ($orange_charge == null) {
            $debit_orange_success = 0;
            $debit_orange_failed = 0;
            $debit_orange_pending = 0;
            $debit_orange_submitted = 0;
            $p_odebit_success = 0;
            $p_odebit_pending = 0;
            $p_odebit_failed = 0;
            $p_odebit_submitted = 0;
        }
        else {
            foreach ($orange_charge as $key => $value) {
                $result_5[] = $value["status"];
                $orange = array_count_values($result_5);
            }
            if (array_key_exists('Successful', $orange)) {
                $debit_orange_success = $orange["Successful"];
            }
            else {
                $debit_orange_success = 0;
            }
            if (array_key_exists('Failed', $orange)) {
                $debit_orange_failed = $orange["Failed"];
            }
            else {
                $debit_orange_failed = 0;
            }
            if (array_key_exists('Pending', $orange)) {
                $debit_orange_pending = $orange["Pending"];
            }
            else {
                $debit_orange_pending = 0;
            }
            if (array_key_exists('Submitted', $orange)) {
                $debit_orange_submitted = $orange["Submitted"];
            }
            else {
                $debit_orange_submitted = 0;
            }
            $total_orange_charge = $debit_orange_submitted + $debit_orange_failed + $debit_orange_pending + $debit_orange_success;
            $p_odebit_success = number_format(($debit_orange_success * 100) / ($total_orange_charge),2);
            $p_odebit_pending =number_format(($debit_orange_pending * 100) / ($total_orange_charge),2);
            $p_odebit_failed = number_format(($debit_orange_failed * 100) / ($total_orange_charge),2);
            $p_odebit_submitted = number_format(($debit_orange_submitted * 100) / ($total_orange_charge),2);
        }


        $hour = DrcSendMoneyTransac::select(DB::raw("Hour(created_at) as hour"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('hour');
        $_orange_credit = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'credit')
                ->where('method', 'orange')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');

        $_orange_debit = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'debit')
                ->where('method', 'orange')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');

        $_airtel_debit = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'debit')
                ->where('method', 'airtel')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');

        $_vodacom_debit = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'mpesa')
                ->where('method', 'orange')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');

                $_success = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'mpesa')
                ->where('method', 'orange')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');

        return view('dashboard.admin', compact(
            'hour','_orange_debit','_airtel_debit','_vodacom_debit',
            'percent_success','percent_failed','percent_pending','percent_submitted',
            'percent_success_payout','percent_failed_payout','percent_pending_payout','percent_submitted_payout',
            'p_odebit_success','p_odebit_failed','p_odebit_pending','p_odebit_submitted',
            'p_vdebit_success','p_vdebit_failed','p_vdebit_pending','p_vdebit_submitted',
            'p_adebit_success','p_adebit_failed','p_adebit_pending','p_adebit_submitted',
            'p_ocredit_success','p_ocredit_failed','p_ocredit_pending','p_ocredit_submitted',
            'p_vcredit_success','p_vcredit_failed','p_vcredit_pending','p_vcredit_submitted',
            'p_acredit_success','p_acredit_failed','p_acredit_pending','p_acredit_submitted',
            'debit_success','debit_failed','debit_pending','debit_submitted',
            'debit_airtel_success','debit_airtel_failed','debit_airtel_pending','debit_airtel_submitted',
            'debit_orange_success','debit_orange_failed','debit_orange_pending','debit_orange_submitted',
            'debit_vodacom_success','debit_vodacom_failed','debit_vodacom_pending','debit_vodacom_submitted',
            'credit_success','credit_failed','credit_pending','credit_submitted',
            'credit_airtel_success','credit_airtel_failed','credit_airtel_pending','credit_airtel_submitted',
            'credit_orange_success','credit_orange_failed','credit_orange_pending','credit_orange_submitted',
            'credit_vodacom_success','credit_vodacom_failed','credit_vodacom_pending','credit_vodacom_submitted',
        ));
    }

    public function finance()
    {
        return view('dashboard.finance');
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
