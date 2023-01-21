<?php

namespace App\Http\Controllers\Branch\Products;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\Branch\ProductResource;
use App\Models\Addon;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBranch;
use App\Models\ProductPhoto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products-update', ['only' => ['create', 'update']]);
        $this->middleware('permission:products-read', ['only' => ['index']]);
        $this->middleware('permission:products-delete', ['only' => ['delete', 'deleteSelected']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Product::query()->orderBy(getColAndDirForOrderBy(Product::class)['col'], getColAndDirForOrderBy(Product::class)['dir'])->filter()->paginate(\request()->get('length', 10), '*', '*', getPageNumber());
            return datatable_response($items, null, ProductResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('branch.dashboard'), 'title' => __('lang.home'), 'active' => true],
            ['page' => '#', 'title' => __('lang.products'), 'active' => false],
        ];
        return view('branch.products.index', [
            'page_title' => __('lang.products'),
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
            ['page' => route('branch.dashboard'), 'title' => __('lang.home'), 'active' => true],
            ['page' => route('branch.products.index'), 'title' => __('lang.products'), 'active' => true],
            ['page' => '#', 'title' => isset($id) ? __('lang.edit_product') : __('lang.add_product'), 'active' => false],
        ];
        return view('branch.products.create', [
            'page_title' => $page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item ? (new ProductResource($item))->toShow() : null,
            'categories' => Category::query()->filter()->get(),
            'addons' => Addon::query()->filter()->get(),
            'branches' => Branch::with(['user'])->get(),
        ]);
    }


    public function changeStatus(Request $request)
    {

        $request->validate([
            'status' => ['required'],
            'product_id' => ['required', 'exists:products,id', 'numeric']
        ]);
        $data = ['status' => $request->status == Enum::PUBLISHED?Enum::INACTIVE:Enum::PUBLISHED];
        ProductBranch::query()->updateOrCreate([
            'product_id' => $request->product_id,
            'branch_id' => auth()->user()->branch->id,
        ], $data);

        return response()->json([
            'status' => true,
        ]);
    }
}
