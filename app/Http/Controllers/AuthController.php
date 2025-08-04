<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
        ]);
        
        $perPage = 10;
        $query = User::select('id','name', 'email', 'role_id', 'created_at')
                    ->with('role'); 
        if (isset($validated['name'])) {
            $query->where('name', 'like', '%' . $validated['name'] . '%');
        }
        if (isset($validated['email'])) {
            $query->where('email', 'like', '%' . $validated['email'] . '%');
        }
        $note = $query->orderBy('id', 'DESC')->paginate($perPage);
        return view('users.index', ['users' => $note]);
    }
    public function edit(Request $request, $id){
            // Find the user by ID or fail if not found
        $user = User::findOrFail($id);
        
        // Return the edit view and pass the user data to it
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,  // Ignore the current user's email while validating
                'password' => 'nullable|string|min:6|confirmed',  // Optional password update
            ]);

            // Find the user by ID
            $user = User::findOrFail($id);

            // If password is provided, hash and update it
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Update the user's information (except password if not provided)
            $user->update($validated);

            // Redirect to the list page with a success message and paginated results
            return redirect()->route('users.index', ['page' => $request->input('page', 1)])
                            ->with('success', 'User updated successfully!');

        } catch (\Exception $e) {
            // Flash error message if something fails
            session()->flash('error', 'Updating failed. Please try again.');
            return redirect()->back(); 
        }
        
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Failed to delete user. Please try again.');
        }
    }
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|unique:users,email',
                        'password' => 'required|string|min:6|confirmed',
                        'password_confirmation' => 'required|string|min:6',
                        'role_id'=>'required|integer|exists:roles,id'
                    ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);
           
            session()->flash('success', 'Registration is successful.');
            return redirect()->route('users.index');

        } catch (\Exception $e) {
            // Flash error message if something fails
            session()->flash('error', 'Registration failed. Please try again.');
            return redirect()->back(); // Go back to the previous page
        }
        
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('dashboard');
        }

        // Authentication failed
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Invalid email or password.',
            ]);
    }
    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent any potential CSRF attacks after logout
        $request->session()->regenerateToken();

        // Redirect the user to the welcome page (or your desired page)
        return redirect('welcome');
    }
    public function showRegistrationForm(){
        $roles = Role::all();  // Assuming 'Role' is your model for roles table
        return view('users.create', compact('roles'));
    }
    public function dashboard(Request $request){
        $user = Auth::user();
        if($user->role_id===1){
            $totalAdmins    =   User::where('role_id', '1')->count();
            $totalUsers     =   User::where('role_id', '2')->count();
            $totalNotes     =   Note::count();
            $recentAcc      =   User::select('id', 'name', 'email', 'role_id', 'created_at')
                                    ->with('role')
                                    ->limit(5) 
                                    ->get(); 

            $totals = [
                'admins' => $totalAdmins,
                'users' => $totalUsers,
                'notes' => $totalNotes,
                'records' => $recentAcc
            ];

            return view('dashboard', compact('totals'));
        }else{
            $totalNotes     =   Note::where('user_id', $user->id)->count();
            $recentNotes     =   Note::select('id','title', 'description', 'user_id', 'date', 'created_at')
                                    ->with('user')
                                    ->limit(5) 
                                    ->get(); 

            $totals = [
                'notes' => $totalNotes,
                'records' => $recentNotes
            ];

            return view('dashboard', compact('totals'));
        }
        
    }
}
