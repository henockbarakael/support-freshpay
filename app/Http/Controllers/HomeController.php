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
            'hour','_orange_debit','_airtel_debit','_vodacom_debit'));
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
