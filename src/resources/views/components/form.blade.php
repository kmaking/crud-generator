<form class="form form-horizontal" action="{{ $route }}" method="post" id="{{ $id ?? "form-data" }}" enctype="multipart/form-data" novalidate>
@csrf
@isset($method) @method($method) @endisset
{{ $slot }}
</form>