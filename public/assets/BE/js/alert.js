function toastAlert(icon, msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });

    Toast.fire({
        icon: icon,
        title: msg,
    });
}

function loadingAlert(text = "Memuat data") {
    return Swal.fire({
        title: "Harap Tunggu",
        text: text,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
}
