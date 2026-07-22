$(document).ready(function () {
    // =========================
    // SEARCH AUTO SUBMIT
    // =========================
    const searchInput = document.getElementById("searchInput");
    const searchForm = document.getElementById("searchForm");

    if (searchInput) {
        let timeout = null;
        searchInput.addEventListener("input", function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });
    }

    let modal = $("#modal");

    // =========================
    // INIT SELECT2 SAAT MODAL DIBUKA
    // =========================
    modal.on("shown.bs.modal", function () {
        if ($("#nama").hasClass("select2-hidden-accessible")) {
            $("#nama").select2("destroy");
        }

        $("#nama").select2({
            placeholder: "Pilih Nama Ketua RT",
            width: "100%",
            dropdownParent: modal,
            minimumResultsForSearch: 0,
        });

        // =========================
        // RESTORE OLD VALUE (VALIDASI GAGAL)
        // =========================
        let oldNama = $("#nama").data("old");
        if (oldNama) {
            $("#nama").val(oldNama).trigger("change");
        }
    });

    // =========================
    // AUTO FOCUS SEARCH SELECT2
    // =========================
    $(document).on("select2:open", function () {
        setTimeout(() => {
            document.querySelector(".select2-search__field")?.focus();
        }, 0);
    });

    // =========================
    // AUTO ISI NIK & RW
    // =========================
    $(document).on("change", "#nama", function () {
        let selected = $(this).find(":selected");
        let nikVal = selected.attr("data-nik") || selected.data("nik");
        if (nikVal) $("#nik").val(nikVal);

        let rwVal = selected.attr("data-rw") || selected.data("rw");
        if (rwVal) $("#rw").val(rwVal);

        let rtVal = selected.attr("data-rt") || selected.data("rt");
        if (rtVal) $("#rt").val(rtVal);
    });

    // =========================
    // BTN TAMBAH
    // =========================
    $(document).on("click", "#btnTambah", function () {
        $("#modalTitle").text("Tambah Akun Ketua RT");
        $("#modalForm").find('[name="_method"]').remove();
        $("#modalForm")[0].reset();

        $("#nama").val(null).trigger("change");

        modal.modal("show");
    });

    // =========================
    // BTN EDIT
    // =========================
    $(document).on("click", ".btn-edit", function () {
        const $btn = $(this).closest(".btn-edit");
        var id_rtrw = $btn.attr("data-id_rtrw") || $btn.data("id_rtrw");
        var nik = $btn.attr("data-nik") || $btn.data("nik");
        var nama = $btn.attr("data-nama") || $btn.data("nama");
        var no_hp = $btn.attr("data-no_hp") || $btn.data("no_hp");
        var rw = $btn.attr("data-rw") || $btn.data("rw");
        var rt = $btn.attr("data-rt") || $btn.data("rt");
        var updateUrl = $btn.attr("data-url") || $btn.data("url");

        $("#modalTitle").text("Edit Akun Ketua RT");
        $("#modalForm").attr("action", updateUrl);

        $("#modalForm").find('[name="_method"]').remove();
        $("#modalForm").append(
            '<input type="hidden" name="_method" value="PUT">',
        );

        $("#id_rtrw").val(id_rtrw);
        $("#nik").val(nik);
        $("#no_hp").val(no_hp);
        $("#rw").val(rw);
        $("#rt").val(rt);

        modal.modal("show");

        setTimeout(() => {
            if (nama) {
                $("#nama").val(nama).trigger("change.select2");
            }
        }, 200);
    });

    // =========================
    // DELETE CONFIRM
    // =========================
    $(document).on("click", ".btndeleteAkunrw", function (e) {
        e.preventDefault();

        const $btn = $(this);
        const $form = $btn.closest("form");
        const nama = $btn.attr("data-nama") || $btn.data("nama") || "";

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: 'Data Ketua RT atas nama "' + nama + '" akan dihapus!',
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

                $form.submit();
            }
        });
    });
});
