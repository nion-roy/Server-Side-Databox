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
      return DataTables::of(User::query())->make(true);
    }

    return view('welcome');
  }
}
