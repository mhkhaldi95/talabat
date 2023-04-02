<div class="badge badge-light-{{$item->status == \App\Constants\Enum::PAID ?'success':($item->status == \App\Constants\Enum::INITIATED?'info':'')}}">
{{$item->status == \App\Constants\Enum::PAID ? __('lang.paid'):($item->status == \App\Constants\Enum::INITIATED?__('lang.initiated'):'--')}}
</div>
