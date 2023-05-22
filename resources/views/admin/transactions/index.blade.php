@extends('admin._layouts.index')

@push('cssScript')
@include('admin._layouts._css-table')
@endpush

@push($title)
active
@endpush

@section('content')
<div class="page-body">
        <div class="container-fluid">
                <div class="page-title">
                        <div class="row">
                                <div class="col-6">
                                        <h3>{{ Helper::head($title) }}</h3>
                                </div>
                                <div class="col-6">
                                        <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                                                <li class="breadcrumb-item">{{ Helper::head($title) }}</li>
                                                <li class="breadcrumb-item active">Data</li>
                                        </ol>
                                </div>
                        </div>
                </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
                <div class="row project-cards">
                        <div class="col-md-12 project-list">
                                <div class="card">
                                        <div class="row">
                                                <div class="col-md-6 p-0 d-flex">
                                                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="projects.html#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>All</a></li>
                                                                <!-- <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="projects.html#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Doing</a></li>
                                                                <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="projects.html#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Done</a></li> -->
                                                        </ul>
                                                </div>
                                                <div class="col-md-6 p-0">
                                                        <a class="btn btn-primary" onclick="createForm()"> <i data-feather="plus-square"> </i>Add New</a>
                                                        <a class="btn btn-success" style="margin-right:10px" id="exportBtn"> <i data-feather="file"></i>Export</a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="product-wrapper">
                                <div class="feature-products">
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="pro-filter-sec">
                                                                <div class="product-sidebar">
                                                                        <div class="filter-section">
                                                                                <div class="card">
                                                                                        <div class="card-header">
                                                                                                <h4 class="mb-0 f-w-600">Filters<span class="pull-right"><i class="fa fa-chevron-down toggle-data"></i></span></h4>
                                                                                        </div>
                                                                                        <div class="left-filter">
                                                                                                <div class="card-body filter-cards-view animate-chk">
                                                                                                        <div class="product-filter">
                                                                                                                <h6 class="f-w-600">Product</h6>
                                                                                                                <select class="form-select" name="filter_product" id="filter_product">
                                                                                                                        <option value="">All</option>
                                                                                                                        @foreach (Helper::get_data('products') as $v):
                                                                                                                        <option value="{{ $v->id }}">{{ ucwords($v->name) }}</option>
                                                                                                                        @endforeach
                                                                                                                </select>
                                                                                                                <h6 class="f-w-600 mt-4">Range</h6>
                                                                                                                <input class="datepicker-here form-control digits" name="filter_range" id="filter_range" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en">
                                                                                                                <!-- Button Apply -->
                                                                                                                <div class="col-md-12 mt-4">
                                                                                                                        <button class="btn btn-primary" id="btn-filter">Apply</button>
                                                                                                                        <button class="btn btn-danger" id="btn-reset">Reset</button>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                @include('admin._card.search')
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <!-- State saving Starts-->
                        <div class="col-sm-12">
                                <div class="card">
                                        <div class="card-header pb-0 row align-content-between">
                                                <div class="col-10">
                                                        <h3>Data</h3><span></span>
                                                </div>
                                                <div class="col-2">
                                                        <select class="form-select" name="jumlah" id="jumlah">
                                                                <option selected="selected">5</option>
                                                                <option>10</option>
                                                                <option>15</option>
                                                                <option>25</option>
                                                                <option>50</option>
                                                                <option>100</option>
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="card-body">
                                                <div class="table-responsive">
                                                        <table class="table table-bordernone">
                                                                <thead>
                                                                        <tr>
                                                                                <th>No</th>
                                                                                <th>Product</th>
                                                                                <th>Unit</th>
                                                                                <th>Volume</th>
                                                                                <th>Date</th>
                                                                                <th>Action</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody class="datatabels">
                                                                </tbody>
                                                                <tfoot>
                                                                        <tr>
                                                                                <th>No</th>
                                                                                <th>Product</th>
                                                                                <th>Unit</th>
                                                                                <th>Volume</th>
                                                                                <th>Date</th>
                                                                                <th>Action</th>
                                                                        </tr>
                                                                </tfoot>
                                                        </table>
                                                </div>
                                                <div class="d-flex justify-content-between flex-wrap mt-4">
                                                        <div class="text-center">
                                                                <div id="contentx"></div>
                                                        </div>
                                                        <div class="text-center">
                                                                <ul class="pagination twbs-pagination pagination-primary">
                                                                </ul>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <!-- State saving Ends-->
                </div>
        </div>
        <!-- Container-fluid Ends-->
