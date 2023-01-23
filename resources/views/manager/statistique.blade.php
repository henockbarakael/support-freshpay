
@extends('layouts.app')
@push('style')

<head><base href="">
    <title>Paydrc | Daily Charge</title>
    <meta name="description" content="FreshPay Support Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="FreshPay | Support Dashboard">
    <meta property="og:url" content="https://gofreshpay.com/">
    <meta property="og:site_name" content="Support Dashboard | FreshPay ">
    <link rel="canonical" href="https://gofreshpay.com/">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the controls package.
      google.charts.load('current', {'packages':['corechart', 'controls']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawDashboard);

      // Callback that creates and populates a data table,
      // instantiates a dashboard, a range slider and a pie chart,
      // passes in the data and draws it.
      function drawDashboard() {

        // Create our data table.
        var data = google.visualization.arrayToDataTable([

          ['Name', 'Airtel debit'],
          <?php 
                foreach ($result as $key => $value) {
                    if ($value["action"] == "debit" && $value["method"] == "airtel" ) {
                        $institution = $value["institution_name"];
                        $total = $value["total"];
                        echo "['".$institution."',".$total."],";
                    }
                }
            ?> 
        ]);

        var orange = google.visualization.arrayToDataTable([

          ['Name', 'Orange debit'],
          <?php 
                foreach ($result as $key => $value) {
                    if ($value["action"] == "debit" && $value["method"] == "orange" ) {
                        $institution = $value["institution_name"];
                        $total = $value["total"];
                        echo "['".$institution."',".$total."],";
                    }
                }
            ?> 
        ]);

        var mpesa = google.visualization.arrayToDataTable([

          ['Name', 'Vodacom debit'],
          <?php 
                foreach ($result as $key => $value) {
                    if ($value["action"] == "debit" && $value["method"] == "mpesa" ) {
                        $institution = $value["institution_name"];
                        $total = $value["total"];
                        echo "['".$institution."',".$total."],";
                    }
                }
            ?> 
        ]);

        var airtelCredit = google.visualization.arrayToDataTable([

          ['Name', 'Airtel credit'],
          <?php 
                foreach ($result as $key => $value) {
                    if ($value["action"] == "credit" && $value["method"] == "airtel" ) {
                        $institution = $value["institution_name"];
                        $total = $value["total"];
                        echo "['".$institution."',".$total."],";
                    }
                }
            ?> 
        ]);

        var orangeCredit = google.visualization.arrayToDataTable([

          ['Name', 'Orange credit'],
          <?php 
                foreach ($result as $key => $value) {
                    if ($value["action"] == "credit" && $value["method"] == "orange" ) {
                        $institution = $value["institution_name"];
                        $total = $value["total"];
                        echo "['".$institution."',".$total."],";
                    }
                }
            ?> 
        ]);

        var mpesaCredit = google.visualization.arrayToDataTable([

          ['Name', 'Vodacom credit'],
          <?php 
                foreach ($result as $key => $value) {
                    if ($value["action"] == "credit" && $value["method"] == "mpesa" ) {
                        $institution = $value["institution_name"];
                        $total = $value["total"];
                        echo "['".$institution."',".$total."],";
                    }
                }
            ?> 
        ]);

        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));

        var dashboard_orange = new google.visualization.Dashboard(
            document.getElementById('dashboard_orange'));
        
        var dashboard_mpesa = new google.visualization.Dashboard(
            document.getElementById('dashboard_mpesa'));

       var dashboard_airtel_credit = new google.visualization.Dashboard(
            document.getElementById('dashboard_airtel_credit'));

        var dashboard_orange_credit = new google.visualization.Dashboard(
            document.getElementById('dashboard_orange_credit'));
        
        var dashboard_mpesa_credit = new google.visualization.Dashboard(
            document.getElementById('dashboard_mpesa_credit'));
        // Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_div',
          'options': {
            'filterColumnLabel': 'Airtel debit'
          }
        });

        var orangeRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_orange',
          'options': {
            'filterColumnLabel': 'Orange debit'
          }
        });

        var mpesaRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_mpesa',
          'options': {
            'filterColumnLabel': 'Vodacom debit'
          }
        });


        var airtelcreditRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_airtel_credit',
          'options': {
            'filterColumnLabel': 'Airtel credit'
          }
        });

        var orangecreditRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_orange_credit',
          'options': {
            'filterColumnLabel': 'Orange credit'
          }
        });

        var mpesacreditRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_mpesa_credit',
          'options': {
            'filterColumnLabel': 'Vodacom credit'
          }
        });

        // Create a pie chart, passing some options
        var pieChart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_div',
          'options': {
            'width': 400,
            'height': 400,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });

        var orangepieChart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_orange',
          'options': {
            'width': 400,
            'height': 400,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });

        var mpesapieChart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_mpesa',
          'options': {
            'width': 400,
            'height': 400,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });


        var airtelCreditChart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_airtel_credit',
          'options': {
            'width': 400,
            'height': 400,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });

        var orangeCreditChart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_orange_credit',
          'options': {
            'width': 400,
            'height': 400,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });

        var mpesaCreditChart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_mpesa_credit',
          'options': {
            'width': 400,
            'height': 400,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });

        // Establish dependencies, declaring that 'filter' drives 'pieChart',
        // so that the pie chart will only display entries that are let through
        // given the chosen slider range.
        dashboard.bind(donutRangeSlider, pieChart);
        dashboard_orange.bind(orangeRangeSlider, orangepieChart);
        dashboard_mpesa.bind(mpesaRangeSlider, mpesapieChart);

        dashboard_airtel_credit.bind(airtelcreditRangeSlider, airtelCreditChart);
        dashboard_orange_credit.bind(orangecreditRangeSlider, orangeCreditChart);
        dashboard_mpesa_credit.bind(mpesacreditRangeSlider, mpesaCreditChart);

        // Draw the dashboard.
        dashboard.draw(data);
        dashboard_orange.draw(orange);
        dashboard_mpesa.draw(mpesa);

        dashboard_airtel_credit.draw(airtelCredit);
        dashboard_orange_credit.draw(orangeCredit);
        dashboard_mpesa_credit.draw(mpesaCredit);
      }


    </script>
