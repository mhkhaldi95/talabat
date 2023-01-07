<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Resources\Products\ProductResource;
use App\Models\Addon;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAddon;
use App\Models\ProductPhoto;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products-update', ['only' => ['create', 'update']]);
        $this->middleware('permission:products-read', ['only' => ['index']]);
        $this->middleware('permission:products-delete', ['only' => ['delete','deleteSelected']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $items = Product::query()->orderBy(getColAndDirForOrderBy(Product::class)['col'],getColAndDirForOrderBy(Product::class)['dir'])->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, ProductResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.products'),'active' => false],
        ];
        return view('dashboard.products.index', [
            'page_title' =>__('lang.products'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create_product');
        if (isset($id)) {
            $page_title = __('lang.edit_product');
            try {
                $item = Product::query()->filter()->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('products.index') , 'title' =>__('lang.products'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit_product'):__('lang.add_product'),'active' => false],
        ];
        return view('dashboard.products.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item?(new ProductResource($item))->toShow():null ,
            'categories' => Category::query()->filter()->get(),
            'addons' => Addon::query()->filter()->get(),
        ]);
    }
    public function store(ProductRequest $request, $id = null)
    {
        $data = $request->only(Product::FILLABLE);
        $photos = $request->get('photos',[]);
        $addons = $request->get('product_options')?
            array_column($request->get('product_options'),'addon_id'):[];
        if($data['discount_option'] == Enum::DISCOUNT_PERCENTAGE){
            $data['discounted_price'] = $request->get('discounted_percentage');
        }else{
            $data['discounted_price'] = $data['discounted_price']??0;
        }

        if(isset($data['tags'])){
            $data['tags'] = convertTagsObjectToString($data['tags']);
        }
        DB::beginTransaction();
        try {

            if(isset($data['master_photo'])){
                $data['master_photo'] =  uploadFile($request,'product-photos','master_photo');
            }

            $item = Product::query()->updateOrCreate([
                'id' => $id,
            ], $data);


            if(isset($photos)){
                foreach ($photos as $photo){
                    ProductPhoto::create([
                        'product_id' => $item->id,
                        'name' => $photo,
                    ]);
                }
            }
            if($addons){
                if(!is_null($id)){
                    ProductAddon::where('product_id',$id)->whereIn('addon_id',$item->addons->pluck('id')->toArray())->delete();
                }
                $addons = array_unique($addons);
                foreach ($addons as $addon){
                    ProductAddon::create([
                        'product_id' => $item->id,
                        'addon_id' => $addon
                    ]);
                }

            }


            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }

    public function delete($id){
        try {
            $item = Product::query()->filter()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $item->delete();
        if($item){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->get('ids');
        try {
            $result = Product::query()->whereIn('id', $ids)->delete();
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }


        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }

    public function uploadPhotos(Request $request){
        return uploadFile($request,'product-photos','file');
    }
    public function removePhoto(Request $request){

        $request->validate([
            'photo_id' => ['required', 'exists:product_photos,id' ,'numeric'],
            'product_id' => ['required', 'exists:products,id' ,'numeric']
              ]);
        $photo = ProductPhoto::where('product_id',$request->product_id)->where('id',$request->photo_id)->first();
        if($photo){
            unlink(base_path().'/storage/app/public/product-photos/'. $photo->name);
            $photo->delete();
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
