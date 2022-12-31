<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $page_breadcrumbs = [
            ['page' => '#' , 'title' =>__('lang.home'),'active' => false],
        ];
        return view('dashboard.dashboard',[
            'page_title' =>__('lang.home'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
}
