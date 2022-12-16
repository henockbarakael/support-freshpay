
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Import CSV | Database</title>
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
</head> 
@endpush
@section('content')
@section('page','Dashboard')
{!! Toastr::message() !!}
@include('sweetalert::alert')
<div class="post d-flex flex-column-fluid" id="kt_post">
<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <form name="contact-bulk-update" action="{{ url('admin/update-all') }}" method="POST">
        @csrf
    <div class="card mt-6">
        <div class="card-header border-0 pt-6">
            <div class="card-title"></div>
            <div class="card-toolbar">
                <div class="col-sm-auto">
                    <button type="submit" class="btn btn-success btn-border btn-sm">Process</button>
                </div>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 myshadow" id="kt_datatable_example">
                <thead>
                    <tr class="fw-bolder text-muted">
                        <th class="min-w-80px">Paydrc_reference</th>
                        <th class="min-w-80px">Switch_reference</th>
                        <th class="min-w-80px">Telco_reference</th>
                        <th hidden class="min-w-80px text-left">Status_description</th>
                        <th hidden class="min-w-80px text-left">Action</th>
                        <th class="min-w-80px text-left">Before</th>
                        <th class="min-w-80px text-left">Present</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                    <!--begin::Table row-->
                    @if($transactions)

                    <?php $count = 0 ?>

                    @foreach ($transactions as $i => $transaction)

                    <tr class="text-start">
                        <td id="contact_name">
                            {{ $transaction->paydrc_reference }}
                            <input type="hidden" style="height: 10px"  name="paydrc_reference[]" value="{{ $transaction->paydrc_reference }}" class="form-control" readonly/>
                        </td>
                        <td>
                            {{ $transaction->switch_reference }}
                            <input type="hidden" style="height: 10px"  name="switch_reference[]" value="{{ $transaction->switch_reference }}" class="form-control" readonly/>
                        </td>
                        <td>
                            {{ $transaction->telco_reference }}
                            <input type="hidden" style="height: 10px"  name="telco_reference[]" value="{{ $transaction->telco_reference }}"  class="form-control" readonly/>
                        </td>
                        <td hidden>
                            {{ $transaction->telco_status_description }}
                            <input type="hidden" style="height: 10px"  name="telco_status_description[]" value="{{ $transaction->telco_status_description }}" class="form-control" readonly/>
                        </td>
                        
                        <td hidden>
                            {{ $transaction->action }}
                            <input type="hidden" style="height: 10px"  name="action[]" value="{{ $transaction->action }}" class="form-control" readonly/>
                        </td>

                        <td>
                            {{ $transaction->status }}
                            <input type="hidden" style="height: 10px" value="{{ $transaction->status }}" class="form-control" readonly/>
                        </td>
                        
                        <td >
                            {{__('Failed')}}

                            <select hidden name="status[]"  class="form-control" >

                                {{-- <option value="" selected>Select Contact Type</option> --}}

                                <option value="Failed"  style="height: 10px"  {{ $transaction->type == 'Failed' ? 'selected' : '' }}>Failed</option>

                            </select>

                        </td>
                        

                    </tr> 
                    <?php $count++ ?>
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
    </form>
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

@endsection
@endsection
