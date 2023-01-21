<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Requests\Settings\SettingRequest;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Website\BranchResource;
use App\Models\Addon;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAddon;
use App\Models\ProductBranch;
use App\Models\ProductPhoto;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings-update', ['only' => ['create', 'store']]);
    }
    public function create()
    {
        $page_title = __('lang.settings');
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title'=>__('lang.settings'),'active' => false],
        ];
        return view('dashboard.settings.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => Setting::query()->first(),
        ]);
    }
    public function store(SettingRequest $request, $id = null)
    {
        $data = $request->only(Setting::FILLABLE);
        if(isset($data['site_icon'])){
            $data['site_icon'] =  uploadFile($request,'site-icons','site_icon');
        }else{
            $data['site_icon'] =  'icon_site.png';
        }
        if(isset($data['tags'])){
            $data['tags'] = convertTagsObjectToString($data['tags']);
        }

        try {
            DB::beginTransaction();

            $item = Setting::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return $this->returnBackWithSaveDoneFailed();
        }
    }


}
