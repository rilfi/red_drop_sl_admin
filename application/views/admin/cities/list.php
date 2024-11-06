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
                    <li class="breadcrumb-item active">Cities</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manage Cities</h3>
                <div class="card-tools pull-right">
                    <div class="input-group input-group-sm">

                        <div class="input-group-btn">
                            <a href="#" data-what="add_new_city" data-modal="ajaxModal"
                               data-title="Add City"
                               class="btn btn-sm btn-primary"><i
                                        class="fa fa-plus"></i>Add City</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="cities_table" class="table table-sm table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>State</th>
                        <th>Country</th>
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
                                            placeholder="State"></th>
                        <th class=""><input type="text" class="text_filter form-control"
                                            placeholder="Country"></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="5" class="">
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

        var table = $('#cities_table').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '<?php echo base_url("admin/cities/get_cities"); ?>',
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
                {"data": "state_name"},
                {"data": "country_name"},
                // {"data": "status", "searchable": true, "render": pstatus},
                {"data": "Actions", "searchable": false, "orderable": false}
            ]

        });

        // $('#cities_table tfoot th:not(:last-child, :nth-last-child(2), :nth-last-child(3))').each(function () {
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