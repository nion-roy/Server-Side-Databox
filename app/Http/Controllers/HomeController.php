<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $users = User::latest()->get();
      return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('created_at', function ($row) {
          return \Carbon\Carbon::parse($row->created_at)->format('d-M-Y H:i A');
        })
        ->addColumn('action', function ($row) {
          $btn = '<a href="' . route('users.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
          $btn .= ' <form action="' . route('users.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>';
          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('welcome');
  }





  public function destroy(String $id)
  {
    User::destroy($id);
    return redirect()->route('users.index')->with('success', 'User deleted successfully');
  }
}
