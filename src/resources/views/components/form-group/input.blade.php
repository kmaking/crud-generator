<div class="form-group row{{ $is_error ? ' text-danger' : '' }}">
    <label for="{{ $name }}" class="col-md-3 label-control text-right">
        {{ $label }}
        @if($star ?? false == true)<span class="text-danger">*</span>@endif
    </label>
    <div class="col-md-9 controls">
        <input id="{{ $name }}" type="{{ $type ?? "text" }}" 
            name="{{ $name }}" 
            value="{{ $value ?? "" }}" 
            class="form-control{{ $is_error ? ' is-invalid' : '' }}" 
            placeholder="{{ $placeholder ?? "" }}"
            {!! set_attribute($attribute ?? []) !!}
        >

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