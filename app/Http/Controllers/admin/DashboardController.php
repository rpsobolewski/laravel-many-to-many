<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {

        $total_projects = Project::all()->count();
        $total_types = Type::all()->count();

        $total_users = User::all()->count();





        return view('admin.dashboard', compact('total_projects',  'total_types', 'total_users'));
    }
}
