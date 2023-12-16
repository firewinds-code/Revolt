<x-header />
<x-side_bar />
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>&nbsp;Agent Input</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form id="searchinputform">
                            <div class="form-group col-md-9">
                                <br>
                                <div class="input-group col-md-10">
                                    <input type="text" class="form-control float-right" id="searchinput"
                                        placeholder="Enter Mobile,Ticket Number for search from Mobile Number,Ticket Number"
                                        required>
                                    <div class="col-md-2">
                                        <button type="Submit" id="searchsubmit" class="btn btn-block btn-primary"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group col-md-12" id="tbl_id" style="display: none;">
                            <table id="searchtable1" class="table table-striped table-bordered table">
                                <thead>
                                    <tr>
                                        <th>Sr_no.</th>
                                        <th>Search</th>
                                        <th>Ticket_No</th>
                                        <th>Customer_Name</th>
                                        <th>Mobile_number</th>
                                        <th>Interaction_Type</th>
                                        <th>Product_Type</th>
                                        <th>Contact_Reason</th>
                                        <th>Contact_Reason_Sub_type</th>
                                        <th>Contact_Reason_Sub_Sub_type</th>
                                        <th>Call_Status</th>
                                        <th>Final_Call_Status</th>
                                        <th>Created_At</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <hr>
                        <div class="form-group col-md-2" style="margin-left: 410px;">
                            <button type="button" id="new_ticket_button" class="btn btn-block btn-primary">New
                                Ticket</button>
                        </div>
                        <div class="form-group col-md-12" style=" padding: 25px 20px 5px 20px; display:none;"
                            id="ticket_form">
                            <form method="POST" action="{{ route('ticketsubmit') }}" enctype="multipart/form-data"
                                name="firstform" id="firstform" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Ticket Number</label>
                                            <input type="text" class="form-control" readonly name="ticket_no"
                                                id="ticket_no">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Customer Name"
                                                name="customer_name" id="customer_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Mobile number</label>
                                            <input type="tel"
                                                class="form-control @error('mobile_number') is-invalid @enderror"
                                                placeholder="Enter Mobile Number" name="mobile_number"
                                                id="mobile_number">
                                            @error('mobile_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">
                                            <label>Email ID</label>
                                            <input type="email"
                                                class="form-control @error('email_id') is-invalid @enderror"
                                                placeholder="Enter Email ID" name="email_id" id="email_id">
                                            @error('email_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Interaction Type</label>
                                            <select class="form-control" id="interaction_type" name="interaction_type">
                                                <option value=""> Select Interaction Type</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" id="social_media_source1" style="display:none">
                                        <div class="form-group">
                                            <label>Social Media Source</label>
                                            <select class="form-control" name="social_media_source"
                                                id="social_media_source">
                                                <option value="">Select</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="Twitter">Twitter</option>
                                                <option value="LinkedIn">LinkedIn</option>
                                                <option value="Youtube">Youtube</option>
                                                <option value="Playstore">Playstore</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Product Type</label>
                                            <select class="form-control" name="product_type" id="product_type">
                                                <option value=""> Select Product Type</option>
                                                <option value="300"> 300</option>
                                                <option value="400"> 400</option>
                                                <option value="Others"> Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Reason</label>
                                            <select class="form-control @error('contact_reason') is-invalid @enderror"
                                                id="contact_reason" name="contact_reason">
                                                <option value=""> Select Contact Reason</option>
                                            </select>
                                            @error('contact_reason')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Reason Sub type</label>
                                            <select
                                                class="form-control @error('contact_reason_sub') is-invalid @enderror"
                                                id="contact_reason_sub" name="contact_reason_sub">
                                                <option value="" id="contact_reason_sub_option"> Select Contact
                                                    Reason Type</option>
                                            </select>
                                            @error('contact_reason_sub')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Reason Sub Sub type</label>
                                            <select
                                                class="form-control @error('contact_reason_sub_sub') is-invalid @enderror"
                                                id="contact_reason_sub_sub" name="contact_reason_sub_sub">
                                                <option value="" id="contact_reason_sub_sub_option"> Select
                                                    Contact Reason Type</option>
                                            </select>
                                            @error('contact_reason_sub_sub')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="display: none;" id="app_product_issue">
                                        <div class="form-group">
                                            <label>Product Issue</label>
                                            <select class="form-control @error('product_issue') is-invalid @enderror"
                                                name="app_product_issue" id="app_product_issue">
                                                <option value=""> Select Product issue</option>
                                                <option value="Resource not Found">Resource not Found</option>
                                                <option value="GPS signal not available"> GPS signal not available
                                                </option>
                                                <option value="Service Unavailable">Service Unavailable</option>
                                                <option value="Bike not connected">Bike not connected</option>
                                                <option value="User not found"> User not found</option>
                                                <option value="Data not syncing">Data not syncing</option>
                                                <option value="Package Related">Package Related</option>
                                                <option value="Mobile Number Change">Mobile Number Change</option>
                                                <option value="ECU Device">ECU Device</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            @error('issue')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4" id="issue_div" style="display:none">
                                        <div class="form-group">
                                            <label>Select issue</label>
                                            <select class="select2 form-control @error('issue') is-invalid @enderror"
                                                multiple="multiple" data-placeholder="Select Product issue"
                                                style="width: 100%;" name="issue[]" id="issue">
                                                <option value="Battery Issue"> Battery Issue</option>
                                                <option value="Remote issue"> Remote issue</option>
                                                <option value="Belt Broken"> Belt Broken</option>
                                                <!-- <option value="Spare Parts not available"> Spare Parts not available</option> -->
                                                <option value="Bike not Starting"> Bike not Starting</option>
                                                <option value="App Issues"> App Issues</option>
                                                <option value="Dealership not responding"> Dealership not responding
                                                </option>
                                                <option value="Sound Box Issues"> Sound Box Issues</option>
                                                <option value="Range Issues"> Range Issues</option>
                                                <option value="GPS Issue"> GPS Issue</option>
                                                <option value="Bike stopped while driving"> Bike stopped while driving
                                                </option>
                                                <option value="Motor Issues"> Motor Issues</option>
                                                <option value="Error 96 Displaying"> Error 96 Displaying</option>
                                                <option value="Accelerator not working"> Accelerator not working
                                                </option>
                                                <option value="Handle Damage"> Handle Damage</option>
                                                <option value="Charging Issues"> Charging Issues</option>
                                                <option value="Immobilizer issue"> Immobilizer issue</option>
                                                <option value="Horn Not Working"> Horn Not Working</option>
                                                <option value="Indicator not working"> Indicator not working</option>
                                                <option value="Brake Sensor issue"> Brake Sensor issue</option>
                                                <option value="Charger issue"> Charger issue</option>
                                                <option value="ECU Device">ECU Device</option>
                                                <option value="Others"> Others</option>
                                            </select>
                                            @error('issue')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-4" id="issue_div" style="display:none">
                                        <div class="form-group">
                                            <label>Select issue</label>
                                            <select class="form-control @error('issue') is-invalid @enderror" name="issue" id="issue">
                                                <option value=""> Select Product issue</option>
                                                <option value="Battery Issue"> Battery Issue</option>
                                                <option value="Remote issue"> Remote issue</option>
                                                <option value="Belt Broken"> Belt Broken</option>
                                                <!-- <option value="Spare Parts not available"> Spare Parts not available</option> -->
                                                <option value="Bike not Starting"> Bike not Starting</option>
                                                <option value="App Issues"> App Issues</option>
                                                <option value="Dealership not responding"> Dealership not responding</option>
                                                <option value="Sound Box Issues"> Sound Box Issues</option>
                                                <option value="Range Issues"> Range Issues</option>
                                                <option value="GPS Issue"> GPS Issue</option>
                                                <option value="Bike stopped while driving"> Bike stopped while driving</option>
                                                <option value="Motor Issues"> Motor Issues</option>
                                                <option value="Error 96 Displaying"> Error 96 Displaying</option>
                                                <option value="Accelerator not working"> Accelerator not working</option>
                                                <option value="Handle Damage"> Handle Damage</option>
                                                <option value="Charging Issues"> Charging Issues</option>
                                                <option value="Immobilizer issue"> Immobilizer issue</option>
                                                <option value="Horn Not Working"> Horn Not Working</option>
                                                <option value="Indicator not working"> Indicator not working</option>
                                                <option value="Brake Sensor issue"> Brake Sensor issue</option>
                                                <option value="Charger issue"> Charger issue</option>
                                                <option value="ECU Device">ECU Device</option>
                                                <option value="Others"> Others</option>
                                            </select>
                                            @error('issue')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Booking ID</label>
                                            <input type="text"
                                                class="form-control @error('booking_id') is-invalid @enderror"
                                                placeholder="Enter Booking ID" id="booking_id" name="booking_id">
                                            @error('booking_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Chasis Number</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Chasis Number" id="chasis_number"
                                                name="chasis_number">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control" id="city" name="city">
                                                <option value=""> Select city</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <select class="form-control" id="pincode" name="pincode">
                                                <option value="" id="city_option"> Select city</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">

                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    id="purchase_date" name="purchase_date"
                                                    data-target="#purchase_date" />
                                                <div class="input-group-append" data-target="#purchase_date"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Warranty Status</label>
                                            <select class="form-control" id="warranty_status" name="warranty_status">
                                                <option value=""> Select Warranty Status</option>
                                                <option value="In-warranty (less than 5 yrs.)"> In-warranty (less than
                                                    5 yrs.)</option>
                                                <option value="Out of Warranty (Accidental Insurance)"> Out of Warranty
                                                    (Accidental Insurance)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Dealership</label>
                                            <select class="form-control" name="dealership" id="dealership">
                                                <option value=""> Select Dealership</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Dealership Location</label>
                                            <select class="form-control" name="dealership_location"
                                                id="dealership_location">
                                                <option value=""> Select Dealership</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Location Code</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="Enter Location Code" id="location_code"
                                                name="location_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Dealer Code</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="Enter Dealer Code" id="dealer_code" name="dealer_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Store Location Code</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="Enter Store Location Code" id="store_location_code"
                                                name="store_location_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Store Location Name</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="Enter Store Location Name" id="store_location_name"
                                                name="store_location_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Dealer State</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="Enter Dealer State" id="dealer_state"
                                                name="dealer_state">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Call Status</label>
                                            <select class="form-control @error('call_status') is-invalid @enderror"
                                                name="call_status" id="call_status">
                                                <option value=""> Select Call Status</option>
                                                <option value="Resolved"> Resolved</option>
                                                <option value="Follow-up"> Follow-up </option>
                                                <option value="Escalation"> Escalation</option>
                                            </select>
                                            @error('call_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group"ticket_button>
                                            <label>Priority</label>
                                            <select class="form-control" name="call_status_sub_type"
                                                id="call_status_sub_type">
                                                <<option value="NA"> Select Call Status</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Call Status Sub Sub type</label>
                                            <select class="form-control" name="call_status_sub_sub_type"
                                                id="call_status_sub_sub_type">
                                                <option value="NA"> Select Call Status</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Final Call Status</label>
                                            <select class="form-control" name="final_call_status"
                                                id="final_call_status">
                                                <option value="NA"> NA</option>
                                                <option value="Closed"> Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Customer Remarks</label>
                                            <textarea class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark"></textarea>
                                            @error('remark')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Resolution Provided</label>
                                            <textarea class="form-control @error('ResolutionProvided') is-invalid @enderror" name="ResolutionProvided"
                                                id="ResolutionProvided"></textarea>
                                            @error('ResolutionProvided')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row col-md-2" style="margin-left: 410px;">
                                    <button type="Submit" id="Submit"
                                        class="btn btn-block btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="form-group col-md-12" style=" padding: 25px 20px 5px 20px; display:none;"
                            id="table_old_new">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <label style="color: black;">
                                            <h6><b>New History table</b></h6>
                                        </label>

                                        <table id="datatable1" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr no.</th>
                                                    <th>Agent id</th>
                                                    <th>Remarks</th>
                                                    <th>Resolution Provided</th>
                                                    <th>Ticket Id</th>
                                                    <th>Call Status</th>
                                                    <th>Final Status</th>
                                                    <th>Created at</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label style="color: black;">
                                            <h6><b>Old History table</b></h6>
                                        </label>
                                        <table id="datatable2" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr no.</th>
                                                    <th>Agent id</th>
                                                    <th>Remarks</th>
                                                    <th>Resolution Provided</th>
                                                    <th>Ticket Id</th>
                                                    <th>Call Status</th>
                                                    <th>Contact Reason Sub Type</th>
                                                    <th>Final Status</th>
                                                    <th>Created at</th>
                                                    <th>customer_name</th>
                                                    <th>mobile_number</th>
                                                    <th>email_id</th>
                                                    <th>interaction_type</th>
                                                    <th>social_media_source</th>
                                                    <th>product_type</th>
                                                    <th>contact_reason</th>
                                                    <th>contact_reason_sub_sub_type</th>
                                                    <th>booking_id</th>
                                                    <th>chasis_number</th>
                                                    <th>city</th>
                                                    <th>pincode</th>
                                                    <th>purchase_date</th>
                                                    <th>warranty_status</th>
                                                    <th>dealership</th>
                                                    <th>dealership_location</th>
                                                    <th>dealership_location_code</th>
                                                    <th>dealership_dealer_code</th>
                                                    <th>dealership_store_location_code</th>
                                                    <th>dealership_store_location_name</th>
                                                    <th>dealer_state</th>
                                                    <th>call_status_sub_type</th>
                                                    <th>call_status_sub_sub_type</th>
                                                    <th>product_issue</th>
                                                    <th>app_product_issue</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script>
    function ticket_button() {
        $.ajax({
            url: "{{ route('newticketshow') }}",
            type: "get",
            success: function(response) {
                console.log(response);
                for (val in response['0']) {
                    var newOption = $('<option value="' + response['0'][val]['interaction_type'] + '">' +
                        response['0'][val]['interaction_type'] + '</option>');
                    $('#interaction_type').append(newOption);
                }
                for (val in response['1']) {
                    var newOption = $('<option value="' + response['1'][val]['contact_reason'] + '">' +
                        response['1'][val]['contact_reason'] + '</option>');
                    $('#contact_reason').append(newOption);
                }
                for (val in response['2']) {
                    var newOption = $('<option value="' + response['2'][val]['city'] + '">' + response['2'][
                        val
                    ]['city'] + '</option>');
                    $('#city').append(newOption);
                }
                for (val in response['3']) {
                    var newOption = $('<option value="' + response['3'][val]['dealership'] + '">' +
                        response['3'][val]['dealership'] + '</option>');
                    $('#dealership').append(newOption);
                }
            },
        });
    }
    ticket_button();
</script>

<script>
    $("#contact_reason_sub").change(function() {
        var contact_reason_sub = $(this).val();
        // alert(contact_reason_sub);
        if (contact_reason_sub == "Complaint") {
            // alert("contact_reason_sub(Complaint)");
            $("#city").attr("required", true);
            $("#dealership").attr("required", true);
            $("#dealership_location").attr("required", true);
        } else {
            $("#city").attr("required", false);
            $("#dealership").attr("required", false);
            $("#dealership_location").attr("required", false);
        }
    });
</script>
<script>
    $("#dealership_location").change(function() {
        var dealership_locationVal = $(this).val();
        // alert(dealership_locationVal);
        dealership_location_ajax(dealership_locationVal);
    });

    function dealership_location_ajax(dealership_locationVal) {
        $.ajax({
            url: "{{ route('location_code') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                dealership_locationVal: dealership_locationVal,
            },
            success: function(response) {
                // alert(response[0]['id']);
                $("#location_code").empty();
                $('#location_code').val(response[0]['location_code']);
                $("#dealer_code").empty();
                $('#dealer_code').val(response[0]['dealer_code']);
                $("#store_location_code").empty();
                $('#store_location_code').val(response[0]['store_location_code']);
                $("#store_location_name").empty();
                $('#store_location_name').val(response[0]['store_location_name']);
                $("#dealer_state").empty();
                $('#dealer_state').val(response[0]['dealer_state']);
            },
        });
    }
</script>
<script>
    $("#interaction_type").change(function() {
        var interaction_type = $(this).val();
        $("#social_media_source1").hide();
        if (interaction_type == "Social Media") {
            $("#social_media_source1").show();
        } else {
            $("#social_media_source1").hide();
        }
    });
</script>
<x-footer />
