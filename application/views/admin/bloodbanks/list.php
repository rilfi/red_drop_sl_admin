<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard <small><?php if (isset($title)) {
                            echo $title;
                        } ?></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Blood Banks</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manage Blood Banks</h3>
                <div class="card-tools pull-right">
                    <div class="input-group input-group-sm">

                      <div class="input-group-btn">
                        <a href="#" data-what="import_bloodbanks_excel" data-form-action="<?php echo base_url('admin/bloodbanks/excel_import'); ?>" data-modal="ajaxModal" data-title="Import Blood Banks"
                           class="btn btn-sm btn-info" data-sample-file="<?php echo base_url('uploads/samples/bloodbanks_import_sample.xlsx'); ?>"><i
                              class="fa fa-file-import"></i> Import From Excel</a>

                        <a href="#" data-what="add_new_bloodbank" data-modal="ajaxModal" data-title="Add Blood Bank"
                           class="btn btn-sm btn-primary"><i
                              class="fa fa-plus"></i>Add Blood Bank</a>
                      </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="bloodbanks_table" class="table table-sm table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Contact</th>
                        <th>Lat/Lon</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot class="foot-p0">
                    <tr>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="ID"></th>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="Name"></th>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="City"></th>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="State"></th>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="Country"></th>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="Contact"></th>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="Lat/Lon"></th>
                        <th class="">
                            <select class="select2bs4 form-control select_filter">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="0">Non-Active</option>
                            </select>
                        </th>
                        <th class=""></th>
                    </tr>
                    <tr>
                        <th colspan="9" class="">
                            <input type="text" class="form-control form-control-sm b0"
                                   id="search_table"
                                   placeholder="Type & hit enter to search the table"
                                   style="width:100%;">
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            </div>
        </div>
    </div>
</section>

<script>

    function pstatus(x) {
        if (x == 1) {
            return 'Active';
        } else if (x == 0) {
            return "Disabled"
        } else {
            return x;
        }
    }

    $(function () {

        var table = $('#bloodbanks_table').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '<?php echo base_url("admin/bloodbanks/get_bloodbanks"); ?>',
                type: 'POST',
                "data": function (d) {
                    d.something = "";
                }
            },
            "buttons": [
                {extend: 'copyHtml5', 'footer': false, exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
                {extend: 'excelHtml5', 'footer': false, exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
                {extend: 'csvHtml5', 'footer': false, exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
                {
                    extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4', 'footer': false,
                    exportOptions: {columns: [0, 1, 2, 3, 4, 5]}
                },
                {extend: 'colvis', text: 'Columns'},
            ],
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "city_name"},
                {"data": "state_name"},
                {"data": "country_name"},
                {"data": "contact"},
                {"data": "latlon"},
                {"data": "status", "searchable": true, "render": pstatus},
                {"data": "Actions", "searchable": false, "orderable": false}
            ]

        });

        // $('#bloodbanks_table tfoot th:not(:last-child, :nth-last-child(2), :nth-last-child(3))').each(function () {
        //     var title = $(this).text();
        //     $(this).html( '<input type="text" class="text_filter" placeholder="'+title+'" />' );
        // });

        $('#search_table').on('keyup change', function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (((code == 13 && table.search() !== this.value) || (table.search() !== '' && this.value === ''))) {
                table.search(this.value).draw();
            }
        });

        table.columns().every(function () {
            var self = this;
            $('input', this.footer()).on('keyup change', function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (((code == 13 && self.search() !== this.value) || (self.search() !== '' && this.value === ''))) {
                    self.search(this.value).draw();
                }
            });
            $('select', this.footer()).on('change', function (e) {
                self.search(this.value).draw();
            });
        });

    })
</script>