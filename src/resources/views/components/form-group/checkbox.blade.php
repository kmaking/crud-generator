<div class="form-group row{{ $is_error ? ' has-danger' : '' }}">
    <label for="name" class="col-md-3 label-control text-right">
        {{ $label }}
        @if($star ?? false == true)<span class="text-danger">*</span>@endif
    </label>
    <div class="col-md-9 skin skin-{{ $look ?? "square" }} controls">

        @foreach($choice as $check_value => $check_label)

            <fieldset @isset($inline) class="d-inline-block pr-1 pb-1" @endisset>
                <input type="checkbox" id="{{ $check_value }}" 
                    value="{{ $check_value }}" 
                    name="{{ $name }}[]" 
                    @if(in_array($check_value, $value ?? [])) checked @endif
                    {!! set_attribute($attribute ?? []) !!}
                >
                <label for="{{ $check_value }}">{{ $check_label }}</label>
            </fieldset>

        @endforeach

        @if ($is_error)
            <small class="form-control-feedback">
                {{ $error }}
            </small>
        @endif

        @isset($feedback)
            <small class="form-text text-muted">{{ $feedback }}</small>
        @endisset
    </div>
</div>