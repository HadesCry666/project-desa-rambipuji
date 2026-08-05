$(document).ready(function () {
    // ================= DELETE =================
    $(document).on("click", ".btnDeleteKeluarga", function (e) {
        e.preventDefault();

        const $btn = $(this).closest(".btnDeleteKeluarga");
        const $form = $btn.closest("form");
        const nama = $btn.attr("data-nama_lengkap") || $btn.data("nama_lengkap") || "ini";

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: 'Data Kartu Keluarga atas nama "' + nama + '" akan dihapus!',
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

    $("#btnImport").on("click", function () {
        $("#file").click();
    });

    $("#file").on("change", function () {
        if (this.files.length > 0) {
            $("#importForm").submit();
        }
    });

    // ================= TAMBAH DATA =================
    $(document).on("click", "#btnTambah", function (e) {
        e.preventDefault();

        let form = $("#keluargaForm");
        if (form.length) {
            form[0].reset();
            form.find('input[name="_method"]').remove();
            form.attr("action", "/admin/master_kartukeluarga/masuk");
        }

        $("#modalKeluargaLabel").text("Tambah Data Kepala Keluarga");

        // Set nilai default lokasi Rambipuji/Jember
        $("#kode_pos").val("68152");
        $("#desa").val("Rambipuji");
        $("#kecamatan").val("Rambipuji");
        $("#kabupaten").val("Jember");
        $("#provinsi").val("Jawa Timur");

        $("#modalKeluarga").modal("show");
    });

    // ================= EDIT DATA =================
    $(document).on("click", ".btnEditKeluarga", function (e) {
        e.preventDefault();

        const $btn = $(this).closest(".btnEditKeluarga");

        let form = $("#keluargaForm");
        let no_kk = $btn.attr("data-no_kk") || $btn.data("no_kk");
        let actionUrl = "/admin/master_kartukeluarga/" + no_kk;

        form.attr("action", actionUrl);
        form.find('input[name="_method"]').remove();
        form.append('<input type="hidden" name="_method" value="PUT">');

        $("#modalKeluargaLabel").text("Edit Data Kepala Keluarga");

        $("#no_kk").val(no_kk);
        $("#nik").val($btn.attr("data-nik") || $btn.data("nik") || "");
        $("#nama_lengkap").val($btn.attr("data-nama_lengkap") || $btn.data("nama_lengkap") || "");
        $("#alamat").val($btn.attr("data-alamat") || $btn.data("alamat") || "");
        $("#rt").val($btn.attr("data-rt") || $btn.data("rt") || "");
        $("#rw").val($btn.attr("data-rw") || $btn.data("rw") || "");
        $("#kode_pos").val($btn.attr("data-kode_pos") || $btn.data("kode_pos") || "68152");
        $("#desa").val($btn.attr("data-desa") || $btn.data("desa") || "Rambipuji");
        $("#kecamatan").val($btn.attr("data-kecamatan") || $btn.data("kecamatan") || "Rambipuji");
        $("#kabupaten").val($btn.attr("data-kabupaten") || $btn.data("kabupaten") || "Jember");
        $("#provinsi").val($btn.attr("data-provinsi") || $btn.data("provinsi") || "Jawa Timur");

        $("#modalKeluarga").modal("show");
    });

    // Safe listeners
    const tglEl = document.getElementById("tanggal_dibuat");
    if (tglEl) {
        tglEl.addEventListener("focus", function (e) {
            this.showPicker && this.showPicker();
        });
    }

    const inputCari = document.getElementById("input-cari");
    if (inputCari) {
        let timeout = null;
        inputCari.addEventListener("input", function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const formCari = document.getElementById("form-cari");
                if (formCari) formCari.submit();
            }, 500);
        });
    }

    if (window.importWarning) {
        let html = `
        <div style="text-align:left;max-height:350px;overflow-y:auto">
            <p><b>${window.importWarning}</b></p>
            <ul style="padding-left:20px;">
    `;

        if (window.importErrors && window.importErrors.length > 0) {
            window.importErrors.forEach(function (error) {
                html += `<li>${error}</li>`;
            });
        }

        html += `
            </ul>
        </div>
    `;

        Swal.fire({
            icon: "warning",
            title: "Import Selesai",
            width: 750,
            html: html,
            confirmButtonText: "OK",
        });
    }
});
