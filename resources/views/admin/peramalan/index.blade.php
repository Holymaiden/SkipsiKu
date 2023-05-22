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
                                                        <div class="form-group mb-0 me-0"></div>
                                                        <a class="btn btn-success" id="exportBtn"> <i data-feather="file"></i>Export</a>
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
                                                                                                                <h6 class="f-w-600 mt-4">Tahun</h6>
                                                                                                                <input class="datepicker-here form-control digits" name="filter_year" id="filter_year" type="text" data-language="en" data-min-view="years" data-view="years" data-date-format="yyyy">
                                                                                                                <h6 class="f-w-600 mt-4">Bulan</h6>
                                                                                                                <input class="datepicker-here form-control digits" name="filter_month" id="filter_month" type="text" data-language="en" data-min-view="months" data-view="months" data-date-format="MM">
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
                                                                                <th>Tanggal</th>
                                                                                <th>Stok (Y)</th>
                                                                                <th>Transaksi (X<sub>1</sub>)</th>
                                                                                <th>Pengunjung (X<sub>2</sub>)</th>
                                                                                <th>Y<sup>2</sup></th>
                                                                                <th>X<sub>1</sub><sup>2</sup></th>
                                                                                <th>X<sub>2</sub><sup>2</sup></th>
                                                                                <th>X<sub>1</sub>Y</th>
                                                                                <th>X<sub>2</sub>Y</th>
                                                                                <th>X<sub>1</sub>X<sub>2</sub></th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody class="datatabels">
                                                                </tbody>
                                                                <tfoot>
                                                                        <tr>
                                                                                <th>No</th>
                                                                                <th>Tanggal</th>
                                                                                <th>Stok (Y)</th>
                                                                                <th>Transaksi (X<sub>1</sub>)</th>
                                                                                <th>Pengunjung (X<sub>2</sub>)</th>
                                                                                <th>Y<sup>2</sup></th>
                                                                                <th>X<sub>1</sub><sup>2</sup></th>
                                                                                <th>X<sub>2</sub><sup>2</sup></th>
                                                                                <th>X<sub>1</sub>Y</th>
                                                                                <th>X<sub>2</sub>Y</th>
                                                                                <th>X<sub>1</sub>X<sub>2</sub></th>
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

                        <div class="col-sm-12">
                                <div class="card">
                                        <div class="card-header pb-0 row align-content-between">
                                                <div class="col-10">
                                                        <h3>SUM</h3><span></span>
                                                </div>
                                        </div>
                                        <div class="card-body">
                                                <div class="table-responsive">
                                                        <table class="table table-bordernone">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Stok (Y)</th>
                                                                                <th>Transaksi (X<sub>1</sub>)</th>
                                                                                <th>Pengunjung (X<sub>2</sub>)</th>
                                                                                <th>Y<sup>2</sup></th>
                                                                                <th>X<sub>1</sub><sup>2</sup></th>
                                                                                <th>X<sub>2</sub><sup>2</sup></th>
                                                                                <th>X<sub>1</sub>Y</th>
                                                                                <th>X<sub>2</sub>Y</th>
                                                                                <th>X<sub>1</sub>X<sub>2</sub></th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody class="datatabels2">
                                                                </tbody>
                                                                <tfoot>
                                                                        <tr>
                                                                                <th>Stok (Y)</th>
                                                                                <th>Transaksi (X<sub>1</sub>)</th>
                                                                                <th>Pengunjung (X<sub>2</sub>)</th>
                                                                                <th>Y<sup>2</sup></th>
                                                                                <th>X<sub>1</sub><sup>2</sup></th>
                                                                                <th>X<sub>2</sub><sup>2</sup></th>
                                                                                <th>X<sub>1</sub>Y</th>
                                                                                <th>X<sub>2</sub>Y</th>
                                                                                <th>X<sub>1</sub>X<sub>2</sub></th>
                                                                        </tr>
                                                                </tfoot>
                                                        </table>
                                                </div>
                                        </div>
                                </div>
                        </div>

                        <div class="col-sm-12">
                                <div class="card">
                                        <div class="card-header pb-0 row align-content-between">
                                                <div class="col-10">
                                                        <h3>&Sigma;</h3><span></span>
                                                </div>
                                        </div>
                                        <div class="card-body">
                                                <div class="table-responsive">
                                                        <table class="table table-bordernone">
                                                                <thead>
                                                                        <tr>
                                                                                <th>&Sigma;Y<sup>2</sup></th>
                                                                                <th>&Sigma;X<sub>1</sub><sup>2</sup></th>
                                                                                <th>&Sigma;X<sub>2</sub><sup>2</sup></th>
                                                                                <th>&Sigma;X<sub>1</sub>Y</th>
                                                                                <th>&Sigma;X<sub>2</sub>Y</th>
                                                                                <th>&Sigma;X<sub>1</sub>X<sub>2</sub></th>
                                                                                <th>B<sub>1</sub></th>
                                                                                <th>B<sub>2</sub></th>
                                                                                <th>A</th>
                                                                                <th>R</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody class="datatabels3">
                                                                </tbody>
                                                                <tfoot>
                                                                        <tr>
                                                                                <th>&Sigma;Y<sup>2</sup></th>
                                                                                <th>&Sigma;X<sub>1</sub><sup>2</sup></th>
                                                                                <th>&Sigma;X<sub>2</sub><sup>2</sup></th>
                                                                                <th>&Sigma;X<sub>1</sub>Y</th>
                                                                                <th>&Sigma;X<sub>2</sub>Y</th>
                                                                                <th>&Sigma;X<sub>1</sub>X<sub>2</sub></th>
                                                                                <th>B<sub>1</sub></th>
                                                                                <th>B<sub>2</sub></th>
                                                                                <th>A</th>
                                                                                <th>R</th>
                                                                        </tr>
                                                                </tfoot>
                                                        </table>
                                                </div>
                                        </div>
                                </div>
                        </div>

                        <div class="col-sm-12">
                                <div class="card">
                                        <div class="card-header pb-0 row align-content-between">
                                                <div class="col-10">
                                                        <h3>Peramalan</h3><span></span>
                                                </div>
                                                <div class="col-2">
                                                        <select class="form-select" name="jumlah2" id="jumlah2">
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
                                                                                <th>Tanggal</th>
                                                                                <th>Stok</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody class="datatabels4">
                                                                </tbody>
                                                                <tfoot>
                                                                        <tr>
                                                                                <th>No</th>
                                                                                <th>Tanggal</th>
                                                                                <th>Stok</th>
                                                                        </tr>
                                                                </tfoot>
                                                        </table>
                                                </div>
                                                <div class="d-flex justify-content-between flex-wrap mt-4">
                                                        <div class="text-center">
                                                                <div id="contentx2"></div>
                                                        </div>
                                                        <div class="text-center">
                                                                <ul class="pagination twbs-pagination2 pagination-primary">
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

