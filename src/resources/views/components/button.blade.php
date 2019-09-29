@isset($url)
	<a href="{{ $url }}" class="btn btn-{{ $type ?? "primary" }} btn-{{ $size ?? "md" }}">
		{{ $slot }}
	</a>
@else
	<button class="btn btn-{{ $type ?? "primary" }} btn-{{ $size ?? "md" }}">
		{{ $slot }}
	</button>
@endisset
