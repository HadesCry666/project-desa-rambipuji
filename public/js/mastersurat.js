$(document).ready(function () {
    // =========================
    // BTN TAMBAH
    // =========================
    $("#btnTambahSurat").on("click", function () {
        const idSuratBaru = $(this).data("id_surat");

        // reset form
        $("#formSurat")[0].reset();

        // reset container berkas
        $("#containerBerkas").html("");

        // reset jumlah berkas
        jumlahBerkas = 0;

        // set form
        $("#formSurat").attr("action", $("#formSurat").data("store-url"));

        $("#formMethod").val("POST");

        // isi input
        $("#inputIdSurat").val(idSuratBaru);

        // title modal
        $("#modalTitle").text("Tambah Surat");

        // tampil modal
        $("#modalForm").modal("show");
    });

    // =========================
    // BTN EDIT
    // =========================
    $(document).on("click", ".btnEditSurat", function () {
        const action = $(this).data("action");
        const id = $(this).data("id");
        const nama = $(this).data("nama");
        const ket = $(this).data("keterangan");
        const slug = $(this).data("slug");

        // reset container berkas
        $("#containerBerkas").html("");
        jumlahBerkas = 0;

        // set form
        $("#formSurat").attr("action", action);
        $("#formMethod").val("PUT");

        // isi data
        $("#inputIdSurat").val(id);
        $("#inputNamaSurat").val(nama);
        $("#inputKetSurat").val(ket);
        $("#slug").val(slug);

        // =========================
        // LOAD BERKAS
        // =========================
        for (let i = 1; i <= 8; i++) {
            let value = $(this).data("berkas" + i);

            if (value !== undefined && value !== null && value !== "") {
                jumlahBerkas++;

                $("#containerBerkas").append(`
                    <div class="mb-3 d-flex justify-content-between align-items-end item-berkas">
                        <div style="width: 82%;">
                            <label>
                                Berkas ${jumlahBerkas}
                            </label>
                            <input type="text"
                                   name="berkas${jumlahBerkas}"
                                   class="form-control"
                                   value="${value}"
                                   placeholder="Contoh: KTP">
                        </div>
                        <div style="width: 15%;">
                            <button type="button"
                                    class="btn btn-danger btnHapus w-100">
                                Hapus
                            </button>
                        </div>
                    </div>
                `);
            }
        }

        // title modal
        $("#modalTitle").text("Edit Surat");

        // show modal
        $("#modalForm").modal("show");
    });

    // =========================
    // BTN HAPUS DATA
    // =========================
    $(document).on("click", ".btnDeleteSurat", function (e) {
        e.preventDefault();

        const $btn = $(this);
        const $form = $btn.closest("form");
        const nama = $btn.attr("data-nama") || $btn.data("nama") || "";

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data surat " + nama + " akan dihapus!",
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

    // =========================
    // SEARCH AUTO SUBMIT
    // =========================
    let timeout = null;

    $("#searchInput").on("input", function () {
        clearTimeout(timeout);

        timeout = setTimeout(function () {
            $("#searchForm").submit();
        }, 500);
    });
});