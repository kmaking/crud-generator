<div class="form-group row{{ $is_error ? ' has-danger' : '' }}">
    <label class="col-md-3 col-form-label text-right">{{ $label }}</label>
    <div class="col-md-9 skin skin-{{ $look ?? "square" }} controls">

        @foreach($choice as $check_value => $check_label)

            <fieldset @isset($inline) class="d-inline-block pr-1" @endisset>
                <input type="radio" id="{{ $name }}-{{ $check_value }}" 
                    name="{{ $name }}" 
                    value="{{ $check_value }}" 
                    @if($check_value == $value ?? "") checked @endif
                    {!! set_attribute($attribute ?? []) !!}
                >
                <label for="{{ $name }}-{{ $check_value }}">{{ $check_label }}</label>
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