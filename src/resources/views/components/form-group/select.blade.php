<div class="form-group row{{ $is_error ? ' has-danger' : '' }}">
    <label for="{{ $name }}" class="col-md-3 label-control text-right">
        {{ $label }}
        @if($star ?? false == true)<span class="text-danger">*</span>@endif
    </label>
    <div class="col-md-9 controls">
        <select name="{{ $name }}" id="{{ $name }}" 
            select2
            class="form-control{{ $is_error ? ' form-control-danger' : '' }}"
            {!! set_attribute($attribute ?? []) !!}
        >
            @foreach ($data as $key => $label)
                <option value="{{ $key }}"
                    @if($value == $key) selected @endif
                    @if(in_array($key, $disabled ?? [])) disabled @endif
                >{{ $label }}</option>
            @endforeach
        </select>

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