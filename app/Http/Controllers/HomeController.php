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
    public function admin()
    {

        $test = DrcSendMoneyTransac::select('status','action','method', DB::raw('count(*) as total'))
        ->whereDate('created_at', Carbon::today()->toDateString())->groupBy('action','status','method')
        ->get();

        $all = DrcSendMoneyTransac::select('status','action', DB::raw('count(*) as total'))
        ->whereDate('created_at', Carbon::today()->toDateString())->groupBy('action','status','method')
        ->get();

        $credit_airtel_success = 0;
            $credit_airtel_failed = 0;
            $credit_airtel_pending = 0;
            $credit_airtel_submitted = 0;

            $p_acredit_success = 0;
            $p_acredit_pending = 0;
            $p_acredit_failed = 0;
            $p_acredit_submitted = 0;


        $debit_pending = 0;
        $debit_submitted = 0;
        $debit_success = 0;
        $debit_failed = 0;

        $credit_pending = 0;
        $credit_submitted = 0;
        $credit_success = 0;
        $credit_failed = 0;

        $debit_airtel_pending = 0;
        $debit_airtel_submitted = 0;
        $debit_airtel_success = 0;
        $debit_airtel_failed = 0;

        $credit_airtel_pending = 0;
        $credit_airtel_submitted = 0;
        $credit_airtel_success = 0;
        $credit_airtel_failed = 0;

        $debit_orange_pending = 0;
        $debit_orange_submitted = 0;
        $debit_orange_success = 0;
        $debit_orange_failed = 0;
        
        $credit_orange_pending = 0;
        $credit_orange_submitted = 0;
        $credit_orange_success = 0;
        $credit_orange_failed = 0;

        $debit_mpesa_pending = 0;
        $debit_mpesa_submitted = 0;
        $debit_mpesa_success = 0;
        $debit_mpesa_failed = 0;
        
        $credit_mpesa_pending = 0;
        $credit_mpesa_submitted = 0;
        $credit_mpesa_success = 0;
        $credit_mpesa_failed = 0;

        $credit_vodacom_pending = 0;
        $credit_vodacom_failed = 0;
        $credit_vodacom_submitted = 0;
        $credit_vodacom_success = 0;

        $debit_vodacom_success = 0;
            $debit_vodacom_failed = 0;
            $debit_vodacom_pending = 0;
            $debit_vodacom_submitted = 0;

        foreach ($test as $key => $value) {
            if ($value["action"] == "debit" && $value["status"] == "Successful" && $value["method"] == "airtel") {
                $debit_airtel_success = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Failed" && $value["method"] == "airtel") {
                $debit_airtel_failed = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Pending" && $value["method"] == "airtel") {
                $debit_airtel_pending = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Submitted" && $value["method"] == "airtel") {
                $debit_airtel_submitted = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Successful" && $value["method"] == "airtel") {
                $credit_airtel_success = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Failed" && $value["method"] == "airtel") {
                $credit_airtel_failed = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Pending" && $value["method"] == "airtel") {
                $credit_airtel_pending = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Submitted" && $value["method"] == "airtel") {
                $credit_airtel_submitted = $value["total"];
            }
            # Orange
            if ($value["action"] == "debit" && $value["status"] == "Successful" && $value["method"] == "orange") {
                $debit_orange_success = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Failed" && $value["method"] == "orange") {
                $debit_orange_failed = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Pending" && $value["method"] == "orange") {
                $debit_orange_pending = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Submitted" && $value["method"] == "orange") {
                $debit_orange_submitted = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Successful" && $value["method"] == "orange") {
                $credit_orange_success = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Failed" && $value["method"] == "orange") {
                $credit_orange_failed = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Pending" && $value["method"] == "orange") {
                $credit_orange_pending = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Submitted" && $value["method"] == "orange") {
                $credit_orange_submitted = $value["total"];
            }
            # Vodacom
            if ($value["action"] == "debit" && $value["status"] == "Successful" && $value["method"] == "mpesa") {
                $debit_vodacom_success = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Failed" && $value["method"] == "mpesa") {
                $debit_vodacom_failed = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Pending" && $value["method"] == "mpesa") {
                $debit_vodacom_pending = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Submitted" && $value["method"] == "mpesa") {
                $debit_vodacom_submitted = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Successful" && $value["method"] == "mpesa") {
                $credit_vodacom_success = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Failed" && $value["method"] == "mpesa") {
                $credit_vodacom_failed = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Pending" && $value["method"] == "mpesa") {
                $credit_vodacom_pending = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Submitted" && $value["method"] == "mpesa") {
                $credit_vodacom_submitted = $value["total"];
            }
            
        }

        foreach ($all as $key => $value) {
            if ($value["action"] == "debit" && $value["status"] == "Successful") {
                $debit_success = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Failed") {
                $debit_failed = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Pending") {
                $debit_pending = $value["total"];
            }
            if ($value["action"] == "debit" && $value["status"] == "Submitted") {
                $debit_submitted = $value["total"];
            }

            if ($value["action"] == "credit" && $value["status"] == "Successful") {
                $credit_success = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Failed") {
                $credit_failed = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Pending") {
                $credit_pending = $value["total"];
            }
            if ($value["action"] == "credit" && $value["status"] == "Submitted") {
                $credit_submitted = $value["total"];
            }

        }

            $total_orange_charge = $debit_orange_submitted + $debit_orange_failed + $debit_orange_pending + $debit_orange_success;
            $p_odebit_success = number_format(($debit_orange_success * 100) / 100,2);
            $p_odebit_pending =number_format(($debit_orange_pending * 100) / 100,2);
            $p_odebit_failed = number_format(($debit_orange_failed * 100) / 100,2);
            $p_odebit_submitted = number_format(($debit_orange_submitted * 100) / 100,2);
      

            $total_airtel_charge = $debit_airtel_submitted + $debit_airtel_failed + $debit_airtel_pending + $debit_airtel_success;
            $p_adebit_success = number_format(($debit_airtel_success * 100) / 100,2);
            $p_adebit_pending =number_format(($debit_airtel_pending * 100) / 100,2);
            $p_adebit_failed = number_format(($debit_airtel_failed * 100) / 100,2);
            $p_adebit_submitted = number_format(($debit_airtel_submitted * 100) / 100,2);

            $total_payout = $credit_submitted + $credit_failed + $credit_pending + $credit_success;
            $percent_success_payout = number_format(($credit_success * 100) / 100,2);
            $percent_pending_payout =number_format(($credit_pending * 100) / 100,2);
            $percent_failed_payout = number_format(($credit_failed * 100) / 100,2);
            $percent_submitted_payout = number_format(($credit_submitted * 100) / 100,2);

            $total_mpesa_charge = $debit_mpesa_submitted + $debit_mpesa_failed + $debit_mpesa_pending + $debit_mpesa_success;
            $p_vdebit_success = number_format(($debit_mpesa_success * 100) / 100,2);
            $p_vdebit_pending =number_format(($debit_mpesa_pending * 100) / 100,2);
            $p_vdebit_failed = number_format(($debit_mpesa_failed * 100) / 100,2);
            $p_vdebit_submitted = number_format(($debit_mpesa_submitted * 100) / 100,2);

            

            $total_airtel_charge = $debit_airtel_submitted + $debit_airtel_failed + $debit_airtel_pending + $debit_airtel_success;
            $p_adebit_success = number_format(($debit_airtel_success * 100) / 100,2);
            $p_adebit_pending =number_format(($debit_airtel_pending * 100) / 100,2);
            $p_adebit_failed = number_format(($debit_airtel_failed * 100) / 100,2);
            $p_adebit_submitted = number_format(($debit_airtel_submitted * 100) / 100,2);


            $p_vcredit_success = number_format(($credit_vodacom_success * 100),2);
            $p_vcredit_pending =number_format(($credit_vodacom_pending * 100),2);
            $p_vcredit_failed = number_format(($credit_vodacom_failed * 100),2);
            $p_vcredit_submitted = number_format(($credit_vodacom_submitted * 100),2);

            $total_charge = $debit_submitted + $debit_failed + $debit_pending + $debit_success;
            $percent_success = number_format(($debit_success * 100) / ($total_charge),2);
            $percent_pending =number_format(($debit_pending * 100) / ($total_charge),2);
            $percent_failed = number_format(($debit_failed * 100) / ($total_charge),2);
            $percent_submitted = number_format(($debit_submitted * 100) / ($total_charge),2);

            $total_orange_charge = $credit_orange_submitted + $credit_orange_failed + $credit_orange_pending + $credit_orange_success;
            $p_ocredit_success = number_format(($credit_orange_success * 100) / ($total_orange_charge),2);
            $p_ocredit_pending =number_format(($credit_orange_pending * 100) / ($total_orange_charge),2);
            $p_ocredit_failed = number_format(($credit_orange_failed * 100) / ($total_orange_charge),2);
            $p_ocredit_submitted = number_format(($credit_orange_submitted * 100) / ($total_orange_charge),2);


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
