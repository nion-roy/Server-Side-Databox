<?php

namespace App\Http\Controllers;

use App\Traits\DataTableActions;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{


    use DataTableActions;


    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $users = User::latest()->get();
    //         return DataTables::of($users)
    //             ->addIndexColumn()
    //             ->addColumn('created_at', function ($row) {
    //                 return \Carbon\Carbon::parse($row->created_at)->format('d-M-Y H:i A');
    //             })
    //             ->addColumn('action', function ($row) {
    //                 $btn = '<a href="' . route('users.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
    //                 $btn .= ' <form action="' . route('users.destroy', $row->id) . '" method="POST" style="display:inline;">
    //                             ' . csrf_field() . '
    //                             ' . method_field('DELETE') . '
    //                             <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    //                           </form>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('welcome');
    // }


    public function index()
    {
        return view('welcome');
    }


    public function retrievedUser()
    {
        return DataTables::of(User::query())
            ->addColumn('status', function ($data) {
                return view('partials.status-buttons', ['user' => $data]);
            })
            ->addColumn('actions', function ($data) {
                return view('partials.action-buttons', ['user' => $data]);
            })
            ->rawColumns(['status,actions'])
            ->make(true);
    }


    // This code will be working
    // public function retrievedUser(Request $request)
    // {
    //     return DataTables::of(User::query())->make(true);
    // }


    public function deleteUser($id)
    {
        $user = User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }


    public function statusUser(Request $request, $id)
    {
        return $request;
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
