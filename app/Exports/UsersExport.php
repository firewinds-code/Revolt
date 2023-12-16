<?php

namespace App\Exports;

use App\Models\Citymaster;
use App\Models\Contactreason;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection, WithHeadings
{
    public function __construct($start, $end)
    {

        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
        $selectArr = array('id', 'ticket_no', 'customer_name', 'mobile_number', 'email_id', 'interaction_type','social_media_source', 'product_type', 'contact_reason','old_contact_reason', 'contact_reason_type', 'contact_reason_sub_sub_type', 'booking_id', 'chasis_number', 'city', 'pincode', 'purchase_date', 'warranty_status', 'dealership', 'dealership_location', 'location_code','dealer_code','store_location_code','store_location_name','dealer_state', 'call_status', 'call_status_sub_type', 'call_status_sub_sub_type', 'final_call_status', 'remark', 'ResolutionProvided', 'product_issue', 'app_product_issue', 'agent_id', 'created_at');

        return DB::table('client_data_new')
            ->select($selectArr)
            ->whereDate('created_at', '>=', $this->start)
            ->whereDate('created_at', '<=', $this->end)
            ->get();
    }

    public function headings(): array
    {

        $selectArr = array('Sr no.', 'Ticket No', 'Customer Name', 'Mobile number', 'Email ID', 'Interaction Type','Social Media Source', 'Product Type', 'Contact Reason','old_contact_reason', 'Contact Reason Sub type', 'Contact Reason Sub Sub type', 'Booking ID', 'Chasis Number', 'City', 'Pincode', 'Purchase Date', 'Warranty Status', 'Dealership', 'Dealership Location', 'Location Code','Dealer Code','Store Location Code','Store Location Name','Dealer State', 'Call Status', 'Priority', 'Call Status Sub Sub type', 'Final Call Status', 'Customer Remarks', 'Resolution Provided', 'Product Issue', 'Application Product Isuue', 'Agent id', 'Created at');


        return $selectArr;
    }
}