@extends('layouts.app')
@push('style')
<head><base href="">
    <title>FreshPay Bulk Update</title>
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
            top: 50%;
            left:50%;
            animation: spin 2s linear infinite;
            }
              
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
    </style>
    {{-- <style>
        .ajax-load{
            display: none;
            position: center;
            width: 100%;
            height: 100%;
            z-index: 999;
            background: rgba(255,255,255,0.8);
        }
        /* .ajax-load{
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        } */
        /* Turn off scrollbar when body element has the loading class */
        body.loading{
            overflow: hidden;   
        }
        /* Make spinner image visible when body element has the loading class */
        body.loading .ajax-load{
            display: block;
        }
    </style> --}}
</head> 
@endpush
@section('content')
@section('page','Dashboard')
@section('page-title','FreshPay Bulk Update')
@section('subtitle',$todayDate)
{!! Toastr::message() !!}
@include('sweetalert::alert')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        {{-- <div class="ajax-load text-center" style="display:none">
            <img src="{{asset('assets/Ellipsis-1s-200px.gif')}}">
        </div> --}}
        <section id="loading">
            <div id="loading-content"></div>
        </section>
        <div class="card mb-10">
            <div class="card-body d-flex align-items-center p-5 p-lg-8">
                <!--begin::Icon-->
                <div class="d-flex h-50px w-50px h-lg-80px w-lg-80px flex-shrink-0 flex-center position-relative align-self-start align-self-lg-center mt-3 mt-lg-0">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs051.svg-->
                    <span class="svg-icon svg-icon-primary position-absolute opacity-15">
                        <svg class=". h-50px w-50px h-lg-80px w-lg-80px ." xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                            <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/coding/cod009.svg-->
                    <span class="svg-icon svg-icon-2x svg-icon-lg-3x svg-icon-primary position-absolute">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M22.0318 8.59998C22.0318 10.4 21.4318 12.2 20.0318 13.5C18.4318 15.1 16.3318 15.7 14.2318 15.4C13.3318 15.3 12.3318 15.6 11.7318 16.3L6.93177 21.1C5.73177 22.3 3.83179 22.2 2.73179 21C1.63179 19.8 1.83177 18 2.93177 16.9L7.53178 12.3C8.23178 11.6 8.53177 10.7 8.43177 9.80005C8.13177 7.80005 8.73176 5.6 10.3318 4C11.7318 2.6 13.5318 2 15.2318 2C16.1318 2 16.6318 3.20005 15.9318 3.80005L13.0318 6.70007C12.5318 7.20007 12.4318 7.9 12.7318 8.5C13.3318 9.7 14.2318 10.6001 15.4318 11.2001C16.0318 11.5001 16.7318 11.3 17.2318 10.9L20.1318 8C20.8318 7.2 22.0318 7.59998 22.0318 8.59998Z" fill="currentColor"></path>
                            <path d="M4.23179 19.7C3.83179 19.3 3.83179 18.7 4.23179 18.3L9.73179 12.8C10.1318 12.4 10.7318 12.4 11.1318 12.8C11.5318 13.2 11.5318 13.8 11.1318 14.2L5.63179 19.7C5.23179 20.1 4.53179 20.1 4.23179 19.7Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Icon-->
                <!--begin::Description-->
                <div class="ms-6">
                    <p class="list-unstyled text-gray-600 fw-semibold fs-6 p-0 m-0 mb-1">In this page you can update the status of transactions to "cancelled" or "accepted" by uploading the Excel file downloaded directly from the PayDrc.</p>
                    <p class="list-unstyled text-gray-600 fw-semibold fs-6 p-0 m-0">Dans cette page vous pouvez mettre à jour le statut des transactions à « annulées » ou « acceptées » en téléversant le fichier Excel téléchargé directement à partir du PayDrc.</p>
                </div>
                <!--end::Description-->
            </div>
        </div>
        <div class="card  myshadow2">
            <div class="card-body">
                <h1 style="font-size: 18px" class="anchor fw-bold mb-5" id="queue-upload" data-kt-scroll-offset="50">
                <a href="#queue-upload" style="font-size: 12px"></a>File from paydrc</h1>
                <div class="py-2">
                    <p>{{session('status')}}</p>
                    <form class="form" action="#" method="post">
                        @csrf
                        <div class="rounded border  p-3">
                            <div class="form-group row">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label text-lg-right">Import CSV:</label>
                                    <!--end::Label-->
        
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone dropzone-queue mb-2" id="dropzone_freshpay">
                                            <!--begin::Controls-->
                                            <div class="dropzone-panel mb-lg-0 mb-2">
                                                <a class="dropzone-select btn btn-sm btn-primary me-2">Attach files</a>
                                                <a class="dropzone-upload btn btn-sm btn-light-primary me-2">Upload All</a>
                                                <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
                                            </div>
                                            <!--end::Controls-->
        
                                            <!--begin::Items-->
                                            <div class="dropzone-items wm-200px">
                                                <div class="dropzone-item" style="display:none">
                                                    <!--begin::File-->
                                                    <div class="dropzone-file">
                                                        <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                            <span data-dz-name>some_image_file_name.jpg</span>
                                                            <strong>(<span data-dz-size>340kb</span>)</strong>
                                                        </div>
        
                                                        <div class="dropzone-error" data-dz-errormessage></div>
                                                    </div>
                                                    <!--end::File-->
        
                                                    <!--begin::Progress-->
                                                    <div class="dropzone-progress">
                                                        <div class="progress">
                                                            <div
                                                                class="progress-bar bg-primary"
                                                                role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Progress-->
        
                                                    <!--begin::Toolbar-->
                                                    <div class="dropzone-toolbar">
                                                        <span class="dropzone-start"><i class="bi bi-play-fill fs-3"></i></span>
                                                        <span class="dropzone-cancel" data-dz-remove style="display: none;"><i class="bi bi-x fs-3"></i></span>
                                                        <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Dropzone-->
        
                                        <!--begin::Hint-->
                                        <span class="form-text text-muted">Max file size is 1MB and max number of files is 5.</span>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--end::Form-->
        <div class="card mt-6 myshadow2">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Transaction" />
                    </div>
                    <!--end::Search-->
                </div>

                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                        <!--begin::Filter-->
                        <button type="button" class="btn btn-light-success me-3 btn-border btn-sm  success-all myshadow">Success All</button>
                        <button type="button" class="btn btn-light-warning me-3 btn-border failed-all btn-sm myshadow" data-url="">Failed All</button>
                        <button type="button" class="btn btn-light-danger me-3 btn-border delete-all btn-sm myshadow" data-url="">Delete All</button>

                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                        <button type="button" class="btn btn-light-danger me-3 btn-border failed-all btn-sm myshadow" data-url="">Failed All</button>

                    </div>
                    <!--end::Group actions-->
                </div>
            </div>
            {{-- <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <input type="text" data-kt-filter="search" class="form-control form-control-solid w-350px ps-14" placeholder="" />
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Search-->
                    <!--begin::Export buttons-->
                    <div id="kt_datatable_example_1_export" class="d-none"></div>
                    <!--end::Export buttons-->
                </div>
            </div>

            <div class="card-header border-0 pt-6 ">
        
                <div class="card-toolbar">
                    
                    <div class="d-flex justify-content-end align-items-center d-none">
                        <button type="button" class="btn btn-light-success me-3 btn-border btn-sm  success-all myshadow">Success All</button>
                        <button type="button" class="btn btn-light-danger me-3 btn-border failed-all btn-sm myshadow" data-url="">Failed All</button>
                    </div>
                </div>
            </div> --}}
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table table-striped align-middlefs-6 gy-5" id="kt_datatable_example">
                    <thead>
                        <tr class="fw-bolder text-muted fs-7 text-uppercase gs-0">
                            <th class="w-10px" style="vertical-align:middle; text-align:center">
                                <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                    <input class="form-check-input" type="checkbox" id="check_all">
                                </div>
                            </th>
							<th class="min-w-80px">Customer</th>
                            <th class="min-w-80px">Amount</th>
                            <th class="min-w-80px">Currency</th>
                            <th class="min-w-80px">Référence</th>
                            <th class="min-w-80px">Status File</th>
                            <th class="min-w-80px text-center">Action</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold" id="tbody">
                        <!--begin::Table row-->
                        @if($rows->count())
                        @foreach ($rows as $row)
                        <tr id="tr_{{$row->paydrc_reference}}" class="text-start">
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input checkbox" type="checkbox" data-id="{{$row->paydrc_reference}}">
                                </div>
                            </td>
                            <td>{{$row['customer_details']}}</td>
                            <td>{{$row['amount']}}</td>
                            <td>{{$row['currency']}}</td>
                            <td>{{$row['paydrc_reference']}}</td>
                            @if($row['status'] == "Successful")
                            <td><div class="badge badge-light-success fw-bold">{{$row['status']}}</div></td>
                            @elseif($row['status'] == "Pending")
                                <td><div class="badge badge-light-warning fw-bold">{{$row['status']}}</div></td>
                            @elseif($row['status'] == "Failed")
                                <td><div class="badge badge-light-danger fw-bold">{{$row['status']}}</div></td>
                            @elseif($row['status'] == "Submitted")
                                <td><div class="badge badge-light-primary fw-bold">{{$row['status']}}</div></td>
                            @endif
                            <td class="text-center">
                                {!! Form::open(['method' => 'POST','route' => ['admin.success.single', $row->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('S', ['class' => 'btn btn-success btn-border btn-sm rounded-2','data-toggle'=>'confirmation','data-placement'=>'left']) !!}
                                {!! Form::close() !!}

                                {!! Form::open(['method' => 'POST','route' => ['admin.failed.single', $row->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('F', ['class' => 'btn btn-danger btn-border btn-sm','data-toggle'=>'confirmation','data-placement'=>'left']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr> 
                        @endforeach
                        @endif
                        <!--end::Table row-->
                    </tbody>
                    <!--end::Table body-->
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
<script type="text/javascript">
  
    $(document).ajaxStart(function() {
        $('#loading').addClass('loading');
        $('#loading-content').addClass('loading-content');
    });

    $(document).ajaxStop(function() {
        $('#loading').removeClass('loading');
        $('#loading-content').removeClass('loading-content');
    });
      
</script>
<script type="text/javascript">
	$("#kt_daterangepicker_3").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"),12)
    }, function(start, end, label) {
        var years = moment().diff(start, "years");
    }
);
</script>

<script type="text/javascript">
    $(document).ready(function () {
        
        $('#check_all').on('click', function(e) {
            if($(this).is(':checked',true)) {
                $(".checkbox").prop('checked', true);  
            } 
            else {  
                $(".checkbox").prop('checked',false);  
            }  
        });

        $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }
            else{
                $('#check_all').prop('checked',false);
            }
        });

        $('.failed-all').on('click', function(e) {
                var idsArr = [];  
                $(".checkbox:checked").each(function() {  
                    idsArr.push($(this).attr('data-id'));
                });  
                if(idsArr.length <=0)  
                {  
                    alert("Please select atleast one transaction to failed.");  
                }  
                // Start Multiple Paiement
                else {  

                    var strIds = idsArr.join(","); 
                    var redirect = "{{ url('admin/action-failed-all') }}";
                    $.ajax({
                        url: "{{ url('admin/action-failed-all') }}",
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        processData: true,
                        beforeSend: function(){
                        $('.ajax-load').show();
                        $(".table").hide();
                        },
                        success: function (data) {
                            if (data['success']==true) {
                                toastr.info(data['message'], 'Success Alert', {
                                timeOut: 600
                                });
                                location.reload();
                                $('.table').load(document.URL +  ' .table');
                            }  
                            else if (data['success']==false) {
                                toastr.error(data['message'], 'Error Alert', {
                                timeOut: 600
                                });
                                location.reload();
                                $('.table').load(document.URL +  ' .table');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                            location.reload();
                            $('.table').load(document.URL +  ' .table');
                        },
                        complete:function(data){
                            /* Hide image container */
                            $(".ajax-load").hide();
                        }
                    });
                } 
                // End Multiple paiement 
        });

        $('.success-all').on('click', function(e) {
                var idsArr = [];  
                $(".checkbox:checked").each(function() {  
                    idsArr.push($(this).attr('data-id'));
                });  
                if(idsArr.length <=0)  
                {  
                    alert("Please select atleast one transaction to success.");  
                }  
                // Start Multiple Paiement
                else {  

                    var strIds = idsArr.join(","); 
                    var redirect = "{{ url('admin/action-successfull-all') }}";
                    $.ajax({
                        url: "{{ url('admin/action-successfull-all') }}",
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        processData: true,
                        beforeSend: function(){
                        $('.ajax-load').show();
                        $(".table").hide();
                        },
                        success: function (data) {
                            if (data['status']==true) {
                                toastr.info(data['message'], 'Success Alert', {
                                timeOut: 600
                                });
                                location.reload();
                                $('.table').load(document.URL +  ' .table');
                            }  
                            else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        },
                        complete:function(data){
                            /* Hide image container */
                            $(".ajax-load").hide();
                        }
                    });
                } 
                // End Multiple paiement 
        });

        $('.delete-all').on('click', function(e) {
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  
            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to delete.");  
            }  
            else {  
                if(confirm("Are you sure, you want to delete the selected transactions?")){  
                    var strIds = idsArr.join(","); 
                    $.ajax({
                        url: "{{ route('admin.transaction.delete.multiple') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        processData: true,
                        beforeSend: function(){
                        $('.ajax-load').show();
                        $(".table").hide();
                        },
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                toastr.info(data['message'], 'Success Alert', {
                                        timeOut: 600
                                    });
                                    location.reload();
                                    $('.table').load(document.URL +  ' .table');
                            } else {
                                alert('Whoops Something went wrong!!');
                                location.reload();
                            }
                        },
                        error: function (data) {
                        alert(data.responseText);
                        }
                    });
                }  
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.closest('form').submit();
                }
        }); 
    });
    // Add remove loading class on body element based on Ajax request status
    $(document).on({
            ajaxStart: function(){
                $("body").addClass("loading"); 
            },
            ajaxStop: function(){ 
                $("body").removeClass("loading"); 
            }    
        });
</script>
<script type="text/javascript">
// set the dropzone container id
const id = "#dropzone_freshpay";
const dropzone = document.querySelector(id);

// set the preview element template
var previewNode = dropzone.querySelector(".dropzone-item");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
    url: "import", // Set the url for your upload script location
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    maxFilesize: 1, // Max filesize in MB
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: id + " .dropzone-items", // Define the container to display the previews
    clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
});

