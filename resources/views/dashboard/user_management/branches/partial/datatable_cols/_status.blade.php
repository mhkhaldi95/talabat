<div class="badge badge-light-{{$item->status == \App\Constants\Enum::BRANCH_OPEN ?'success':($item->status == \App\Constants\Enum::INACTIVE?'danger':'')}}">
{{$item->status == \App\Constants\Enum::BRANCH_OPEN ? __('lang.open'):($item->status == \App\Constants\Enum::INACTIVE?__('lang.closed'):'--')}}
</div>
