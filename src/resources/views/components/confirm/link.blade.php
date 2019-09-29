@php
  $id = str_random(10);
@endphp

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', 'a#{{ $slot }}', function(e) {
      e.preventDefault();
      var href = $(this).attr('href');
      $('#form-{{ $id }}-delete').attr('action', href);
      $('#delete_{{ $id }}_modal').modal('show');
    });

    $(document).on('hidden.bs.modal', function() {
      $('#form-{{ $id }}-delete').attr('action', "#");
    });

    $('#modal-{{ $id }}-delete-btn').on('click', function() {
      $('#form-{{ $id }}-delete').unbind().submit();
    });
  });
</script>

@if(isset($action) && $action=="get")
<form method="get" id="form-{{ $id }}-delete">
</form>
@else
<form method="post" id="form-{{ $id }}-delete">
  @csrf
  @method($method ?? "delete")
</form>
@endif

<div class="modal fade" id="delete_{{ $id }}_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content pt-2">
      {{-- <div class="modal-header bg-warning text-white">
        <h4 class="modal-title">Confirmation</h4>
      </div> --}}
      <div class="modal-body text-center font-18">
        <h4 class="padding-top-30 mb-30 weight-500">{{ $message ?? "Are you sure you want to continue?" }}</h4>
        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
          <div class="col-6">
            <button type="button" class="btn btn-outline-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            NO
          </div>
          <div class="col-6">
            <button type="button" class="btn btn-outline-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" id="modal-{{ $id }}-delete-btn"><i class="fa fa-check"></i></button>
            YES
          </div>
        </div>
      </div>
    </div>
  </div>
</div>