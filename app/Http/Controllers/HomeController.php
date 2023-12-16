<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function usermanagementshow(Request $req)
    {
        $datatb = User::all();
        if (!isset($req->page)) {
            $page = 1;
        } else {
            $page = $req->page;
            $page = (($page - 1) * 3) + 1;
        }
        return view('dashboard', compact('datatb', 'page'));
    }

    public function AddUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'usertype' => ['required', 'string'],

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('addusererr', "error");
        }


        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->usertype = $req->usertype;


        $save = $user->save();
        if ($save == 1) {

            return back()->with('success', 'User Added Successfully');
        } else {
        }
    }

    public function EditUserForm($id)
    {
        $data = User::find($id);

        return view('EditUser', ['data' => $data]);
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();

        return back()->with('success', 'User Deleted Successfully');
    }

    public function EditUser(Request $req)
    {

        $req->validate([
            'name' => ['required', 'string'],


            'usertype' => ['string'],

        ]);

        $id = $req->id;
        $userdata = User::find($id);
        $email = $userdata->email;

        if (strcmp($email, $req->email)) {
            $req->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $userdata->email = $req->email;
        }

        $userdata->name = $req->name;
        $userdata->usertype = $req->usertype;

        if ($req->password != null) {
            $req->validate(['password' => ['string', 'min:8'],]);

            $userdata->password = Hash::make($req->password);
        }


        $userdata->save();
        // return redirect('home');
        return redirect('usermanagement')->with('success', 'User Updated Successfully');
    }
}
