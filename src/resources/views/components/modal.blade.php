<div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content bg-{{ $type ?? "success" }} text-white">
			<div class="modal-body text-center">
				<h3 class="text-white mb-15">
					<i class="fa fa-exclamation-triangle"></i> 
					{{ $title ?? "Success" }}
				</h3>
				<p>{{ $slot }}</p>
				<button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>