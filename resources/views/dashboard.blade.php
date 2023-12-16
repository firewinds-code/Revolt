<x-header />
<x-side_bar />
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Management</h1>
                </div>
                <div class="col-sm-2" align="right">
                    <button type="button" class="btn btn-block btn-primary" style="margin-left: 350px;" data-toggle="modal" data-target="#modal-default" id="adduserbutton">
                        Add User
                    </button>

                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body card-primary card-outline table-responsive">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <th>Sno.</th>
                                <th>Emp Id</th>

                                <th>Name</th>
                                <th>Type</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($datatb as $data)
                                @if($data->usertype == 'SuperAdmin' && Auth::user()->usertype != 'SuperAdmin')

                                @else
                                <tr class="gradeX">
                                    <td>{{$page++}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->usertype}}</td>
                                    <td>
                                        <div class="btn-group" style="padding:10px;align-items: center;justify-content: center;margin-left: 25%;">


                                            <a href="{{ route('EditUserForm',$data->id) }}"> <i class=" fa fa-edit" style="padding:5px"></i></a>
                                            @if(Auth::user()->id != $data->id)
                                            <a href="{{ route('delete',$data->id) }}" onclick="return confirm('Do you really want to Delete?');"><i class="fa fa-trash" style="color: #b91010;padding:5px"></i></a>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('AddUser') }}" method="POST" id="adduserform">
                        <x-user-form />

                </div>
            </div>
        </div>



    </section>
</div>
<x-footer />