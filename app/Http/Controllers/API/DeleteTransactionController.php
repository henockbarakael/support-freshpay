<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ImportedTransaction;
use Illuminate\Http\Request;

class DeleteTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportedTransaction  $importedTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(ImportedTransaction $importedTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImportedTransaction  $importedTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportedTransaction $importedTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportedTransaction  $importedTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($reference)
    {
        // $s = $importedTransaction->delete();
        $transaction=ImportedTransaction::where('paydrc_reference',$reference);
        $delete = $transaction->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => "Transaction Deleted successfully!",
            ], 200);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete!",
            ], 201);
        }

        
    }
}
