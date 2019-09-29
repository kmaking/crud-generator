<div class="dropdown btn-group">
    <a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
        <i class="fa fa-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @if (!in_array('create', $excepts ?? []))
            <a class="dropdown-item" href="{{ route($prefix . '.create') }}">
                <i class="fa fa-plus"></i> New
            </a>
        @endif
        @if (!in_array('show', $excepts ?? []))
            <a class="dropdown-item" href="{{ route($prefix . '.show', $model) }}">
                <i class="fa fa-eye"></i> View
            </a>
        @endif
        @if (!in_array('edit', $excepts ?? []))
            <a class="dropdown-item" href="{{ route($prefix . '.edit', $model) }}">
                <i class="fa fa-pencil"></i> Edit
            </a>
        @endif
        @if (!in_array('destroy', $excepts ?? []))
            <a class="dropdown-item" href="{{ route($prefix . '.destroy', $model) }}" id="delete">
                <i class="fa fa-trash"></i> Delete
            </a>
        @endif
        {!! $more ?? '' !!}
    </div>
</div>