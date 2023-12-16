<footer class="main-footer" align='center'>
    <strong>Cogent E Services Ltd &copy; 2022 - 2023 </strong>
    All Rights Reserved.
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- DataTables & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Categoria Evento -->
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript"
    src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js">
</script>
<!-- Fecha Evento -->
<!-- InputMask -->
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script>
    function contactreason_ajax(contact_reason_val) {
        $.ajax({
            url: "{{ route('contactreason') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                contact_reason_val: contact_reason_val,
            },
            success: function(response) {
                // console.log(response);
                $("#contact_reason_sub").empty();
                // $('#contact_reason_sub_option').html(' Select Sub Type ');
                $('#contact_reason_sub').append($('<option value="' + '">' + ' Select Sub Type ' +
                    '</option>'));
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['contact_reason_sub_type'] + '">' +
                        response[val]['contact_reason_sub_type'] + '</option>');
                    $('#contact_reason_sub').append(newOption);
                }
            },
        });
    }

    function contact_reason_sub_ajax(contact_reason_sub_val) {
        $.ajax({
            url: "{{ route('contactreasonsub') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                contact_reason_sub_val: contact_reason_sub_val,
                contact_reason_val: $('#contact_reason').val(),
            },
            success: function(response) {
                // console.log(response);
                $("#contact_reason_sub_sub").empty();
                // $('#contact_reason_sub_sub_option').html(' Select Sub Type ');
                $('#contact_reason_sub_sub').append($('<option value="' + '">' + ' Select Sub Sub Type ' +
                    '</option>'));
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['contact_reason_sub_sub_type'] +
                        '">' + response[val]['contact_reason_sub_sub_type'] + '</option>');
                    $('#contact_reason_sub_sub').append(newOption);
                }
            },
        });
    }
</script>

<script type="text/javascript">
    $('#searchinputform').on('submit', function(e) {
        e.preventDefault();
        $('#ticket_form').hide();
        $('#firstform').trigger("reset");
        $('#table_old_new').hide();
        var table1 = $('#datatable1').DataTable();
        table1.clear().draw();

        console.log('2');
        if (!$.fn.dataTable.isDataTable("#datatable2")) {
            var table2 = $('#datatable2').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5'
                ]
            })
            console.log($.fn.dataTable.isDataTable("#datatable2"));
        }
        console.log('2');
        $('#datatable2').DataTable().clear().draw();
        $("#tbl_id").hide();
        // console.log('checker');
        let searchinput = $('#searchinput').val();
        if (searchinput == '') {
            emptysearchalert();
            return false;
        }
        $.ajax({
            url: "{{ route('SearchShow') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                searchinput: searchinput,
            },
            success: function(response) {
                // console.log(response);
                if (response[0] == 0) {
                    // console.log('0');
                    emptysearchalert();
                } else {
                    // console.log(response[1].id);
                    $("#searchtable1").DataTable({
                        retrieve: true,
                        "lengthChange": false,
                        scrollCollapse: true,
                        scrollX: true,
                    }).buttons().container().appendTo('#report1_wrapper .col-md-6:eq(0)');
                    var t = $('#searchtable1').DataTable();
                    t.clear().draw();
                    for (let row = 0; row < response[1].length; row++) {
                        t.row.add([row + 1,
                            `<i class = "fa fa-edit" style="cursor:pointer" id="searchrowbutton" onclick="getData('${response[1][row].id}','${response[1][row].ticket_no}')"></i>`,
                            response[1][row].ticket_no, response[1][row].customer_name,
                            response[1][row].mobile_number, response[1][row]
                            .interaction_type, response[1][row].product_type, response[1][
                                row
                            ].contact_reason, response[1][row].contact_reason_type,
                            response[1][row].contact_reason_sub_sub_type, response[1][row]
                            .call_status, response[1][row].final_call_status, response[1][
                                row
                            ].created_at
                        ]).draw(false);
                    }
                    $("#tbl_id").show();
                }
            }
        });
    });
