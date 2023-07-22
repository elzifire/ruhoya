@extends("layouts.BE.master", ["breadcrumb" => ["Home", "Hoya"]])
@section("title", "Hoya")
@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="flex gap-1">
                        <button type="button" class="btn btn-primary btn-label" onclick="openForm('{{url('/hoya/create')}}', 'create', 'lg')">
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
                                <th>Nama Lokal</th>
                                <th>Daerah Asal</th>
                                <th>Author</th>
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
        var API_URL = "{{ url('/hoya/api') }}";

        $("[data-menu-url='hoya']").addClass("active");

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
                    {data: 'local_name', name: 'local_name'},
                    {data: 'origin', name: 'origin'},
                    {data: 'author', name: 'author'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            $("[data-refresh-btn]").click(function(e) {
                e.preventDefault();
                
                toastAlert("info", "Memperbarui data");
                dt.ajax.reload();
            });

            $(document).on("click", "[data-btn-add-images]", function() {
                var count = $("[data-image-inputs] tr:last-child").data("index") + 1;

                var tr = document.createElement("tr");
                tr.dataset.index = count;

                var tdImage = document.createElement("td");
                var tdDescription = document.createElement("td");
                var tdAction = document.createElement("td");

                tdImage.classList.add("align-middle");
                tdDescription.classList.add("align-middle");
                tdAction.classList.add("align-middle");

                var inputFile = document.createElement("input");
                inputFile.type = "file";
                inputFile.classList.add("form-control");
                inputFile.name = `hoya_images[${count}][file]`;
                inputFile.accept = "image/*";

                var inputDescription = document.createElement("input");
                inputDescription.type = "text";
                inputDescription.classList.add("form-control");
                inputDescription.name = `hoya_images[${count}][description]`;

                var actionBtn = document.createElement("button");
                actionBtn.type = "button";
                actionBtn.classList.add("btn", "btn-danger", "btn-sm");
                actionBtn.innerHTML = `<i class="bx bx-trash align-middle"></i>`;
                actionBtn.addEventListener("click", function() { $(`[data-image-inputs] > [data-index="${count}"]`).remove(); })

                tdImage.append(inputFile);
                tdDescription.append(inputDescription);
                tdAction.append(actionBtn);

                tr.append(tdImage, tdDescription, tdAction);
                $("[data-image-inputs]").append(tr);
            });

             $(document).on("click", "[data-btn-add-spreads]", function() {
                var count = $("[data-spread-inputs] tr:last-child").data("index") + 1;

                var tr = document.createElement("tr");
                tr.dataset.index = count;

                var tdDescription = document.createElement("td");
                var tdLatitude = document.createElement("td");
                var tdLongitude = document.createElement("td");
                var tdAction = document.createElement("td");

                tdDescription.classList.add("align-middle");
                tdLatitude.classList.add("align-middle");
                tdLongitude.classList.add("align-middle");
                tdAction.classList.add("align-middle");

                var inputDescription = document.createElement("input");
                inputDescription.type = "text";
                inputDescription.classList.add("form-control");
                inputDescription.name = `hoya_spreads[${count}][description]`;

                var inputLatitude = document.createElement("input");
                inputLatitude.type = "text";
                inputLatitude.classList.add("form-control");
                inputLatitude.name = `hoya_spreads[${count}][latitude]`;

                var inputLongitude = document.createElement("input");
                inputLongitude.type = "text";
                inputLongitude.classList.add("form-control");
                inputLongitude.name = `hoya_spreads[${count}][longitude]`;

                var actionBtn = document.createElement("button");
                actionBtn.type = "button";
                actionBtn.classList.add("btn", "btn-danger", "btn-sm");
                actionBtn.innerHTML = `<i class="bx bx-trash align-middle"></i>`;
                actionBtn.addEventListener("click", function() { $(`[data-spread-inputs] > [data-index="${count}"]`).remove(); })

                tdDescription.append(inputDescription);
                tdLatitude.append(inputLatitude);
                tdLongitude.append(inputLongitude);
                tdAction.append(actionBtn);

                tr.append(tdDescription, tdLatitude, tdLongitude, tdAction);
                $("[data-spread-inputs]").append(tr);
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