<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $page_breadcrumbs = [
            ['page' => '#' , 'title' =>__('lang.home'),'active' => false],
        ];
        return view('branch.dashboard',[
            'page_title' =>__('lang.home'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
}
