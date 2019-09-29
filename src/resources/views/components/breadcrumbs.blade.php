@if (count($breadcrumbs))

	<div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
        	<ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && $loop->first)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}"><i class="fa fa-dashboard" aria-hidden="true"></i> {{ $breadcrumb->title }}</a></li>
                    @elseif ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                    @endif

                @endforeach
            </ol>
        </div>
	</div>
@endif