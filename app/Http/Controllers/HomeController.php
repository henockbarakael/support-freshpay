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

    public function index(){
        $contacts = Contact::all();
        return view("index", compact('contacts'));
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
        $global_payout = Http::get('http://143.198.138.97/services/paydrc/count-all-credit/transactions');
        $global_charge = Http::get('http://143.198.138.97/services/paydrc/count-all-debit/transactions');

        $credit_airtel = Http::get('http://143.198.138.97/services/paydrc/count-credit/airtel-transactions');
        $credit_orange = Http::get('http://143.198.138.97/services/paydrc/count-credit/orange-transactions');
        $credit_mpesa = Http::get('http://143.198.138.97/services/paydrc/count-credit/mpesa-transactions');

        $debit_airtel = Http::get('http://143.198.138.97/services/paydrc/count-debit/airtel-transactions');
        $debit_orange = Http::get('http://143.198.138.97/services/paydrc/count-debit/orange-transactions');
        $debit_mpesa = Http::get('http://143.198.138.97/services/paydrc/count-debit/mpesa-transactions');

        $result_global_payout = $global_payout->json();
        $result_global_charge = $global_charge->json();

        $result_credit_airtel = $credit_airtel->json();
        $result_credit_orange = $credit_orange->json();
        $result_credit_mpesa = $credit_mpesa->json();
        $result_debit_airtel = $debit_airtel->json();
        $result_debit_orange = $debit_orange->json();
        $result_debit_mpesa = $debit_mpesa->json();

        return view('dashboard.admin', compact('result_global_payout','result_global_charge',
            'result_credit_airtel','result_credit_orange','result_credit_mpesa',
            'result_debit_airtel','result_debit_orange','result_debit_mpesa'
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