</script>

<script>
    $("#new_ticket_button").click(function() {
        // document.getElementById("firstform").reset();

        $('#firstform').trigger("reset");
        $('#table_old_new').hide();
        var table1 = $('#datatable1').DataTable();
        table1.clear().draw();
        console.log('1');
        var table2 = $('#datatable2').DataTable();
        console.log($.fn.dataTable.isDataTable("#datatable2"));
        console.log('1');
        table2.clear().draw();

        $("#contact_reason_sub").empty();
        $('#contact_reason_sub').append($('<option value="' + '">' + ' Select Sub Type ' + '</option>'));

        $("#contact_reason_sub_sub").empty();
        $('#contact_reason_sub_sub').append($('<option value="' + '">' + ' Select Sub Sub Type ' +
            '</option>'));

        $("#pincode").empty();
        $('#pincode').append('<option value="' + '">' + ' Select a Pincode ' + '</option>');

        $("#dealership_location").empty();
        $('#dealership_location').append('<option value="' + '">' + ' Select dealership location ' +
            '</option>');

        $('#call_status_sub_sub_type').empty().append('<option value="NA"> Select Call Status</option>');

        $("#ticket_form").show();
        // ticket_button();
    });
</script>

<script>
    $("#contact_reason").change(function() {
        var contact_reason_val = $(this).val();
        // console.log(contact_reason_val);
        contactreason_ajax(contact_reason_val);
    });
</script>
<script>
    $("#contact_reason_sub").change(function() {
        var contact_reason_sub_val = $(this).val();
        // console.log($('#contact_reason').val());
        contact_reason_sub_ajax(contact_reason_sub_val);
    });
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.city').select2()
        $('.pincode').select2()
    });
</script>
<script>
    $("#city").change(function() {
        var city_val = $(this).val();
        $.ajax({
            url: "{{ route('pincode') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                city_val: city_val,
            },
            success: function(response) {
                // console.log(response);
                $("#pincode").empty();
                $('#pincode').append('<option value="' + '">' + ' Select a Pincode ' + '</option>');
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['pincode'] + '">' +
                        response[val]['pincode'] + '</option>');
                    $('#pincode').append(newOption);
                }
            },
        });
    });
</script>
<script>
    $("#dealership").change(function() {
        var dealership_val = $(this).val();
        $.ajax({
            url: "{{ route('dealershiplocation') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                dealership_val: dealership_val,
            },
            success: function(response) {
                // console.log(response);
                $("#dealership_location").empty();
                $('#dealership_location').append('<option value="' + '">' +
                    ' Select dealership location ' + '</option>');
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['dealership_location'] +
                        '">' + response[val]['dealership_location'] + '</option>');
                    $('#dealership_location').append(newOption);
                }
            },
        });
    });
</script>

<script>
    $("#call_status").change(function() {
        var call_status = $("#call_status").val();
        //var sub_type_id = $(this).val();
        if (this.value == "Follow-up") {
            //alert("1");
            $('#call_status_sub_type').empty().append(
                '<option value="NA"> NA</option><option value="High Priority">High Priority</option><option value="Low Priority">Low Priority</option>'
            );
        }
        if (this.value == "Escalation") {
            //alert("2");
            $('#call_status_sub_type').empty().append(
                '<option value="NA"> NA</option><option value="High">High</option><option value="Low">Low</option><option value="Medium">Medium</option>'
            );
        }
        if (this.value == "Resolved") {
            //alert("3");
            $('#call_status_sub_type').empty().append('<option value="NA"> NA</option>');
        }
    });
</script>

