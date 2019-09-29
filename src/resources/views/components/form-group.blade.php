<div class="form-group row{{ isset($is_error) ? ' has-danger' : '' }} {{ $class ?? "" }}">
    <label class="col-md-3 label-control text-right {{ $label_class ?? "" }}"><strong>{{ $label ?? "" }}</strong></label>
    <div class="col-md-9">
        {{ $slot }}
    </div>
</div>