myDropzone.on("addedfile", function (file) {
    // Hookup the start button
    file.previewElement.querySelector(id + " .dropzone-start").onclick = function () { myDropzone.enqueueFile(file); };
    const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
    dropzoneItems.forEach(dropzoneItem => {
        dropzoneItem.style.display = '';
    });
    dropzone.querySelector('.dropzone-upload').style.display = "inline-block";
    dropzone.querySelector('.dropzone-remove-all').style.display = "inline-block";
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function (progress) {
    const progressBars = dropzone.querySelectorAll('.progress-bar');
    progressBars.forEach(progressBar => {
        progressBar.style.width = progress + "%";
    });
});

myDropzone.on("sending", function (file) {
    // Show the total progress bar when upload starts
    const progressBars = dropzone.querySelectorAll('.progress-bar');
    progressBars.forEach(progressBar => {
        progressBar.style.opacity = "1";
    });
    // And disable the start button
    file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("complete", function (progress) {
    const progressBars = dropzone.querySelectorAll('.dz-complete');

    setTimeout(function () {
        progressBars.forEach(progressBar => {
            progressBar.querySelector('.progress-bar').style.opacity = "0";
            progressBar.querySelector('.progress').style.opacity = "0";
            progressBar.querySelector('.dropzone-start').style.opacity = "0";
        });
    }, 300);
});

// Setup the buttons for all transfers
dropzone.querySelector(".dropzone-upload").addEventListener('click', function () {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    
});

// Setup the button for remove all files
dropzone.querySelector(".dropzone-remove-all").addEventListener('click', function () {
    dropzone.querySelector('.dropzone-upload').style.display = "none";
    dropzone.querySelector('.dropzone-remove-all').style.display = "none";
    myDropzone.removeAllFiles(true);
});

// On all files completed upload
myDropzone.on("queuecomplete", function (progress) {
    const uploadIcons = dropzone.querySelectorAll('.dropzone-upload');
    uploadIcons.forEach(uploadIcon => {
        uploadIcon.style.display = "none";
    });
    toastr.info('Your File Uploaded Successfully!!', 'Success Alert', {
              timeOut: 600
            });
    location.reload();
    
});

// myDropzone.on("success", function (response) {
//     // response = JSON.parse(response);
//     // console.log(response.xhr.response.success); 
//     if(response.success == true) {
//         $("#text-output-recharge").html("<div class='alert alert-success'>" + response.message + " </div>");
//     }
    

//     // alert(response.success); 
// });

// On all files removed
myDropzone.on("removedfile", function (file) {
    if (myDropzone.files.length < 1) {
        dropzone.querySelector('.dropzone-upload').style.display = "none";
        dropzone.querySelector('.dropzone-remove-all').style.display = "none";
    }
});
</script>

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
            "info": false,
            'order': [],
            'pageLength': 10,
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        const documentTitle = 'Customer Orders Report';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: documentTitle
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
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
            table = document.querySelector('#kt_datatable_example');

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