@php
  $id = str_random(10);
@endphp

<script type="text/javascript">
  $(document).ready(function() {
    $('form#{{ $slot }}').on('submit', function(e) {
      e.preventDefault();
      $('#submit_{{ $id }}_modal').modal('show');
    });

    $('#modal-{{ $id }}-submit-btn').on('click', function() {
      $('form#{{ $slot }}').unbind().submit();
    });
  });
</script>

<div class="modal fade" id="submit_{{ $id }}_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center font-18">
        <h4 class="padding-top-30 mb-30 weight-500">{{ $message ?? "Are you sure you want to continue?" }}</h4>
        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
          <div class="col-6">
            <button type="button" class="btn btn-outline-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            NO
          </div>
          <div class="col-6">
            <button type="button" class="btn btn-outline-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" id="modal-{{ $id }}-submit-btn"><i class="fa fa-check"></i></button>
            YES
          </div>
        </div>
      </div>
    </div>
  </div>
</div>