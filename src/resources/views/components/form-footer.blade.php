<div class="form-group row {{ $is_center ?? false ?'text-center':'' }}">
    <div class="col-md-{{ $col ?? '9' }} offset-md-{{ $offset ?? '3' }}">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
            {{ $submit ?? "Submit" }}
        </button>
        @if ($reset ?? true)
            <button type="reset" class="btn btn-warning">
                <i class="fa fa-eraser" aria-hidden="true"></i>
                {{ $reset ?? "Reset" }}
            </button>
        @endif
    </div>
</div>