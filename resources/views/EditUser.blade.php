<x-header />
<x-side_bar />
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12" align="left">
                    <h1>EDIT USER</h1>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('EditUser') }}" enctype="multipart/form-data" method="POST" id="edit_user">

                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            <div class="form-group  col-md-6">
                                <label>Name</label>
                                <input value="{{ $data['name'] }}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group  col-md-6">
                                <label>Login ID</label>
                                <input value="{{ $data['email'] }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group  col-md-6">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Leave blank for using old password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            @if(Auth::user()->id != $data['id'] )
                            <div class="form-group  col-md-6">
                                <label>User Type:</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="usertype" id="usertype" required>
                                    <option value=""> Select Role</option>
                                    <option value="Agent" {{ ($data->usertype) == 'Agent' ? 'selected' : '' }}> Agent</option>
                                    <option value="Admin" {{ ($data->usertype) == 'Admin' ? 'selected' : '' }}> Admin</option>
                                </select>

                                @error('usertype')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endif


                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="id" value="{{ $data['id'] }}">
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px; float:right">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<x-footer />