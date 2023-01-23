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
    <style>
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
        </style>
</head> 
@endpush
@section('content')
@section('page','Dashboard')
{!! Toastr::message() !!}
@include('sweetalert::alert')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="ajax-load text-center" style="display:none">
            <img src="{{asset('assets/Ellipsis-1s-200px.gif')}}">
        </div>
        <div class="card  myshadow2">
            <div class="card-body">
                <h1 style="font-size: 18px" class="anchor fw-bold mb-5" id="queue-upload" data-kt-scroll-offset="50">
                <a href="#queue-upload" style="font-size: 12px"></a>Bulk Verify</h1>
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
                        {{-- <button type="button" class="btn btn-light-success me-3 btn-border btn-sm  success-all myshadow">Success All</button> --}}
                        <button type="button" class="btn btn-light-primary me-3 btn-border verify-all btn-sm myshadow" data-url="">Verify All</button>

                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_example">
                    <thead>
                        <tr class="fw-bolder text-muted fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" id="check_all">
                                </div>
                            </th>
							<th class="min-w-80px">Customer</th>
                            <th class="min-w-80px">Switch Référence</th>
                            <th class="min-w-80px">Status</th>
                            <th class="min-w-80px">Verify Status</th>
                            {{-- <th class="min-w-80px text-center">Action</th> --}}
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold" id="tbody">
                        <!--begin::Table row-->
                        @if($rows->count())
                        @foreach ($rows as $row)
                        <tr id="tr_{{$row->switch_reference}}" class="text-start">
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input checkbox" type="checkbox" data-id="{{$row->switch_reference}}">
                                </div>
                            </td>
                            <td>{{$row['customer_number']}}</td>
                            <td>{{$row['switch_reference']}}</td>
                            @if($row['status'] == "Successful")
                            <td><div class="badge badge-light-success fw-bold">{{$row['status']}}</div></td>
                            @elseif($row['status'] == "Pending")
                                <td><div class="badge badge-light-warning fw-bold">{{$row['status']}}</div></td>
                            @elseif($row['status'] == "Failed")
                                <td><div class="badge badge-light-danger fw-bold">{{$row['status']}}</div></td>
                            @elseif($row['status'] == "Submitted")
                                <td><div class="badge badge-light-primary fw-bold">{{$row['status']}}</div></td>
                            @endif
                            @if($row['new_status'] == "Successful")
                            <td><div class="badge badge-light-success fw-bold">{{$row['new_status']}}</div></td>
                            @elseif($row['new_status'] == "Pending")
                                <td><div class="badge badge-light-warning fw-bold">{{$row['new_status']}}</div></td>
                            @elseif($row['new_status'] == "Failed")
                                <td><div class="badge badge-light-danger fw-bold">{{$row['new_status']}}</div></td>
                            @elseif($row['new_status'] == "Submitted")
                                <td><div class="badge badge-light-primary fw-bold">{{$row['new_status']}}</div></td>
                            @endif
                            {{-- <td class="text-center">
                                {!! Form::open(['method' => 'POST','route' => ['admin.success.single', Crypt::encrypt($row->switch_reference)],'style'=>'display:inline']) !!}
                                {!! Form::submit('S', ['class' => 'btn btn-success btn-border btn-sm rounded-2','data-toggle'=>'confirmation','data-placement'=>'left']) !!}
                                {!! Form::close() !!}

                                {!! Form::open(['method' => 'POST','route' => ['admin.failed.single', Crypt::encrypt($row->switch_reference)],'style'=>'display:inline']) !!}
                                {!! Form::submit('F', ['class' => 'btn btn-danger btn-border btn-sm','data-toggle'=>'confirmation','data-placement'=>'left']) !!}
                                {!! Form::close() !!}
                            </td> --}}
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

        $('.verify-all').on('click', function(e) {
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
                    var redirect = "{{ url('manager/paydrc/transaction/verify') }}";
                    $.ajax({
                        url: "{{ url('manager/verify-select-ids') }}",
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
                                toastr.success(data['message'], 'Success Alert', {
                                timeOut: 600
                                });
                                // location.reload();
                                // $('.table').load(document.URL +  ' .table');
                            }
                            else if (data['status']== "verify") {
                                toastr.success(data['message'], 'Success Alert', {
                                timeOut: 600
                                });
                                // location.reload();
                                // $('.table').load(document.URL +  ' .table');
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
                        url: "",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                                location.reload();
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
    url: "{{route('manager.transaction.verify.upload')}}", // Set the url for your upload script location
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
    toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {
              timeOut: 600
            });
    // location.reload();
    
});


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