@endsection

@push('jsScript')
@include('admin._layouts._js-table')

<script type="text/javascript">
        $(document).ready(function() {
                let urlx = "{{ $title }}";

                loadpage('', 5, 5, '');
                var p1 = 1,
                        p2 = 1,
                        cari = '',
                        jml = 5,
                        jml2 = 5;
                var year, month, range = '';

                var $pagination = $('.twbs-pagination');
                var $pagination2 = $('.twbs-pagination2');
                var defaultOpts = {
                        totalPages: 1,
                        prev: '&#8672;',
                        next: '&#8674;',
                        first: '&#8676;',
                        last: '&#8677;',
                };
                $pagination.twbsPagination(defaultOpts);

                function loaddata(page, cari, jml, jml2, page2, product) {
                        $.ajax({
                                url: urlx + '/data',
                                data: {
                                        "page": page,
                                        "cari": cari,
                                        "jml": jml,
                                        "jml2": jml2,
                                        "page2": page2,
                                        "product": product,
                                        "year": year,
                                        "month": month,
                                        "range": range
                                },
                                type: "GET",
                                datatype: "json",
                                success: function(data) {
                                        $(".datatabels").html(data.html);
                                        $(".datatabels2").html(data.html2);
                                        $(".datatabels3").html(data.html3);
                                        $(".datatabels4").html(data.html4);
                                }
                        });
                }

                function loadpage(cari, jml, jml2, product) {
                        $.ajax({
                                url: urlx + '/data',
                                data: {
                                        "cari": cari,
                                        "jml": jml,
                                        "jml2": jml2,
                                        "product": product,
                                        "year": year,
                                        "month": month,
                                        "range": range
                                },
                                type: "GET",
                                datatype: "json",
                                success: function(response) {
                                        console.log(response);
                                        if ($pagination.data("twbs-pagination")) {
                                                $pagination.twbsPagination('destroy');
                                        }
                                        if ($pagination2.data("twbs-pagination")) {
                                                $pagination2.twbsPagination('destroy');
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
                                                        p1 = page;
                                                        $('#contentx').text('Showing ' + to + ' to ' + end + ' of ' + response.total_data + ' entries');
                                                        loaddata(page, cari, jml, jml2, p2, product);
                                                }

                                        }));
                                        $pagination2.twbsPagination($.extend({}, defaultOpts, {
                                                startPage: 1,
                                                totalPages: response.total_page2,
                                                visiblePages: 4,
                                                prev: '&#8672;',
                                                next: '&#8674;',
                                                first: '&#8676;',
                                                last: '&#8677;',
                                                onPageClick: function(event, page) {
                                                        if (page == 1) {
                                                                var to = 1;
                                                        } else {
                                                                var to = page * jml2 - (jml2 - 1);
                                                        }
                                                        if (page == response.total_page2) {
                                                                var end = response.total_data2;
                                                        } else {
                                                                var end = page * jml2;
                                                        }
                                                        p2 = page;
                                                        $('#contentx2').text('Showing ' + to + ' to ' + end + ' of ' + response.total_data2 + ' entries');
                                                        loaddata(p1, cari, jml, jml2, page, product);
                                                }
                                        }));
                                }
                        });
                }

                $("#pencarian, #jumlah, #jumlah2, #filter_product").on('keyup change', function(event) {
                        let cari = $('#pencarian').val();
                        let jml = $('#jumlah').val();
                        let jml2 = $('#jumlah2').val();
                        let product = $('#filter_product').val();
                        loadpage(cari, jml, jml2, product);
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

                $('#btn-filter').click(function() {
                        let cari = $('#pencarian').val();
                        let jml = $('#jumlah').val();
                        let jml2 = $('#jumlah2').val();
                        let product = $('#filter_product').val();
                        let year2 = $('#filter_year').val();
                        let month2 = $('#filter_month').val();
                        let range2 = $('#filter_range').val();
                        if ((range2 != '' && year2 != '') || (range2 != '' && month2 != '')) {
                                notify = $.notify(content, setting);
                                notify.update('message', '<strong>Tahun atau Bulan Harus Kosong Jika Mengisi Range</strong> Data.');
                                notify.update('type', 'danger');
                                notify.update('progress', 100);
                        } else {
                                if (range2 == '') {
                                        year = year2;
                                        month = month2;
                                        range = '';
                                } else {
                                        year = '';
                                        month = '';
                                        range = range2;
                                }
                                console.log(year, month, range);
                                loadpage(cari, jml, jml2, product);
                        }
                });

                $('#btn-reset').click(function() {
                        $('#filter_year').val('').trigger('change');
                        $('#filter_month').val('').trigger('change');
                        $('#filter_range').val('').trigger('change');
                        $('#filter_product').val('').trigger('change');
                        let cari = $('#pencarian').val();
                        let jml = $('#jumlah').val();
                        let jml2 = $('#jumlah2').val();
                        let product = $('#filter_product').val();
                        loadpage(cari, jml, jml2, product);
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