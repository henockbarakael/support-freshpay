
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
							<th class="min-w-80px">Nom du contact</th>
                            <th class="min-w-80px">E-mail</th>
                            <th class="min-w-80px">Type de contact</th>
                            <th class="min-w-80px text-center">Action</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold">
                        <!--begin::Table row-->
                        @if($contacts)

                        <?php $count = 0 ?>

                        @foreach ($contacts as $i => $contact)

                        <tr class="text-start">
                            <td id="contact_name">
                                {{ $contact->business_name ?: $contact->first_name . ' ' . $contact->surname }}
                                <input type="hidden" name="contact_id[]" value="{{ $contact->id }}" readonly/>
                            </td>
                            <td>
                                <input type="text" name="email_address[]" value="{{ $contact->email_address }}" placeholder="Email Address" class="form-control"/>
                            </td>
                            <td>
                                <input type="text" name="contact_number[]" value="{{ $contact->contact_number }}" placeholder="Contact Number" class="form-control"/>
                            </td>
                            <td >

                                <select name="contact_type[]" class="form-control" >

                                    <option value="" selected>Select Contact Type</option>

                                    <option value="Manager" {{ $contact->type == 'Manager' ? 'selected' : '' }}>Manager</option>

                                    <option value="Provider" {{ $contact->type == 'Provider' ? 'selected' : '' }}>Provider</option>

                                    <option value="Delivery" {{ $contact->type == 'Delivery' ? 'selected' : '' }}>Delivery</option>

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
    {{-- <script type="text/javascript">
        $(document).ready(function () {
            $('.update-all').on('click', function(e) {
                var contact_id = $("input[name=contact_id]").val();
                var email_address = $("input[name=email_address]").val();
                var contact_number = $("input[name=contact_number]").val();
                var contact_type = $("input[name=contact_type]").val();
                    $.ajax({
                            url: "{{ url('admin/update-all') }}",
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                contact_id:contact_id, 
                                email_address:email_address, 
                                contact_number:contact_number, 
                                contact_type:contact_type
                            },
                            success: function (data) {
                                if (data['status']==true) {
                                    toastr.success(data['message'], 'Success Alert', {
                                    timeOut: 600
                                    });
                                    alert(data['message']);
                                    // $("#kt_post").html(data.view);
                                } 
                                else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                    });
            });
    
        });
    </script> --}}