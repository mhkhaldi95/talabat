
@if(isset($page_breadcrumbs))
<section class="branch-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb " >
            <p data-i18n="custimizeBranchHeader">{{__('custimizeBranchHeader')}}</p>
            <ol class="breadcrumb" id="breadcrumbList">
                @foreach($page_breadcrumbs as $index => $page)
                    @if($page['active'])
                        <li class="breadcrumb-item active" aria-current="page" data-i18n="breadCrumbBranch">{{$page['title']}}</li>

                        @break

                    @else
                        <li class="breadcrumb-item mx-2"><a href="{{$page['page']}}" data-i18n="breadCrumbHome">{{$page['title']}}</a></li>

                    @endif
                @endforeach
            </ol>
        </nav>

    </div>
    <div class="breadcrumb-overlay"></div>
</section>
@endif
