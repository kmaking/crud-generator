<div class="form-group{{ $is_error ? ' has-danger' : '' }}">
    <label for="{{ $name }}" class="col-form-label text-right">
        {{ $label  }}
        @if($star ?? false == true)<span class="text-danger">*</span>@endif
    </label>
    <textarea id="{{ $name }}" class="form-control{{ $is_error ? ' form-control-danger' : '' }}" 
        name="{{ $name }}" editor 
        placeholder="{{ $placeholder ?? "" }}"
        {!! set_attribute($attribute ?? []) !!}
    >{{ $value ?? "" }}</textarea> 
        
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