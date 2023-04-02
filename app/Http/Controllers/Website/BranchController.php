<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $page_breadcrumbs = [
            ['page' => route('break.index') , 'title' =>__('lang.home'),'active' => false],
            ['page' => '#' , 'title' =>__('lang.branches'),'active' => true],
        ];
        return view('website.branches',[
            'branches' => BranchResource::collection(Branch::with(['user'])->get())->resolve(),
            'page_breadcrumbs' => $page_breadcrumbs
        ]);
    }
}