<script>
    $("#call_status_sub_type").change(function() {
        var call_status_sub_type = $("#call_status_sub_type").val();


        if (this.value == "High Priority") {

            $('#call_status_sub_sub_type').empty().append(
                '<option value="NA"> NA</option><option value="Dealer">Dealer</option><option value="Revolt Hub Sales">Revolt Hub Sales</option><option value=" Revolt Hub Finance"> Revolt Hub Finance</option><option value="Call Centre">Call Centre</option> <option value="Revolt CRM">Revolt CRM</option>'
            );
        }
        if (this.value == "Low Priority") {

            $('#call_status_sub_sub_type').empty().append(
                '<option value="NA"> NA</option><option value="Revolt Hub Sales">Revolt Hub Sales</option><option value=" Revolt Hub Finance"> Revolt Hub Finance</option><option value="Call Centre">Call Centre</option><option value="Revolt CRM">Revolt CRM</option>'
            );

        }
        if (this.value == "High" || this.value == "Low" || this.value == "Medium" || this.value == "NA") {
            $('#call_status_sub_sub_type').empty().append('<option value="NA"> NA</option>');

        }
    });
</script>

<script>
    $("#contact_reason_sub_sub").change(function() {
        var sub_sub = $("#contact_reason_sub_sub").val();
        $('#app_product_issue').hide();
        $('#issue_div').hide();
        if (sub_sub == "Service Quality" || sub_sub == "Spare Part Availability") {
            $('#issue_div').show();
        }
        if (sub_sub == "Application") {
            $('#app_product_issue').show();
        }
    });
</script>


<script>
    $("#date-time-picker").datetimepicker();
</script>

<script>
    var start = moment().subtract(0, 'days');
    var end = moment();

    function cb(start, end) {

        $('#dateRange').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        $('#dateRange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    }
    $('#dateRange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    }, cb);
    cb(start, end);
</script>



<script type="text/javascript">
    $("#reportbtn").click(function() {
        $('#report12').show();
        $('.user_datatable').DataTable().destroy();
        var date = $('#dateRange').val();

        if (date != null) {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: 500,
                scroller: {
                    loadingIndicator: true
                },
                sScrollX: "100%",
                scrollCollapse: true,
                ajax: {
                    url: "{{ route('getreportdata') }}",
                    data: {
                        date: date,
                    }
                },
                columns: [{
                        data: 'ticket_no',
                        name: 'ticket_no'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'email_id',
                        name: 'email_id'
                    },
                    {
                        data: 'interaction_type',
                        name: 'interaction_type'
                    },
                    {
                        data: 'social_media_source',
                        name: 'social_media_source'
                    },
                    {
                        data: 'product_type',
                        name: 'product_type'
                    },
                    {
                        data: 'old_contact_reason',
                        name: 'old_contact_reason'
                    },
                    {
                        data: 'contact_reason',
                        name: 'contact_reason'
                    },


                    {
                        data: 'contact_reason_type',
                        name: 'contact_reason_type'
                    },
                    {
                        data: 'contact_reason_sub_sub_type',
                        name: 'contact_reason_sub_sub_type'
                    },
                    {
                        data: 'booking_id',
                        name: 'booking_id'
                    },
                    {
                        data: 'chasis_number',
                        name: 'chasis_number'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'pincode',
                        name: 'pincode'
                    },
                    {
                        data: 'purchase_date',
                        name: 'purchase_date'
                    },
                    {
                        data: 'warranty_status',
                        name: 'warranty_status'
                    },
                    {
                        data: 'dealership',
                        name: 'dealership'
                    },
                    {
                        data: 'dealership_location',
                        name: 'dealership_location'
                    },
                    {
                        data: 'location_code',
                        name: 'location_code'
                    },
                    {
                        data: 'dealer_code',
                        name: 'dealer_code'
                    },
                    {
                        data: 'store_location_code',
                        name: 'store_location_code'
                    },
                    {
                        data: 'store_location_name',
                        name: 'store_location_name'
                    },
                    {
                        data: 'dealer_state',
                        name: 'dealer_state'
                    },
                    {
                        data: 'call_status',
                        name: 'call_status'
                    },
                    {
                        data: 'call_status_sub_type',
                        name: 'call_status_sub_type'
                    },
                    {
                        data: 'call_status_sub_sub_type',
                        name: 'call_status_sub_sub_type'
                    },
                    {
                        data: 'final_call_status',
                        name: 'final_call_status'
                    },
                    {
                        data: 'remark',
                        name: 'remark'
                    },
                    {
                        data: 'ResolutionProvided',
                        name: 'ResolutionProvided'
                    },
                    {
                        data: 'product_issue',
                        name: 'product_issue'
                    },
                    {
                        data: 'app_product_issue',
                        name: 'app_product_issue'
                    },
                    // {
                    //     data: 'agent_id',
                    //     name: 'agent_id'
                    // },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        }
    });
</script>


@if ($message = Session::get('addusererr'))
    <script>
        document.getElementById('adduserbutton').click();
    </script>
@endif


@if ($message = Session::get('success'))
    <script type="text/javascript">
        $(function() {
            // alert('bjhbjh');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: '{{ $message }}'
            })
        })
    </script>
@endif



@if ($message = Session::get('Alert'))
    <script type="text/javascript">
        $(function() {
            // alert('bjhbjh');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: '{{ $message }}'
            })
        })
    </script>
@endif


<script>
    function emptysearchalert() {
        $(function() {
            // alert('bjhbjh');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: 'No Data Record Found'
            })
        })
    }
