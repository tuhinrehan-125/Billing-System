<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Category;
use App\SubCategory;
use App\Employee;
use App\Project;
use App\User;
use App\Income;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard(){
        $project=Project::where('delete_status',1)->count();
        $employee=Employee::where('delete_status',1)->count();
        $admin=User::where('delete_status',1)->count();
        $expense=Expense::where('delete_status',1)->where('status',1)->sum('total_expense');
        $invoiceExpnse=Expense::where('delete_status',1)->count();
        $income=Income::where('delete_status',1)->sum('total_amount');
        return view('dashboard',compact('project','employee','admin','expense','income','invoiceExpnse'));
    }
}
