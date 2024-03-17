<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Config;

use Validator;
use Response;
use Redirect;
use App\Models\State;
use App\Models\City;
use App\Models\Country;

class AdminController extends Controller {

    public function admin() {
        return view('admin.login');
    }
    public function index() {
        return view('admin.login');
    }
    public function adminLogin(Request $request) {
        $request->validate(['email' => 'required', 'password' => 'required', ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            return redirect()->intended('admin/dashboard')->with('login-success','Login Successfully!');
        }

        return redirect("admin/login")->withSuccess('Login details are not valid');
    }
    public function registration() {

        // $data['states'] = State::get(["name", "id"]);
        // return view('admin.registration', $data);

        return view('admin.registration');
    }
    public function adminRegistration(Request $request) {
        echo "<pre>";
        print_r($_POST);
        // die;
        $request->validate(['name' => 'required', 'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'c_password' => 'required|same:password',

        ]);

        $data = $request->all();
        $check = $this->create($data);
        return redirect("admin/login")->with('success-registration', 'Congratulations! you are successfully registered.');
    }
    public function create(array $data) {
        return user::create(['name' => $data['name'],
         'email' => $data['email'],
         'password' => Hash::make($data['password'],
         ) ]);
    }
    public function dashboard() {
        if(Auth::guard('user')->check()){

        return view('admin.dashboard');
        }
        return redirect("admin/login")->withSuccess('are not allowed to access');
    }
    public function signOut() {
        Session::flush();
        Auth::guard('user')->logout();
        return Redirect('admin/login');
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function show()
    {

        // Fetch user data from database or session
        $user = auth('user')->user(); // Assuming the user is authenticated

        // Return the view with user data
        return view('admin.profile', ['user' => $user]);

    }


    public function userList()
    {
        if(Auth::guard('user')->check()){
             $users = User::latest()->paginate(5);
             return view('admin.user.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        }

        return redirect("admin/login")->withErrors('Opps! You do not have access');
    }

    public function addUser()
{

    return view('admin.user.create');
}

public function saveUser(Request $request)
{
    // Check if an admin with the provided email already exists
    if (User::where('email', $request['email'])->exists()) {
        return redirect()->route('admin.user.createuser')->withError('User with this email already exists.');
    }

    // Custom logic to check if the phone number exists for the same country code
    // $phoneExists = User::where('country_code', $request['country_code'])
    //     ->where('phone_no', $request['phone_no'])
    //     ->exists();

    // if ($phoneExists) {
    //     return redirect()->route('admin.user.createuser')->withError('User with the same phone number in this country code already exists.');
    // }

    $request->validate([
        'name' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    $imageName = '';

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/user'), $imageName); // Move the uploaded image to the public/images directory
    }

    User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'image' => $imageName,
        'password' => Hash::make($request['password']),
    ]);

    return redirect()->route('admin.user.createuser')->withSuccess('User created successfully');
}

public function editUser($id)
{
    $user = User::find($id);

    if (!$user) {

        return redirect()->route('admin.user')->withErrors('User not found');
    }

    return view('admin.user.edit', compact('user'));
    // $countryCodes = CountryCode::pluck('phonecode', 'phonecode'); // Assuming 'code' is the column name for country codes
    // return view('admin.edituser', compact('user', 'countryCodes'));

}

public function updateUser(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('admin.user')->withError('User not found');
    }

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id, // Unique check for email, excluding the current admin's email
        'password' => 'required|min:6',
    ]);

    // Check if an admin with the provided email already exists
        if (User::where('email', $request['email'])->where('id', '!=', $id)->exists()) {
            return redirect()->route('admin.user.edituser', ['id' => $id])->withError('User with this email already exists.');
        }

        // Custom logic to check if the phone number exists for the same country code
        // $phoneExists = User::where('country_code', $request['country_code'])
        //                     ->where('phone_no', $request['phone_no'])
        //                     ->where('id', '!=', $id) // Exclude the current admin by ID
        //                     ->exists();
        // // echo "$phoneExists";
        // // die;
        // if ($phoneExists) {
        //     return redirect()->route('admin.dashboard.user.edituser', ['id' => $id])->withError('User with the same phone number in this country code already exists.');
        // }


    if ($request->hasFile('image')) {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/user'), $imageName);

        // Delete the old image if a new one is uploaded
        if ($user->image) {
            $oldImagePath = public_path('uploads/user/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $user->image = $imageName;
    }

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->save();

    return redirect()->route('admin.user.edituser', ['id' => $id])->withSuccess('User updated successfully');
}

public function updateuserPassword(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('admin.dashboard.user')->withError('User not found');
    }

    $request->validate([
        'password' => 'required|min:6',
        'c_password' => 'required|same:password', // New validation rule
    ]);

    $user->password = Hash::make($request->input('password'));
    $user->save();

    return redirect()->route('admin.dashboard.user.edituser', ['id' => $id])->withSuccess('User Password updated successfully');
}

public function viewUser($id)
{
    $user = User::find($id);

    if (!$user) {

        return redirect()->route('admin.user')->withErrors('User not found');
    }

    return view('admin.user.view', compact('user'));
    // $countryCodes = CountryCode::pluck('phonecode', 'phonecode'); // Assuming 'code' is the column name for country codes
    // return view('admin.edituser', compact('user', 'countryCodes'));

}

public function deleteUser($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('admin.user')->withError('User not found');
    }

    // Delete the admin's image if it exists
    if ($user->image) {
        $imagePath = public_path('uploads/user/' . $user->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $user->delete();

    return redirect()->route('admin.user')->withSuccess('User deleted successfully');
}


}












