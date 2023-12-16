<x-header />
<x-side_bar />
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <!-- Date range -->
                        <form method="get" action="{{ route('exportreport') }}">
                            <div class="form-group col-md-6">
                                <label>Date range:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="date" class="form-control float-right" id="dateRange" required>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-block btn-primary" id="reportbtn">Submit</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="Submit" class="btn btn-block btn-success"><img src="https://img.icons8.com/ios/23/000000/ms-excel.png" /></button>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="report12" class="table table-bordered user_datatable" style="display: none;">
                        <thead>
                            <th>ticket_no</th>
                            <th>customer_name</th>
                            <th>mobile_number</th>
                            <th>email_id</th>
                            <th>interaction_type</th>
							<th>social_media_source</th>
                            <th>product_type</th>
                            <th>old_contact_reason</th>
                            <th>contact_reason</th>
                            <th>contact_reason_type</th>
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
                            <th>call_status</th>
                            <th>call_status_sub_type</th>
                            <th>call_status_sub_sub_type</th>
                            <th>final_call_status</th>
                            <th>remark</th>
                            <th>ResolutionProvided</th>
                            <th>product_issue</th>
                            <th>app_product_issue</th>
                            {{-- <th>agent_id</th> --}}
                            <th>created_at</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<x-footer />