</script>

<script>
    $("#adduserform").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
            },
            usertype: {
                required: true,
            },

        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>

<script>
    $("#edit_user").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                minlength: 8,
            },
            usertype: {
                required: true,
            },

        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>

<script>
    $("#firstform").validate({
        rules: {
            email_id: {
                required: true,
                email: true
            },
            remark: {
                required: true,

            },
            ResolutionProvided: {
                required: true,

            },
            contact_reason: {
                required: true,

            },
            contact_reason_sub: {
                required: true,

            },
            contact_reason_sub_sub: {
                required: true,

            },
            call_status: {
                required: true,

            },
            booking_id: {
                required: true,
            },
            mobile_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            issue: {
                required: true,
            },
        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            $("#Submit").attr("disabled", true);
            form.submit();
        },
    });
</script>

<script>
    $("#firstform1").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {},
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>




@if ($message = Session::get('ticketerrorrr'))
    <script>
        $("#ticket_form").show();
    </script>
@endif

<script>
    function getData(id, ticket_no) {

        $.ajax({
            url: "{{ route('searchdataform') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                ticket_no: ticket_no,
            },
            success: function(response) {
                console.log(response[0][0]);
                $('#city').val(response[0][0].city);
                $('#city').trigger('change');
                $('#contact_reason').val(response[0][0].contact_reason).trigger('change');
                // contactreason_ajax(response[0][0].contact_reason);
                contact_reason_sub_ajax(response[0][0].contact_reason_type);
                $('#dealership').val(response[0][0].dealership).trigger('change');
                $('#call_status').val(response[0][0].call_status).trigger('change');
                $('#call_status_sub_type').val(response[0][0].call_status_sub_type).trigger('change');
                $('#ticket_no').val(response[0][0].ticket_no);
                $('#customer_name').val(response[0][0].customer_name);
                $('#mobile_number').val(response[0][0].mobile_number);
                $('#email_id').val(response[0][0].email_id);
                $('#product_type').val(response[0][0].product_type); 
                $('#booking_id').val(response[0][0].booking_id);
                $('#chasis_number').val(response[0][0].chasis_number);
                $('#purchase_date').val(response[0][0].purchase_date);
                $('#warranty_status').val(response[0][0].warranty_status);
                $('#call_status_sub_sub_type').val(response[0][0].call_status_sub_sub_type);
                $('#final_call_status').val(response[0][0].final_call_status);
                if (response[0][0].interaction_type == "Social Media") {
                    $("#social_media_source1").show();
                    $('#interaction_type').val(response[0][0].interaction_type).trigger('change');
                } else {
                    $("#social_media_source1").hide();
                    $('#interaction_type').val(response[0][0].interaction_type);
                }
                setTimeout(() => {
                    $('#contact_reason_sub').val(response[0][0].contact_reason_type);
                    $('#contact_reason_sub_sub').val(response[0][0].contact_reason_sub_sub_type)
                        .trigger('change');
                    $('#pincode').val(response[0][0].pincode);
                    // $('#social_media_source').val(response[0][0].social_media_source);
                    // console.log( $('#dealership_location').val());
                    $('#dealership_location').val(response[0][0].dealership_location).trigger(
                        'change');
                    // console.log(response[0][0].dealership_location);
                    // $('#issue').val(response[0][0].product_issue);
                    var productIssues = response[0][0].product_issue.split(',');
                    $('#issue').val(productIssues).trigger('change');
                    $('#location_code').val(response[0][0].location_code);
                    $('#dealer_code').val(response[0][0].dealer_code);
                    $('#store_location_code').val(response[0][0].store_location_code);
                    $('#store_location_name').val(response[0][0].store_location_name);
                    $('#dealer_state').val(response[0][0].dealer_state);
                    if (response[0][0].interaction_type == "Social Media") {
                        $('#social_media_source').val(response[0][0].social_media_source);
                    }
                }, 880);
                var table1 = $('#datatable1').DataTable();
                table1.clear().draw();
                for (let array_no = 0; array_no < response[2].length; array_no++) {
                    table1.row.add([array_no + 1, response[2][array_no].agent_id, response[2][array_no]
                        .remark, response[2][array_no].ResolutionProvided, response[2][array_no]
                        .ticket_no, response[2][array_no].call_status, response[2][array_no]
                        .final_call_status, response[2][array_no].created_at
                    ]).draw(false);
                }

                console.log('3');
                // Initialize the DataTable for datatable2
                var table2 = $('#datatable2').DataTable({
                    retrieve: true,
                    lengthChange: false,
                    scrollCollapse: true,
                    scrollX: true
                });

                // Clear the table before adding data
                table2.clear().draw();

                // Loop through the response data and add rows to the table
                for (let array_no = 0; array_no < response[1].length; array_no++) {
                    table2.row.add([
                        array_no + 1,
                        response[1][array_no].agent_id,
                        response[1][array_no].remark,
                        response[1][array_no].ResolutionProvided,
                        response[1][array_no].ticket_no,
                        response[1][array_no].call_status,
                        response[1][array_no].contact_reason_type,
                        response[1][array_no].final_call_status,
                        response[1][array_no].created_at,
                        response[1][array_no].customer_name,
                        response[1][array_no].mobile_number,
                        response[1][array_no].email_id,
                        response[1][array_no].interaction_type,
                        response[1][array_no].social_media_source,
                        response[1][array_no].product_type,
                        response[1][array_no].contact_reason,
                        response[1][array_no].contact_reason_sub_sub_type,
                        response[1][array_no].booking_id,
                        response[1][array_no].chasis_number,
                        response[1][array_no].city,
                        response[1][array_no].pincode,
                        response[1][array_no].purchase_date,
                        response[1][array_no].warranty_status,
                        response[1][array_no].dealership,
                        response[1][array_no].dealership_location,
                        response[1][array_no].location_code,
                        response[1][array_no].dealer_code,
                        response[1][array_no].store_location_code,
                        response[1][array_no].store_location_name,
                        response[1][array_no].dealer_state,
                        response[1][array_no].call_status_sub_type,
                        response[1][array_no].call_status_sub_sub_type,
                        response[1][array_no].product_issue,
                        response[1][array_no].app_product_issue
                    ]).draw(false);
                }
                $('#datatable2').addClass('table-responsive');
                $('#ticket_form').show();
                $('#table_old_new').show();
            },
        });
    }
</script>

@if ($message = Session::get('ticket_no'))
    <script type="text/javascript">
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Ticket Generated Successfully',
            subtitle: '',
            body: '     {{ $message }}     '
        });
    </script>
@endif

<script>
    $('#purchase_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>
</body>

</html>
