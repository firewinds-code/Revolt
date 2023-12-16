<?php
include 'include/init.php';
// $LanduplicateData = "rtggffg";
if (isset($_REQUEST['id']) && $_REQUEST['id'] != '' && isset($_REQUEST['ticket_no']) && $_REQUEST['ticket_no'] != '') {

  $Query = "select * FROM client_data_new where id=" . $_REQUEST['id'];
  $myDB = new MysqliDb();
  $LanduplicateData = $myDB->query($Query);
  if (count($LanduplicateData) > 0) {




    foreach ($LanduplicateData as $value) {
      $client_data['ticket_no'] = $value['ticket_no'];
      $client_data['mobile_number'] = $value['mobile_number'];
      $client_data['customer_name'] = $value['customer_name'];
      $client_data['email_id'] = $value['email_id'];
      $client_data['interaction_type'] = $value['interaction_type'];
      $client_data['product_type'] = $value['product_type'];
      $client_data['contact_reason'] = $value['contact_reason'];
      $client_data['contact_reason_type'] = $value['contact_reason_type'];
      $client_data['contact_reason_sub_sub_type'] = $value['contact_reason_sub_sub_type'];
      $client_data['chasis_number'] = $value['chasis_number'];
      $client_data['city'] = $value['city'];
      $client_data['pincode'] = $value['pincode'];
      $client_data['purchase_date'] = $value['purchase_date'];
      $client_data['warranty_status'] = $value['warranty_status'];
      $client_data['dealership'] = $value['dealership'];
      $client_data['dealership_location'] = $value['dealership_location'];
      $client_data['call_status'] = $value['call_status'];
      $client_data['call_status_sub_type'] = $value['call_status_sub_type'];
      $client_data['call_status_sub_sub_type'] = $value['call_status_sub_sub_type'];
      $client_data['final_call_status'] = $value['final_call_status'];
      $client_data['remark'] = $value['remark'];
      $client_data['booking_id'] = $value['booking_id'];
      $client_data['product_issue'] = $value['product_issue'];
    }

    $dtable = '<label style="color: black;">New Histry table</label>
        <table  id="datatable" class="table table-striped table-bordered">
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

                      <tbody>';
    $serialNo = 1;
    $Query = "select * FROM input_history where ticket_no='" . $_REQUEST['ticket_no'] . "'";
    $myDB = new MysqliDb();
    $result = $myDB->query($Query);

    foreach ($result as $value) {
      $dtable .= '
                          <tr class="gradeX" >
        					<td> ' . $serialNo++ . '</td>
                            <td>' . $value['agent_id']  . '</td>
                            <td>' . $value['remark']  . '</td>
                            <td>' . $value['ResolutionProvided']  . '</td>
                            <td>' . $value['ticket_no']  . '</td>
                            <td>' . $value['call_status']  . '</td>
                            <td>' . $value['final_call_status']  . '</td>
        					<td>' . $value['created_at']  . '</td>

        					</tr>';
    }
    $dtable .= ' </tbody>


                    </table>
                    ';


    $dtable2 = '<label style="color: black;">Old Histry table</label>
        <table  id="datatable" class="table table-striped table-bordered">
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

                      <tbody>';
    $serialNo = 1;
    $Query = "select * FROM  client_data_new where ticket_no='" . $_REQUEST['ticket_no'] . "'";
    $myDB = new MysqliDb();
    $result = $myDB->query($Query);

    foreach ($result as $value) {
      $dtable2 .= '<tr class="gradeX" >
        					<td> ' . $serialNo++ . '</td>
                            <td>' . $value['agent_id']  . '</td>
                            <td>' . $value['remark']  . '</td>
                            <td>' . $value['ResolutionProvided']  . '</td>
                            <td>' . $value['ticket_no']  . '</td>
                            <td>' . $value['call_status']  . '</td>
                            <td>' . $value['final_call_status']  . '</td>
        					<td>' . $value['created_at']  . '</td>

        					</tr>';
    }
    $dtable2 .= ' </tbody>


                    </table>
                    ';

    $data['history_tbl'] = $dtable;
    $data['history_tbl_old'] = $dtable2;
    $data['client_data'] = $client_data;
    $data['status'] = true;
  } else {
    $data['status'] = false;
  }
}


echo json_encode($data);
