<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.flash.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>

<!-- Custom -->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=<?php
echo $this->settings->google_maps_api_key; ?>&sensor=false&libraries=places'></script>
<script src="assets/custom/js/location.js"></script>
<script src="assets/custom/js/locationpicker.js"></script>
<script src="plugins/ckeditor/ckeditor.js"></script>
<script src="plugins/file-manager/file-manager.js"></script>

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- page script -->
<script>

	function setTooltip() {
		$("[data-tooltip=tooltip]").tooltip();
	}

	function setSelect2BS4($elem = null) {
		if ($elem != null) {
			$($elem).select2({
				theme: 'bootstrap4'
			});
		} else {
			$('.select2bs4').select2({
				theme: "bootstrap4"
			});
		}

	}

	function setSimpleSelect2($elem) {
		if ($elem != null) {
			$($elem).select2();
		} else {
			$('.select2').select2();
		}
	}

	function setSelect2() {
		setSimpleSelect2();
		setSelect2BS4();
	}

	function setLocationPicker($latitude = 31.3333, $longitude = 71.3333) {
		if (!$latitude) {
			$latitude = parseFloat($("#us2-lat").val());
		}
		if (!$longitude) {
			$longitude = parseFloat($("#us2-lon").val());
		}

		$('#us2').locationpicker({
			location:
				{
					latitude: $latitude,
					longitude: $longitude,
				},
			radius: 300,
			inputBinding:
				{
					latitudeInput: $('#us2-lat'),
					longitudeInput: $('#us2-lon'),
					radiusInput: $('#us2-radius'),
					locationNameInput: $('#us2-address')
				},
			enableAutocomplete: true
		});
	}


	function loadView($parent, $with_modal_footer = false) {
		let $url = "";
		if ($parent.data("ajaxUrl") != undefined) {
			$url = $parent.date("ajaxUrl");
		} else {
			$url = "<?php echo base_url('admin/common/get_view'); ?>";
		}

		$.ajax({
			url: $url,
			type: "post",
			data: {
				title: $parent.data("title"),
				sample_file: $parent.data("sample-file"),
				view: $parent.data("what"),
				id: $parent.data("id"),
				form_action: $parent.data("form-action"),
			},
			success: function ($result) {

				let $modalSize = $parent.data("modal-size");

				if ($modalSize) {
					if ($modalSize === "extra-large") {
						$("#ajaxModal .modal-dialog").removeClass("modal-lg");
						$("#ajaxModal .modal-dialog").addClass("modal-xl");
					}
				}


				setTimeout(function () {
					// $("#ajaxModal .modal-body").hide().html($result).slideDown("slow");
					$("#ajaxModal .modal-body").hide().html($result).fadeIn();

					setSelect2BS4($(".countries"));
					setSelect2BS4();

					setLocationPicker(null, null);
				}, 500);

				if (!$with_modal_footer)
					$("#ajaxModal .modal-footer").remove();

				$("#ajaxModal .modal-title").html($parent.data('title'));


			},
			error: function (e) {
				console.error(JSON.stringify(e));
			}
		})
	}

	function initCkEditor($elem = null) {
		<!-- Ckeditor -->

		var ckEditor = document.getElementById('ckEditor');
		var ckEditor2 = document.getElementById('ckEditor2');

		// if($elem){
		//     ckEditor = $elem;
		// }

		if (ckEditor != undefined && ckEditor != null) {
			CKEDITOR.replace('ckEditor', {
				language: 'en',
				filebrowserBrowseUrl: 'path',
				removeButtons: 'Save',
			});
		}

		CKEDITOR.on('dialogDefinition', function (ev) {
				var editor = ev.editor;
				var dialogDefinition = ev.data.definition;

				// This function will be called when the user will pick a file in file manager
				var cleanUpFuncRef = CKEDITOR.tools.addFunction(function (a) {
					$('#ck_file_manager').modal('hide');
					CKEDITOR.tools.callFunction(1, a, "");
				});
				var tabCount = dialogDefinition.contents.length;
				for (var i = 0; i < tabCount; i++) {
					var browseButton = dialogDefinition.contents[i].get('browse');
					if (browseButton !== null) {
						browseButton.onClick = function (dialog, i) {
							editor._.filebrowserSe = this;
							var iframe = $('#ck_file_manager').find('iframe').attr({
								src: editor.config.filebrowserBrowseUrl + '&CKEditor=body&CKEditorFuncNum=' + cleanUpFuncRef + '&langCode=en'
							});
							$('#ck_file_manager').appendTo('body').modal('show');
						}
					}
				}

			}
		);
	}

	function initCkEditor2($elem = null) {
		<!-- Ckeditor -->

		var ckEditor = document.getElementById('ckEditor2');

		if (ckEditor != undefined && ckEditor != null) {
			CKEDITOR.replace('ckEditor2', {
				language: 'en',
				filebrowserBrowseUrl: 'path',
				removeButtons: 'Save',
			});
		}

		CKEDITOR.on('dialogDefinition', function (ev) {
				var editor = ev.editor;
				var dialogDefinition = ev.data.definition;

				// This function will be called when the user will pick a file in file manager
				var cleanUpFuncRef = CKEDITOR.tools.addFunction(function (a) {
					$('#ck_file_manager').modal('hide');
					CKEDITOR.tools.callFunction(1, a, "");
				});
				var tabCount = dialogDefinition.contents.length;
				for (var i = 0; i < tabCount; i++) {
					var browseButton = dialogDefinition.contents[i].get('browse');
					if (browseButton !== null) {
						browseButton.onClick = function (dialog, i) {
							editor._.filebrowserSe = this;
							var iframe = $('#ck_file_manager').find('iframe').attr({
								src: editor.config.filebrowserBrowseUrl + '&CKEditor=body&CKEditorFuncNum=' + cleanUpFuncRef + '&langCode=en'
							});
							$('#ck_file_manager').appendTo('body').modal('show');
						}
					}
				}

			}
		);
	}


	$(function () {


		initCkEditor();
		initCkEditor2();

		$("#datatable").DataTable();
		$('#datatable-min').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
		});


		//Initialize Select2 Elements
		setSelect2();

		setTimeout(function () {
			setTooltip();
		}, 1000);

		setLocationPicker();


		$(document).on("click", "[data-modal=ajaxModal]", function (e) {
			e.preventDefault();

			$("#ajaxModal").modal("show");
			let $parent = $(this);

			$("#ajaxModal .modal-body").html('<div class="text-center"><div class="spinner-grow text-primary"></div></div>');

			$("#ajaxModal").modal("show");

			loadView($parent, false);

		});


	});


</script>