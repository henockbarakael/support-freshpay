@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Transaction Verify</title>
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
    <style type="text/css">
        .loading {
            z-index: 20;
            position: absolute;
            top: 0;
            left:-5px;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .loading-content {
            position: absolute;
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            top: 40%;
            left:50%;
            animation: spin 2s linear infinite;
            }
              
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
    </style>
</head> 
@endpush
@section('content')
@section('page','Dashboard')
{!! Toastr::message() !!}
@include('sweetalert::alert')
<div class="post d-flex flex-column-fluid ici" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <section id="loading">
            <div id="loading-content"></div>
        </section>
        <form action="#" id="postForm" method="POST">
            {{ csrf_field() }}
            <!--begin::Card-->
            <div class="card mb-7">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Compact form-->
                    <div class="d-flex align-items-center">
                        {{-- <div class="row g-8"> --}}
                            <!--begin::Input group-->
                            <div class="col-sm-7">
                                <label class="fs-6 form-label fw-bold text-dark">Switch Reference</label>
                                <!--begin::Select-->
                                <input type="text" autocomplete="off" class="form-control form-control form-control-solid" name="switch_reference" value="">
                                <!--end::Select-->
                            </div>
                            {{-- <div class="col-lg-3">
                                <label class="fs-6 form-label fw-bold text-dark">Datetime</label>
                                <!--begin::Select-->
                                <input class="form-control form-control-solid" name="datetime" placeholder="Pick date rage" id="kt_daterangepicker_3"/>
                                <!--end::Select-->
                            </div> --}}
                            <div class="col-sm-5">
                                <!--begin::Radio group-->
                                <div class="nav-group nav-group-fluid mt-7">
                                    <!--begin::Option-->
                                    <label>
                                        <button type="submit" class="btn btn-primary me-5">Search Transaction</button>
                                    </label>
                                </div>
                                <!--end::Radio group-->
                            </div>
                        {{-- </div> --}}
                    
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
        <div class="card mt-6 myshadow2">

            <div class="card-body py-4">
                <table class="table table-dark table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_zero_configuration">
                    <thead>
                        <tr class="fw-bolder text-muted fs-7 text-uppercase gs-0">
							<th class="min-w-80px">Customer</th>
                            <th class="min-w-80px">Paydrc Référence</th>
                            <th class="min-w-80px">Switch Référence</th>
                            <th class="min-w-80px">Telco Référence</th>
                            <th class="min-w-80px">Status Paydrc</th>
                            <th class="min-w-80px">Status Verify</th>
                            <th class="min-w-300px">Description</th>
                        </tr>
                    </thead>
                    <tbody id="table_content">
                    </tbody>

                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@section('script')
<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
$("#kt_datatable_zero_configuration").DataTable();
</script>
<script type="text/javascript">
  
    /*------------------------------------------
    --------------------------------------------
    Add Loading When fire Ajax Request
    --------------------------------------------
    --------------------------------------------*/
    $(document).ajaxStart(function() {
        $('#loading').addClass('loading');
        $('#loading-content').addClass('loading-content');
    });
  
    /*------------------------------------------
    --------------------------------------------
    Remove Loading When fire Ajax Request
    --------------------------------------------
    --------------------------------------------*/
    $(document).ajaxStop(function() {
        $('#loading').removeClass('loading');
        $('#loading-content').removeClass('loading-content');
    });
      
</script>
<script type="text/javascript">
  
    $("#postForm").submit(function(e){
        e.preventDefault();
  
        $.ajax({
            url: "{{url('finance/api/freshpay/verify/search')}}",
            type: "POST",
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                switch_reference: $("input[name='switch_reference']").val(),
            },
            dataType: 'json',
            success: function (responseOutput) {
                if (responseOutput['success']==true) {
                    var responseInfo = responseOutput.data;
                    var bodyData = '';
                    $.each(responseInfo,function(index,row){
                        bodyData+=
                        bodyData+='<tr>'+
                                    '<td>'+row.customer_number+'</td>'+
                                    '<td>'+row.paydrc_reference+'</td>'+
                                    '<td>'+row.switch_reference+'</td>'+
                                    '<td>'+row.financial_institution_id+'</td>'+
                                    '<td>'+row.status+'</td>'+
                                    '<td>'+row.new_status+'</td>'+
                                    '<td>'+row.financial_status_description+'</td>';
                                  '</tr>';
                        
                    })
                    $('#table_content').html(bodyData);
                    $("#postForm")[0].reset();
                }
                else if(responseOutput['success']==false){
                    alert("Transaction not found. Please verify the reference!"); 
                    var responseInfo = responseOutput.data;
                    var bodyData = '';
                    $.each(responseInfo,function(index,row){
                        bodyData+=
                        bodyData+='<tr>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>';
                                  '</tr>';
                        
                    })
                    $('#table_content').html(bodyData);
                    $("#postForm")[0].reset();
                }
              
                    
        
            }
        });
    });
      
</script>
@endsection
@endsection