</head> 
@endpush
@section('content')
@section('page','Dashboard')
@section('page-title','FreshPay Bakery')
@section('subtitle','Statistiques')
{!! Toastr::message() !!}
@include('sweetalert::alert')
<div class="post d-flex flex-column-fluid" id="kt_post">
<!--begin::Container-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <!--begin::Col-->
                    <div class="col-lg-6 col-xxl-6">
                        <!--Div that will hold the dashboard-->
                        <div id="dashboard_div">
                            <!--Divs that will hold each control and chart-->
                            <div id="filter_div"></div>
                            <div id="chart_div"></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xxl-5">
                        <!--Div that will hold the dashboard-->
                        <div id="dashboard_orange">
                            <!--Divs that will hold each control and chart-->
                            <div id="filter_orange"></div>
                            <div id="chart_orange"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xxl-6">
                        <!--Div that will hold the dashboard-->
                        <div id="dashboard_airtel_credit">
                            <!--Divs that will hold each control and chart-->
                            <div id="filter_airtel_credit"></div>
                            <div id="chart_airtel_credit"></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xxl-5">
                        <!--Div that will hold the dashboard-->
                        <div id="dashboard_orange_credit">
                            <!--Divs that will hold each control and chart-->
                            <div id="filter_orange_credit"></div>
                            <div id="chart_orange_credit"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xxl-6">
                        <!--Div that will hold the dashboard-->
                        <div id="dashboard_mpesa">
                            <!--Divs that will hold each control and chart-->
                            <div id="filter_mpesa"></div>
                            <div id="chart_mpesa"></div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-xxl-5">
                        <!--Div that will hold the dashboard-->
                        <div id="dashboard_mpesa_credit">
                            <!--Divs that will hold each control and chart-->
                            <div id="filter_mpesa_credit"></div>
                            <div id="chart_mpesa_credit"></div>
                        </div>
                    </div>

                </div>
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label mb-1" style="font-size: 12px">Tableau statistique {{$todayDate}}</span>
                        </h3>
                        <div class="card-toolbar">
                            <!--begin::Export dropdown-->
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor"></rect>
                                        <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor"></path>
                                        <path opacity="0.3" d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="currentColor"></path>
                                    </svg>
                                </span>Export Report
                            </button>
        
                            <!--begin::Menu-->
                            <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="csv">
                                    Export as CSV
                                </a>
                            </div>

                            </div>
                            <!--begin::Hide default export buttons-->
                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                            <!--end::Hide default export buttons-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-dark table-striped align-middle gs-0 gy-4" id="kt_datatable_example_1">
                                <!--begin::Table head-->
                                <thead class="">
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="text-center ps-4 min-w-40px">#</th>
                                        <th class="min-w-40px">Institution</th>
                                        <th class="min-w-40px">Method</th>
                                        <th class="min-w-40px">Action</th>
                                        <th class="min-w-40px text-center">Successful</th>
                                        <th class="min-w-40px text-center">Failed</th>
                                        <th class="min-w-40px text-center">Pending</th>
                                        <th class="min-w-40px text-center">Submitted</th>
                                        <th class="min-w-60px text-center">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result as $key => $value)
                                    <tr>
                                        <td class="text-center">
                                            <span class="text-dark fw-semibold text-muted d-block fs-7">{{++$key}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["institution_name"]}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["method"]}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["action"]}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7 text-center">{{$value["success"]}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7 text-center">{{$value["failed"]}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7 text-center">{{$value["pending"]}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7 text-center">{{$value["submitted"]}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["total"]}}</span>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

</div>
<!--end::Container-->
</div>
@section('script')
<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

<script type="text/javascript">
    "use strict";
    
    // Class definition
    var KTDatatablesExample = function () {
        // Shared variables
        var table;
        var datatable;
    
        // Private functions
        var initDatatable = function () {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');
    
            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                dateRow[3].setAttribute('data-order', realDate);
            });
    
            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "order": [[ 0, 'desc' ]],
                "language": {
                "lengthMenu": "Show _MENU_",
                },
                "dom":
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
            });
        }
    
        // Hook export buttons
        var exportButtons = () => {
            const documentTitle = 'Charge_'+'<?php echo $todayDate; ?>';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_buttons'));
    
            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();
    
                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
    
                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }
    
        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }
    
        // Public methods
        return {
            init: function () {
                table = document.querySelector('#kt_datatable_example_1');
    
                if ( !table ) {
                    return;
                }
    
                initDatatable();
                exportButtons();
                handleSearchDatatable();
            }
        };
    }();
    
    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesExample.init();
    });
</script>

@endsection
@endsection
