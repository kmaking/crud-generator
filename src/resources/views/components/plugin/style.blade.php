@foreach (is_array($name)? $name: array_wrap($name) as $element)
    @switch($element)
        @case('sweetalert')
    		{!! style('admin/vendors/css/extensions/sweetalert.css') !!}
            @break
        @case('switch')
    		{!! style('admin/vendors/css/forms/toggle/switchery.min.css') !!}
            @break
        @case('tags')
    		{!! style('admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') !!}
            @break
        @case('touchspin')
            {!! style('admin/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') !!}
            @break
        @case('select2')
            {!! style('admin/vendors/css/forms/selects/select2.min.css') !!}
            @break
        @case('picker')
            {!! style('admin/vendors/css/pickers/daterange/daterangepicker.css') !!}
            {!! style('admin/vendors/css/pickers/pickadate/pickadate.css') !!}
            {{-- {!! style('admin/vendors/css/pickers/daterange/daterangepicker.css') !!}
            {!! style('admin/vendors/css/pickers/datetime/bootstrap-datetimepicker.css') !!}
            {!! style('admin/vendors/css/pickers/pickadate/pickadate.css') !!} --}}
            @break
        @case('photo-swipe')
            {!! style('admin/vendors/js/gallery/photo-swipe/photoswipe.css') !!}
            {!! style('admin/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') !!}
            @break
    @endswitch
@endforeach
