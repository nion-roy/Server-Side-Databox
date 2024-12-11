<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;

trait DataTableActions
{
    public function viewUser($id)
    {
        return User::findOrFail($id); // Fetch and return user details
    }

    public function editUser($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all()); // Update user with validated data
        return response()->json(['success' => 'User updated successfully']);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete or hard delete
        return response()->json(['success' => 'User deleted successfully']);
    }
}
