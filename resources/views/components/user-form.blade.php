@csrf
<div class="modal-body">

    <div class="row">

        <div class="form-group  col-md-6">
            <label>Name</label>
            <input placeholder="Enter Name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group  col-md-6">
            <label>Login ID</label>
            <input placeholder="Enter Login ID" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group  col-md-6">
            <label>Password</label>
            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-group  col-md-6">
            <label>User Type:</label>
            <select class="form-control @error('role') is-invalid @enderror" name="usertype" id="usertype">
                <option value=""> Select Role</option>
                <option value="Agent"> Agent</option>
                <option value="Admin"> Admin</option>
            </select>

            @error('usertype')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



    </div>

</div>
<div class="modal-footer justify-content-between">

    <button type="submit" class="btn btn-primary" style="margin-top: 20px; float:right">Save changes</button>
</div>
</form>