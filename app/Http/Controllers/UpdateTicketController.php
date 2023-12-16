<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Clientdatanew;
use App\Models\Contactreason;
use App\Models\update_log;
use Exception;

class UpdateTicketController extends Controller
{
    public function updateticket()
    {
        try {
            return view('updateticket');
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong');
        }
    }

    public function searchupdateticket(Request $request)
    {
        try {
            $searchinput1 = $request->id;
            $data = DB::table('client_data_new')
                ->where('ticket_no', $searchinput1)
                ->groupBy('ticket_no')
                ->min('id');

            $data1 = DB::table('client_data_new')
                ->select('contact_reason', 'contact_reason_type', 'contact_reason_sub_sub_type')
                ->where('id', $data)->get();
            return response()->json(["data" => $data, "data1" => $data1]);
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong');
        }
    }

    public function newticket1()
    {
        try {
            $contact_reason = Contactreason::select('contact_reason')->distinct('contact_reason')->get();

            $new_form = array($contact_reason);
            return $new_form;
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong');
        }
    }

    public function postupdateticket(Request $request)
    {
        try {
            $id2 = $request->id1;

            if ($id2) {
                // Get the ticket number for the given $id2
                $data2 = DB::table('client_data_new')->select('ticket_no', 'contact_reason')->where('id', $id2)->get();

                if ($data2->count() > 0) {
                    $ticketNo = $data2[0]->ticket_no;
                    $oldReason = $data2[0]->contact_reason;

                    // Update all rows with the same ticket number
                    DB::table('client_data_new')
                        ->where('ticket_no', $ticketNo)
                        ->update([
                            'contact_reason' => $request->contact_reason,
                            'contact_reason_type' => $request->contact_reason_sub,
                            'contact_reason_sub_sub_type' => $request->contact_reason_sub_sub,
                            'old_contact_reason' => $oldReason,
                        ]);

                    // Create a log for the update
                    $update_log = new update_log;
                    $update_log->contact_reason = $request->contact_reason;
                    $update_log->contact_reason_type = $request->contact_reason_sub;
                    $update_log->contact_reason_sub_sub_type = $request->contact_reason_sub_sub;
                    $update_log->ticket_no = $ticketNo;
                    $update_log->updated_by = Auth::user()->name;
                    $update_log->save();

                    return redirect('updateticket')->with('success', 'Client Data Updated Successfully');
                } else {
                    return redirect('updateticket')->with('success', 'Please Enter a Valid Ticket Number');
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong');
        }
    }
}