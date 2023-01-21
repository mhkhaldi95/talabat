@if(isset($product_branch_status))
    <div
        class="badge badge-light-{{$product_branch_status == \App\Constants\Enum::PUBLISHED ?'success':($product_branch_status == \App\Constants\Enum::INACTIVE?'danger':'')}}">
        {{$product_branch_status == \App\Constants\Enum::PUBLISHED ? __('lang.Published'):($product_branch_status == \App\Constants\Enum::INACTIVE?__('lang.Inactive'):'--')}}
    </div>
@else
    <div
        class="badge badge-light-{{$item->status == \App\Constants\Enum::PUBLISHED ?'success':($item->status == \App\Constants\Enum::INACTIVE?'danger':'')}}">
        {{$item->status == \App\Constants\Enum::PUBLISHED ? __('lang.Published'):($item->status == \App\Constants\Enum::INACTIVE?__('lang.Inactive'):'--')}}
    </div>
@endif
