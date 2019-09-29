@php
    $file_id = str_random();
@endphp
<div class="form-group row{{ $is_error ? ' has-danger' : '' }}">
    <label for="{{ $name }}" class="col-md-3 label-control text-right">
        {{ $label }}
        @if($star ?? false == true)<span class="text-danger">*</span>@endif
    </label>
    <div class="col-md-9">
        <div class="custom-file">
            <input id="{{ $name }}" type="file" 
                class="custom-file-input{{ $is_error ? ' form-control-danger' : '' }}" 
                name="{{ $name }}" 
                value="{{ $value ?? "" }}"
                {!! set_attribute($attribute ?? []) !!}
                file-upload-field="{{ $file_id }}"
            >
            <label class="custom-file-label" file-upload-label="{{ $file_id }}">Choose file</label>

            @if ($is_error)
                <small class="form-control-feedback">
                    {{ $error }} 
                </small>
            @endif

            @isset($feedback)
                <small class="form-text text-muted" file-upload-preview="{{ $file_id }}">{{ $feedback }}</small>
            @endisset
        </div>
    </div>
</div>