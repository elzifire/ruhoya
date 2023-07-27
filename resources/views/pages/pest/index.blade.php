@extends("layouts.BE.master", ["breadcrumb" => ["Home", "Hama"]])
@section("title", "Hama")
@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="flex gap-1">
                        <button type="button" class="btn btn-primary btn-label" onclick="openForm('{{url('/admin/pest/create')}}', 'create', 'lg')">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bx bx-plus label-icon align-middle fs-16 me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    Tambah
                                </div>
                            </div>
                        </button>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-success btn-label" data-refresh-btn>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bx bx-refresh label-icon align-middle fs-16 me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                Refresh
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var dt;
        var API_URL = "{{ url('/admin/pest/api') }}";

        $("[data-menu-url='pest']").addClass("active");

        $(document).ready(function() {
            dt = $("#datatable").DataTable({
                ajax: {
                    url: API_URL,
                    type: "GET",
                },
                processing: true,
                serverSide: true,
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            $("[data-refresh-btn]").click(function(e) {
                e.preventDefault();
                
                toastAlert("info", "Memperbarui data");
                dt.ajax.reload();
            });
            
            $(document).on("submit", "form", function() {
                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    data: new FormData(this),
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $("button").attr("disabled", true);
                    },
                    success: function(response) {
                        $("button").attr("disabled", false);

                        toastAlert("success", response.message);
                        $(this).trigger("reset");
                        dt.ajax.reload();
                        formModal.hide();
                    },
                    error: function(reject) {
                        $("button").attr("disabled", false);
                        const response = reject.responseJSON ?? {};

                        if (response.status_code == 500) return toastAlert("error", response.message);
                        if (response.status_code == 422) return populateErrorMessage(response.errors);

                        toastAlert("error", "Terjadi kesalahan pada server");
                    },
                });
            });
        });
    </script>
@endpush