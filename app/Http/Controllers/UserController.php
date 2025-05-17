<?php



namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show user management page
    public function index()
    {
        return view('user.index');
    }

    // AJAX: Get all users for DataTable
    public function getUsers()
    {
        $users = User::where('is_admin',0)->latest()->get();

        return response()->json([
            'data' => $users
        ]);
    }

    // AJAX: Store a new user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'password' => 'required',
            'is_active'=> 'required|boolean',
            // 'is_admin' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'password'  => Hash::make($request->password),
            'is_active' => $request->is_active,
            'is_admin'  => $request->is_admin,
        ]);

        return response()->json(['message' => 'User added successfully.']);
    }

    // AJAX: Get user by ID for editing
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // AJAX: Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $id,
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'is_active'=> 'required|boolean',
            // 'is_admin' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 422);
        }

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'is_active' => $request->is_active,
            'is_admin'  => $request->is_admin,
        ]);

        return response()->json(['message' => 'User updated successfully.']);
    }

    // AJAX: Delete user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User deleted successfully.']);
        
    }
}

