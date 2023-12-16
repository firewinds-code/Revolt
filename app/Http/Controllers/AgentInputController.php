<?php

namespace App\Http\Controllers;

use App\Models\Citymaster;
use App\Models\Clientdatanew;
use App\Models\Contactreason;
use App\Models\Dealership;
use App\Models\Inputhistory;
use App\Models\Interactiontype;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentInputController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function ShowPage()
  {
    return view('agentinput');
  }

  public function SearchShow(Request $req)
  {
    $searchinput = $req->searchinput;

    $row = DB::table('client_data_new')
      ->selectRaw('max(id) as id ,ticket_no')
      ->where('mobile_number', $searchinput)
      ->orwhere('ticket_no', $searchinput)
      ->groupBy('ticket_no')->get();


    if (sizeof($row) == 0) {
      $result = array('0');
      return $result;
    }

    $final_result = array();
    for ($i = 0; $i < sizeof($row); $i++) {
      $result = Clientdatanew::find($row[$i]->id);
      array_push($final_result, $result);
    }

    return array('1', $final_result);
  }

  public function newticket()
  {
    $interaction = Interactiontype::all();
    $contact_reason = Contactreason::select('contact_reason')->distinct('contact_reason')->get();
    $city = Citymaster::select('city')->distinct('city')->get();
    $dealership = Dealership::select('dealership')->distinct('cidealershipty')->orderby('dealership')->get();
    $new_form = array($interaction, $contact_reason, $city, $dealership);
    return $new_form;
  }

  public function contactreason(Request $req)
  {
    $contactreasonVal = $req;
    $contact_reason_sub = Contactreason::select('contact_reason_sub_type')->where('contact_reason', $contactreasonVal['contact_reason_val'])->distinct('contact_reason_sub_type')->get();
    return $contact_reason_sub;
  }

  public function contactreasonsub(Request $req)
  {
    $contactreasonsubVal = $req;
    $contact_reason_sub_sub = Contactreason::select('contact_reason_sub_sub_type')->where('contact_reason_sub_type', $contactreasonsubVal['contact_reason_sub_val'])->where('contact_reason', $contactreasonsubVal['contact_reason_val'])->distinct('contact_reason_sub_sub_type')->get();
    return $contact_reason_sub_sub;
  }

  public function pincode(Request $req)
  {
    $city = $req['city_val'];
    $pincode = Citymaster::select('pincode')->where('city', $city)->get();
    return $pincode;
  }

  public function dealershiplocation(Request $req)
  {
    $dealership = $req['dealership_val'];
    $pincode = Dealership::select('dealership_location')->where('dealership', $dealership)->get();
    return $pincode;
  }

  public function ticketsubmit(Request $req)
  {
    $validator = Validator::make($req->all(), [
      'call_status' => ['required'],
      'ResolutionProvided' => ['required'],
      'remark' => ['required'],
      'mobile_number' => ['required', 'regex:/^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/'],
      'email_id' => ['required', 'string', 'email'],
      'contact_reason' => ['required'],
      'contact_reason_sub' => ['required'],
      'contact_reason_sub_sub' => ['required'],
      'booking_id' => ['required'],
      'purchase_date' => ['required'],
      // 'issue' => ['required'],
    ]);
    if ($validator->fails()) {
      return back()->withErrors($validator)->with('ticketerrorrr', "error");
    }

    $client = new Clientdatanew;
    $client->call_status = $req->call_status;
    $client->ResolutionProvided = $req->ResolutionProvided;
    $client->remark = addslashes($req->remark);
    $client->mobile_number = $req->mobile_number;
    $client->email_id = $req->email_id;
    $client->contact_reason = $req->contact_reason;
    $client->contact_reason_type = $req->contact_reason_sub;
    $client->contact_reason_sub_sub_type = $req->contact_reason_sub_sub;
    $client->booking_id = $req->booking_id;
    $client->purchase_date = $req->purchase_date;
    $client->app_product_issue = $req->app_product_issue;
    $client->agent_id = Auth::User()->name;
    $client_inputhistory = new Inputhistory;
    $client_inputhistory->call_status = $req->call_status;
    $client_inputhistory->ResolutionProvided = $req->ResolutionProvided;
    $client_inputhistory->remark = $req->remark;
    $client_inputhistory->agent_id = Auth::User()->name;


    if ($req->customer_name != null) {
      $client->customer_name = $req->customer_name;
    }
    if ($req->issue != null) {
      // $client->product_issue = $req->issue;

      $issue = $req->input('issue');
      $client->product_issue = implode(',', $issue);
    }
    if ($req->interaction_type != null) {
      $client->interaction_type = $req->interaction_type;
    }
    if ($req->social_media_source != null) {
      $client->social_media_source = $req->social_media_source;
    }
    if ($req->product_type != null) {
      $client->product_type = $req->product_type;
    }
    if ($req->chasis_number != null) {
      $client->chasis_number = $req->chasis_number;
    }
    if ($req->city != null) {
      $client->city = $req->city;
    }
    if ($req->pincode != null) {
      $client->pincode = $req->pincode;
    }
    if ($req->warranty_status != null) {
      $client->warranty_status = $req->warranty_status;
    }
    if ($req->dealership != null) {
      $client->dealership = $req->dealership;
    }
    if ($req->dealership_location != null) {
      $client->dealership_location = $req->dealership_location;
    }
    if ($req->location_code != null) {
      $client->location_code = $req->location_code;
    }
    if ($req->dealer_code != null) {
      $client->dealer_code = $req->dealer_code;
    }
    if ($req->store_location_code != null) {
      $client->store_location_code = $req->store_location_code;
    }
    if ($req->store_location_name != null) {
      $client->store_location_name = $req->store_location_name;
    }
    if ($req->dealer_state != null) {
      $client->dealer_state = $req->dealer_state;
    }
    if ($req->call_status_sub_type != null) {
      $client->call_status_sub_type = $req->call_status_sub_type;
    }
    if ($req->call_status_sub_sub_type != null) {
      $client->call_status_sub_sub_type = $req->call_status_sub_sub_type;
    }
    if ($req->final_call_status != null) {
      $client->final_call_status = $req->final_call_status; //
      $client_inputhistory->final_call_status = $req->final_call_status; //
    }
    if ($req->ResolutionProvided != null) {
      $client->ResolutionProvided = $req->ResolutionProvided; //
      $client_inputhistory->ResolutionProvided = $req->ResolutionProvided; //
    }
    if ($req->app_product_issue != null) {
      $client->app_product_issue = $req->app_product_issue; //
      $client_inputhistory->app_product_issue = $req->app_product_issue; //
    }
    $flag = 0;
    if ($req->ticket_no != null) {
      $final_status = Clientdatanew::select('final_call_status')->where('ticket_no', $req->ticket_no)->latest('id')->first();
      if ($final_status->final_call_status == 'Closed') {
        $flag = 1;
      } else {
        $client->ticket_no = $req->ticket_no; //
        $client_inputhistory->ticket_no = $req->ticket_no; //
      }
    } else {
      $ticket1 = Clientdatanew::where('mobile_number', $req->mobile_number)->orderBy('id', 'DESC')->limit(1)->get();
      if ($ticket1->count() > 0) {
        //check
        if ($ticket1[0]->final_call_status == "Closed") {
          $flag = 1;
        } else {
          $client->ticket_no = $ticket1[0]->ticket_no;
        }
      } else {
        $flag = 1;
      }
    }

    if ($flag == 1) {
      $ticket2 = Clientdatanew::select('ticket_id')->max('ticket_id');

      if ($ticket2 != null) {
        $last = $ticket2 + 1;
        if ($req->contact_reason_sub == "General Enquiry") {
          $client_inputhistory->ticket_no =  'RV' . date('m') . date('y') . $last;
          $client->ticket_no =  'RV' . date('m') . date('y') . $last;
          $client->ticket_id = $last;
        } else {
          $client_inputhistory->ticket_no =  'RV' . date('m') . date('y') . $last;
          $client->ticket_no =  'RV' . date('m') . date('y') . $last;
          $client->ticket_id = $last;
        }
      } else {
        $client_inputhistory->ticket_no = "RV" . date('m') . date('y') . "1";
        $client->ticket_no = "RV" . date('m') . date('y') . "1";
        $client->ticket_id = "1";
      }
    }
    $client->save();
    $client_inputhistory->save();
    return back()->with('ticket_no', 'Ticket No :-' . $client->ticket_no);
  }

  public function searchdataform(Request $req)
  {

    $id = $req->id;
    $ticket_no = $req->ticket_no;

    $form_data = Clientdatanew::where('id', $id)->get();
    $table1 = Inputhistory::where('ticket_no', $ticket_no)->get();
    $table2 = Clientdatanew::where('ticket_no', $ticket_no)->get();
    $result = array($form_data, $table2, $table1);
    // dd($result);
    return $result;
  }
  public function location_code(Request $request)
  {
    try {
      $dealership_locationVal = $request->dealership_locationVal;
      $location_code = Dealership::select('location_code', 'dealer_code', 'store_location_code', 'store_location_name', 'dealer_state')->where('dealership_location', $dealership_locationVal)->get();

      return $location_code;
    } catch (Exception $e) {
      return back()->with('error', 'Something Went Wrong');
    }
  }
}