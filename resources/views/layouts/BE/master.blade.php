<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>@yield('title') | {{env("APP_NAME")}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @includeIf('layouts.BE.partials.css')
</head>

<body>

<div id="layout-wrapper">

    @includeIf('layouts.BE.partials.header')
        @includeIf('layouts.BE.partials.sidebar')
        
        <div class="vertical-overlay"></div>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@yield('title')</h4>
                                <div class="page-title-right">
                                    @includeIf("components.breadcrumb", compact("breadcrumb"))
                                </div>

                            </div>
                        </div>
                    </div>

                    @yield('content')

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            {{date("Y")}} © {{env("APP_NAME")}}.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-modal>
        <div class="modal-dialog" role="document" data-modal-dialog>
            <div class="modal-content" data-modal-content>
                <div class="modal-header">
                    <h5 class="modal-title" data-modal-title></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" data-modal-body></div>
            </div>
        </div>
    </div>

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    @includeIf('layouts.BE.partials.js')

    <script>
        var formModal;
        
        document.querySelector("[data-modal]").addEventListener("hidden.bs.modal", function() {
            document.querySelector("[data-modal-title]").innerText = "";
            document.querySelector("[data-modal-body]").innerHTML = "";
        });
        
        $(document).on("submit", "form", function () {
            $(".form-control").removeClass("is-invalid");
            $(".invalid-feedback").remove();
        });
        
        function populateErrorMessage(errors) {
            console.log(errors)
            var ObjToArray = Object.entries(errors);
            ObjToArray.forEach((value) => {
                var input = $(`[name='${value[0]}']`);
                var feedback = `<div class='invalid-feedback'>${value[1][0]}</div>`;
                

                if (input.length > 1) {
                    $(`[data-input='${value[0]}']`).append(`<p class='d-block invalid-feedback text-danger' style='margin-top: 0.25rem; font-size: 0.875em'>${value[1][0]}</p>`);
                } else {
                    input.addClass("is-invalid");
                    input.after(feedback);
                }
            });
        }
        
        $(document).on("input", ".numeric", function() {
            this.value = this.value.replace(/\D/g,'');
        });
        
        function openForm(url, type = "create", size = "default") {
            var title = {
                create: "Tambah Data",
                edit: "Edit Data",
                detail: "Detail Data",
                import: "Import Data",
            };
            
            var modalTitle  = title[type] || type;
            
            $(".modal-dialog").removeClass(`modal-xl`);
            if (size != "default") $("[data-modal] > .modal-dialog").addClass(`modal-${size}`)

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("[data-modal-title]").text(modalTitle);
                    $("[data-modal-body]").html(response);
                    formModal = new bootstrap.Modal(document.querySelector("[data-modal]"), {});
                    formModal.show();
                },
                error: function(reject) {
                    toastAlert("error", "Terjadi kesalahan pada server");
                    console.log(reject)
                }
            })
        }
        
        function deleteAlert(url) {
            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                text: "Kamu tidak bisa mengembalikan data ini lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (!result.isConfirmed) return;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        if (response.status_code == 500) return toastAlert("error", response.message);
                        
                        toastAlert("success", response.message);
                        dt.ajax.reload();
                    },
                    error: function(reject) {
                        toastAlert("error", "Terjadi kesalahan pada server");
                    }
                })
            })
        }
    </script>
</body>
</html>