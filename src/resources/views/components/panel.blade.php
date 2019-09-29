<div class="col-md-{{ $column ?? "12" }} offset-{{ $offset ?? "0" }}">
    
    @if(session('message'))
        @alert(['type' => session('type')])
            {{ session('message') }}
        @endalert
    @endif

    <div class="card">
        <div class="card-body">
            <div class="float-right">
            @isset ($back)
                <a href="{{ $back }}" class="btn btn-outline-primary btn-sm mr-2">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back
                </a>
            @endisset
            @isset ($new)
                <a href="{{ $new }}" class="btn btn-outline-primary btn-sm mr-2">
                    <i class="fa fa-plus"></i> {{ $new_title ?? 'New' }}
                </a>
            @endisset
            @isset ($action)
                @include('component::action', $action) 
            @endisset
            </div>
            <h5 class="card-title">
                {{ $title }}
            </h5>
            <div class="card-body">
                {{ $slot }}
            </div>
            @isset ($footer)
                <p class="card-text">
                    <small class="text-muted">{{ $footer }}</small>
                </p>
            @endisset
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                {{ $title }}
                <small class="block">{{ $description ?? "" }}</small>
            </h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    @isset ($new)
                        @if (is_array($new))
                            <li>
                                <a href="{{ $new['route'] }}" class="btn btn-outline-primary mr-2"
                                    @foreach ($new['attribute'] ?? [] as $K => $V)
                                        @if(is_bool($V) && $V===true) {{$K}}
                                        @elseif(!is_bool($V)) {{$K}}="{{$V}}"
                                        @endif
                                    @endforeach
                                >
                                    <i class="ft-plus"></i> {{ $new_title ?? 'New' }}
                                </a>
                            </li>
                        @else
                        <a href="{{ $new }}" class="btn btn-outline-primary mr-2">
                            <i class="ft-plus"></i> {{ $new_title ?? 'New' }}
                        </a>
                        @endif
                    @endisset
                    @isset ($action)
                        <li>
                            @include('component::action', $action) 
                        </li>
                    @endisset
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
        @isset ($footer)
            <div class="card-footer">
                {{ $footer }}
            </div>
        @endisset
    </div> --}}
</div>