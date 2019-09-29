@foreach (is_array($name)? $name: array_wrap($name) as $element)
    @switch($element)
	    @case('sweetalert')
			{!! script('admin/vendors/js/extensions/sweetalert.min.js') !!}
	        @break
		@case('switch')
			{!! script('admin/vendors/js/forms/toggle/switchery.min.js') !!}
			<script type="text/javascript">
				var i = 0;
				if (Array.prototype.forEach) {

					var elems = $('[switchery]');
					$.each( elems, function( key, value ) {
						var $size="", $color="",$sizeClass="", $colorCode="";
						$size = $(this).data('size');
						var $sizes ={
							'lg' : "large",
							'sm' : "small",
							'xs' : "xsmall"
						};
						if($(this).data('size')!== undefined){
							$sizeClass = "switchery switchery-"+$sizes[$size];
						}
						else{
							$sizeClass = "switchery";
						}

						$color = $(this).data('color');
						var $colors ={
							'primary' : "#967ADC",
							'success' : "#37BC9B",
							'danger' : "#DA4453",
							'warning' : "#F6BB42",
							'info' : "#3BAFDA"
						};
						if($color !== undefined){
							$colorCode = $colors[$color];
						}
						else{
							$colorCode = "#37BC9B";
						}

						var switchery = new Switchery($(this)[0], { className: $sizeClass, color: $colorCode });
					});
				} else {
					var elems1 = document.querySelectorAll('[switchery]');

					for (i = 0; i < elems1.length; i++) {
						var $size = elems1[i].data('size');
						var $color = elems1[i].data('color');
						var switchery = new Switchery(elems1[i], { color: '#37BC9B' });
					}
				}
			</script>
	        @break
		@case('tags')
			{!! script('admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') !!}
	        @break
		@case('touchspin')
			{!! script('admin/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') !!}
	        @break
		@case('repeater')
			{!! script('admin/vendors/js/forms/repeater/jquery.repeater.min.js') !!}
	        @break
		@case('select2')
			{!! script('admin/vendors/js/forms/select/select2.full.min.js') !!}
			<script type="text/javascript">
				$('[select2]').select2({
					placeholder: 'Select an option',
					allowClear: true
				});
			</script>
	        @break
		@case('picker')
			{!! script('admin/vendors/js/pickers/pickadate/picker.js') !!}
			{!! script('admin/vendors/js/pickers/pickadate/picker.date.js') !!}
			{!! script('admin/vendors/js/pickers/pickadate/picker.time.js') !!}
			{!! script('admin/vendors/js/pickers/pickadate/legacy.js') !!}
			{!! script('admin/vendors/js/pickers/daterange/daterangepicker.js') !!}

			{{-- {!! script('admin/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js') !!} --}}

			<script type="text/javascript">
				var picker_date = [];
				$('input[picker="date"]').each(function(index, el) {
					 let $input_date = $(this).pickadate({
						format: 'dd mmmm, yyyy',
						formatSubmit: 'yyyy-mm-dd',
						hiddenSuffix: '',
						labelMonthNext: 'Go to the next month',
						labelMonthPrev: 'Go to the previous month',
						labelMonthSelect: 'Pick a month from the dropdown',
						labelYearSelect: 'Pick a year from the dropdown',
						selectMonths: true,
						selectYears: true
					})
					picker_date.push($input_date.pickadate('picker'))
				});

				$('input[picker="time"]').pickatime({
					format: 'h:i A',
					formatSubmit: 'H:i',
					hiddenSuffix: ''
				})
			</script>
			@break
		@case('validation')
			<script type="text/javascript">
				$('[decimal="with"]').on("keypress keyup blur",function (event) {
					$(this).val($(this).val().replace(/[^0-9\.]/g,''));
					if(parseFloat($(this).val()) < 0) {
						$(this).val(0).trigger('keyup')
					}
					if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
						event.preventDefault();
					}

				});

				$('[decimal="without"]').on("keypress keyup blur",function (event) {
					$(this).val($(this).val().replace(/[^\d].+/, ""));
					if(parseInt($(this).val()) < 0) {
						$(this).val(0).trigger('keyup')
					}
					if ((event.which < 48 || event.which > 57)) {
						event.preventDefault();
					}
				});
			</script>
			@break

		@case('photo-swipe')
			{!! script('admin/vendors/js/gallery/masonry/masonry.pkgd.min.js') !!}
		    {!! script('admin/vendors/js/gallery/photo-swipe/photoswipe.min.js') !!}
		    {!! script('admin/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') !!}
		    {!! script('admin/js/scripts/gallery/photo-swipe/photoswipe-script.js') !!}
			@break
	@endswitch
@endforeach