<x-header />
<x-side_bar />
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>&nbsp;Update Ticket</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        @csrf
                        <div class="form-group col-md-9">
                            <br>
                            <div class="input-group col-md-10">
                                <input type="text" class="form-control float-right" id="searchinput1" name="searchinput1" placeholder="Enter Mobile , Ticket Number for search from Mobile Number,Ticket Number" required autocomplete="off">
                                <div class="col-md-2">
                                    <button type="button" id="searchsubmit1" onclick="update()" class="btn btn-block btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                    <div class="card card-primary ">
                        <div class="form-group col-md-12" style=" padding: 25px 20px 5px 20px;" id="ticket_form">
                            <form method="POST" action="{{route('postupdateticket')}}" enctype="multipart/form-data" name="firstform" id="firstform" data-parsley-validate>
                                @csrf

                                <input type="hidden" id="id1" name="id1" class="form-control">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Reason</label>
                                            <select class="form-control @error('contact_reason') is-invalid @enderror" id="contact_reason" name="contact_reason">
                                                <option value=""> Select Contact Reason</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Reason Sub type</label>
                                            <select class="form-control @error('contact_reason_sub') is-invalid @enderror" id="contact_reason_sub" name="contact_reason_sub">
                                                <option value=""> Select Contact Reason Type</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Reason Sub Sub type</label>
                                            <select class="form-control @error('contact_reason_sub_sub') is-invalid @enderror" id="contact_reason_sub_sub" name="contact_reason_sub_sub">
                                                <option value=""> Select Contact Reason Type</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <button type="submit" id="" class="btn btn-block btn-primary" style="margin-left: 420px;"> Update</button>
                                    </div>
                                </div>

    </section>
</div>
<script>
    function contactreason_ajax(contact_reason_val) {
        $.ajax({
            url: "{{route('contactreason')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                contact_reason_val: contact_reason_val,
            },
            success: function(response) {
                // console.log(response);
                $("#contact_reason_sub").empty();
                // $('#contact_reason_sub_option').html(' Select Sub Type ');
                $('#contact_reason_sub').append($('<option value="' + '">' + ' Select Sub Type ' + '</option>'));
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['contact_reason_sub_type'] + '">' + response[val]['contact_reason_sub_type'] + '</option>');
                    $('#contact_reason_sub').append(newOption);
                }
            },

        });
    }

    function contact_reason_sub_ajax(contact_reason_sub_val) {
        $.ajax({
            url: "{{route('contactreasonsub')}}",
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
                $('#contact_reason_sub_sub').append($('<option value="' + '">' + ' Select Sub Sub Type ' + '</option>'));
                for (val in response) {
                    var newOption = $('<option value="' + response[val]['contact_reason_sub_sub_type'] + '">' + response[val]['contact_reason_sub_sub_type'] + '</option>');
                    $('#contact_reason_sub_sub').append(newOption);
                }
            },

        });
    }
</script>
<script>
    function ticket_button() {
        $.ajax({
            url: "{{route('newticketshow')}}",
            type: "get",
            success: function(response) {
                console.log(response);
                for (val in response['1']) {
                    var newOption = $('<option value="' + response['1'][val]['contact_reason'] + '">' + response['1'][val]['contact_reason'] + '</option>');
                    $('#contact_reason').append(newOption);
                }
            },
        });
    }

    ticket_button();
</script>
<script>
    function update() {
        var id = $('#searchinput1').val();
        // alert(id);
        $.ajax({
            type: "get",
            url: "{{route('searchupdateticket')}}",
            data: {
                "id": id
            },
            success: function(data) {
                console.log(data.data);
                $('#id1').val(data.data);
                $('#contact_reason').val(data.data1[0].contact_reason).change();
                setTimeout(() => {
                    $('#contact_reason_sub').val(data.data1[0].contact_reason_type).change();
                }, 100);
                setTimeout(() => {
                    $('#contact_reason_sub_sub').val(data.data1[0].contact_reason_sub_sub_type).change();
                }, 1000);
            }
        });
    };
</script>
<x-footer />