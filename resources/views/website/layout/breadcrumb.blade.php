@if(isset($page_breadcrumbs))
<div class="definition text-white">
    <div class="container aa">
        <div>
            <p class="center">حدد الفرع المراد استلام الطلب منه</p>
        </div>
        <div class="box-def d-flex align-items-center justify-content-between">
            @foreach($page_breadcrumbs as $index => $page)
                @if($page['active'])
                    <p><a href="{{$page['page']}}">{{$page['title']}}</a> @if($index > 0)  < @endif </p>
                    @break

                @else
                    <p>{{$page['title']}}  @if($index > 0)  < @endif</p>
                @endif
            @endforeach
        </div>
    </div>
    <div class="bg-def">
    </div>
</div>
@endif