</div>

@include('admin.'.$title.'._form')

@endsection

@push('jsScript')
@include('admin._layouts._js-table')

<script type="text/javascript">
        $(document).ready(function() {
                let urlx = "{{ $title }}";

                loadpage('', 5, '', '');

                var $pagination = $('.twbs-pagination');
                var defaultOpts = {
                        totalPages: 1,
                        prev: '&#8672;',
                        next: '&#8674;',
                        first: '&#8676;',
                        last: '&#8677;',
                };
                $pagination.twbsPagination(defaultOpts);

                function loaddata(page, cari, jml, product, range) {
                        $.ajax({
                                url: urlx + '/data',
                                data: {
                                        "page": page,
                                        "cari": cari,
                                        "jml": jml,
                                        "product": product,
                                        "range": range
                                },
                                type: "GET",
                                datatype: "json",
                                success: function(data) {
                                        $(".datatabels").html(data.html);
                                }
                        });
                }

                function loadpage(cari, jml, product, range) {
                        $.ajax({
                                url: urlx + '/data',
                                data: {
                                        "cari": cari,
                                        "jml": jml,
                                        "product": product,
                                        "range": range
                                },
                                type: "GET",
                                datatype: "json",
                                success: function(response) {
                                        console.log(response);
                                        if ($pagination.data("twbs-pagination")) {
                                                $pagination.twbsPagination('destroy');
                                                // $(".datatabels").html('<tr><td colspan="8">Data not found</td></tr>');
                                        }
                                        $pagination.twbsPagination($.extend({}, defaultOpts, {
                                                startPage: 1,
                                                totalPages: response.total_page,
                                                visiblePages: 4,
                                                prev: '&#8672;',
                                                next: '&#8674;',
                                                first: '&#8676;',
                                                last: '&#8677;',
                                                onPageClick: function(event, page) {
                                                        if (page == 1) {
                                                                var to = 1;
                                                        } else {
                                                                var to = page * jml - (jml - 1);
                                                        }
                                                        if (page == response.total_page) {
                                                                var end = response.total_data;
                                                        } else {
                                                                var end = page * jml;
                                                        }
                                                        $('#contentx').text('Showing ' + to + ' to ' + end + ' of ' + response.total_data + ' entries');
                                                        loaddata(page, cari, jml, product, range);
                                                }

                                        }));
                                }
                        });
                }

                $("#pencarian, #jumlah, #filter_product, #filter_range").on('keyup change', function(event) {
                        let cari = $('#pencarian').val();
                        let jml = $('#jumlah').val();
                        let product = $('#filter_product').val();
                        let range = $('#filter_range').val();
                        loadpage(cari, jml, product, range);
                });

                $('#btn-filter').click(function() {
                        let cari = $('#pencarian').val();
                        let jml = $('#jumlah').val();
                        let product = $('#filter_product').val();
                        let range = $('#filter_range').val();
                        loadpage(cari, jml, product, range);
                });

                $('#btn-reset').click(function() {
                        $('#pencarian').val('');
                        $('#jumlah').val('5');
                        $('#filter_product').val('');
                        $('#filter_range').val('');
                        loadpage('', 5, '', '');
                });

                // Notify
                var content = {
                        message: 'Memproses data...'
                };
                var setting = {
                        type: 'primary',
                        allow_dismiss: true,
                        newest_on_top: false,
                        mouse_over: false,
                        showProgressbar: true,
                        spacing: 10,
                        timer: 1000,
                        placement: {
                                from: 'top',
                                align: 'right'
                        },
                        offset: {
                                x: 30,
                                y: 30
                        },
                        delay: 1000,
                        z_index: 10000,
                        animate: {
                                enter: 'animated bounceIn',
                                exit: 'animated bounceOut'
                        }
                }
                var notify = $.notify(content, setting);

                // Notify Success
                function notifySuccess() {
                        notify = $.notify(content, setting);
                        setTimeout(function() {
                                notify.update('message', '<strong>Saving</strong> Data.');
                                notify.update('type', 'primary');
                                notify.update('progress', 50);
                        }, 1000);
                        setTimeout(function() {
                                notify.update('message', '<strong>Checking</strong> for errors.');
                                notify.update('type', 'success');
                                notify.update('progress', 100);
                        }, 2000);
                }

                // Notify Error
                function notifyError() {
                        notify = $.notify(content, setting);
                        setTimeout(function() {
                                notify.update('message', '<strong>Failet Saving</strong> Data.');
                                notify.update('type', 'danger');
                                notify.update('progress', 100);
                        }, 1000);
                }
                // proses simpan
                $('#saveBtn').click(function(e) {
                        e.preventDefault();
                        $.ajax({
                                data: $('#formInput').serialize(),
                                url: "{{ route($title.'.store') }}",
                                type: "POST",
                                dataType: 'json',
                                success: function(data) {
                                        $('#formInput').trigger("reset");
                                        $('#ajaxModel').modal('hide');
                                        loadpage('', 5, '');
                                        notifySuccess();
                                },
                                error: function(data) {
                                        console.log('Error:', data);
                                        $('#formInput').trigger("reset");
                                        $('#ajaxModel').modal('hide');
                                        notifyError();
                                }
                        });
                });

                // proses update
                $('#updateBtn').click(function(e) {
                        let id = $('#formId').val();
                        e.preventDefault();
                        $.ajax({
                                data: $('#formInput').serialize(),
                                url: urlx + '/' + id,
                                type: "PUT",
                                dataType: 'json',
                                success: function(data) {
                                        $('#formInput').trigger("reset");
                                        $('#ajaxModel').modal('hide');
                                        loadpage('', 5, '');
                                        notifySuccess();
                                },
                                error: function(data) {
                                        $('#formInput').trigger("reset");
                                        $('#ajaxModel').modal('hide');
                                        notifyError();
                                }
                        });
                });

                $('body').on('click', '.deleteData', function() {
                        var id = $(this).data("id");
                        swal({
                                        title: 'Are you sure?',
                                        text: 'You want to delete this data!',
                                        icon: 'warning',
                                        dangerMode: true,
                                        buttons: {
                                                confirm: {
                                                        text: 'Yes, delete it!',
                                                },
                                                cancel: {
                                                        visible: true,
                                                        text: 'No, cancel!',
                                                }
                                        }
                                })
                                .then((willDelete) => {
                                        if (willDelete) {
                                                $.ajax({
                                                        headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        type: "DELETE",
                                                        url: urlx + '/' + id,
                                                        data: {
                                                                "_token": "{{ csrf_token() }}",
                                                        },
                                                        success: function(data) {
                                                                loadpage('', 5, '');
                                                                notifySuccess();
                                                        },
                                                        error: function(data) {
                                                                notifyError();
                                                        }
                                                });
                                        } else {
                                                swal.close();
                                        }
                                });
                });

                $('#exportBtn').click(function(e) {
                        let cari = $('#pencarian').val();
                        let product = $('#filter_product').val();
                        let range = $('#filter_range').val();
                        window.open(urlx + '/data/export?cari=' + cari + '&product=' + product + '&range=' + range, '_blank');
                });
        });
</script>
@endpush