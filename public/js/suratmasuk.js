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
        .getAttribute("content");
    form.appendChild(csrf);

    document.body.appendChild(form);
    form.submit();
}

function confirmDelete(id) {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
            // Jika klik "Hapus" atau timer habis, kirim form untuk delete
            document.getElementById("deleteForm-" + id).submit();
        }
    });
}
