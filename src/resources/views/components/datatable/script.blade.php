{!! script('vendors/Datatable/JSZip-2.5.0/jszip.min.js') !!}
{!! script('vendors/Datatable/pdfmake-0.1.36/pdfmake.min.js') !!}
{!! script('vendors/Datatable/pdfmake-0.1.36/vfs_fonts.js') !!}
{!! script('vendors/Datatable/DataTables-1.10.18/js/jquery.dataTables.min.js') !!}
{!! script('vendors/Datatable/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') !!}
{!! script('vendors/Datatable/AutoFill-2.3.3/js/dataTables.autoFill.min.js') !!}
{!! script('vendors/Datatable/AutoFill-2.3.3/js/autoFill.bootstrap4.min.js') !!}
{!! script('vendors/Datatable/Buttons-1.5.6/js/dataTables.buttons.min.js') !!}
{!! script('vendors/Datatable/Buttons-1.5.6/js/buttons.bootstrap4.min.js') !!}
{!! script('vendors/Datatable/Buttons-1.5.6/js/buttons.colVis.min.js') !!}
{!! script('vendors/Datatable/Buttons-1.5.6/js/buttons.flash.min.js') !!}
{!! script('vendors/Datatable/Buttons-1.5.6/js/buttons.html5.min.js') !!}
{!! script('vendors/Datatable/Buttons-1.5.6/js/buttons.print.min.js') !!}
{!! script('vendors/Datatable/ColReorder-1.5.0/js/dataTables.colReorder.min.js') !!}
{!! script('vendors/Datatable/FixedColumns-3.2.5/js/dataTables.fixedColumns.min.js') !!}
{!! script('vendors/Datatable/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js') !!}
{!! script('vendors/Datatable/KeyTable-2.5.0/js/dataTables.keyTable.min.js') !!}
{!! script('vendors/Datatable/Responsive-2.2.2/js/dataTables.responsive.min.js') !!}
{!! script('vendors/Datatable/Responsive-2.2.2/js/responsive.bootstrap4.min.js') !!}
{!! script('vendors/Datatable/RowGroup-1.1.0/js/dataTables.rowGroup.min.js') !!}
{!! script('vendors/Datatable/RowReorder-1.2.4/js/dataTables.rowReorder.min.js') !!}
{!! script('vendors/Datatable/Scroller-2.0.0/js/dataTables.scroller.min.js') !!}
{!! script('vendors/Datatable/Select-1.3.0/js/dataTables.select.min.js') !!}

<script>
		$(document).ready(function(){
			var format_data = {
				body: function ( data, row, column, node ) {
					var html = data;
					var div = document.createElement("div");
					div.innerHTML = html;
					var text = div.textContent || div.innerText || "";
					return text;
				}
			};
			
			$('[data-table]').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}, {
					responsivePriority: 1,
					targets: -1
				}]
			});

			$('[data-table-export]').DataTable({
				initComplete: function () {
					
					this.api().columns().every( function () {
						var column = this;
						if($(column.header()).attr('filter')!=undefined) {
							var select = $('<select class="form-control"><option value=""></option></select>')
							.appendTo( $(column.footer()).css('padding', 0).empty() )
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex($(this).val());
								column.search( val ? '^'+val+'$' : '', true, false ).draw();
							});

							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							});
						}
					} );
				},

				@if ( ($serial_number ?? false) === true)
				fnCreatedRow: function (row, data, index) {
					var api = this.api();
					var page_length = $('.dataTables_length select').val()
					var current_page = api.page();
					var row_number = index + 1;

					$('td', row).eq(0).html( page_length * current_page + row_number );
				},
				@endif
				
				@isset ($server)
			    serverSide: true,
			    processing: true,
			    ajax: {
			    	url: "{{ $server['url'] }}",
			    	data: function ( d ) {}
			    },
			    columns: @json($server['columns']),
				@endisset
				
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
                colReorder: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}, {
					responsivePriority: 1,
					targets: -1
				}],
				dom: 'Bfrtpl',
				buttons: [
					{
						extend: 'copy',
						text: '<i class="fa fa-copy"></i> Copy',
						footer: true,
						exportOptions: {
							columns: "thead th:not(.no-export)",
							// format: format_data
						},
						className: 'btn-sm btn-outline-primary'
					}, {
						extend: 'print',
						text: '<i class="fa fa-print"></i> Print',
						footer: true,
						exportOptions: {
							columns: "thead th:not(.no-export)",
							// format: format_data
						},
						className: 'btn-sm btn-outline-primary'
					}, {
						extend: 'pdf',
						text: '<i class="fa fa-file-pdf-o"></i> PDF',
						footer: true,
						exportOptions: {
							columns: "thead th:not(.no-export)",
							format: format_data
						},
						className: 'btn-sm btn-outline-primary',
						customize: function (doc) {
							@if (!empty($table_columns ?? []))
								doc.content[1].table.widths = @json($table_columns)
							@endif
						}
					}, {
						extend: 'excel',
						text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
						footer: true,
						exportOptions: {
							columns: "thead th:not(.no-export)",
							// format: format_data
						},
						className: 'btn-sm btn-outline-primary rounded-right'
					}, {
						extend: 'colvis',
						text: '<span class="fa fa-columns"></span> Select Columns',
						footer: true,
						className: 'btn-sm btn-outline-primary rounded-left ml-3'
					}
				]
			});
		});
	</script>