function bukaModalPenolakan(event, idPengajuan) {
    event.preventDefault();

    const button = event.currentTarget;
    const route = button.getAttribute("data-route");

    // tutup modal detail
    $("#modalDetail-" + idPengajuan).modal("hide");

    // set action form
    $("#formPenolakan").attr("action", route);

    // reset textarea
    $("#inputAlasan").val("");

    // buka modal penolakan
    setTimeout(function () {
        $("#modalPenolakan").modal("show");
    }, 300);
}

function setujuiPengajuan(event, idPengajuan) {
    event.preventDefault();

    const button = event.currentTarget;
    const route = button.getAttribute("data-route");

    const form = document.createElement("form");
    form.method = "POST";
    form.action = route;

    // CSRF token
    const csrf = document.createElement("input");
    csrf.type = "hidden";
    csrf.name = "_token";
    csrf.value = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content") || "";
    form.appendChild(csrf);

    document.body.appendChild(form);

    Swal.fire({
        title: "Konfirmasi Persetujuan",
        text: "Apakah Anda yakin ingin menyetujui pengajuan surat ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, Setujui!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Memproses...",
                text: "Mohon tunggu",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
            form.submit();
        }
    });
}

function confirmDelete(arg1, arg2) {
    let id = arg2 !== undefined ? arg2 : arg1;
    let form = null;

    if (typeof arg1 === "object" && arg1 !== null) {
        if (arg1.preventDefault) arg1.preventDefault();
        const btn = arg1.currentTarget || arg1.target;
        if (btn) form = btn.closest("form");
    }

    if (!form && id) {
        form = document.getElementById("deleteForm-" + id);
    }

    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data pengajuan surat ini akan dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Menghapus...",
                text: "Mohon tunggu",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            if (form) {
                form.submit();
            }
        }
    });
}
