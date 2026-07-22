$(document).ready(function () {
    // ================= TOGGLE =================
    function toggleKitap() {
        let kewarganegaraan = $('select[name="kewarganegaraan"]').val();
        let noKitap = $('input[name="no_kitap"]');

        if (kewarganegaraan === "WNI") {
            noKitap.val("").prop("disabled", true);
        } else if (kewarganegaraan === "WNA") {
            noKitap.prop("disabled", false);
        } else {
            noKitap.val("").prop("disabled", true);
        }
    }

    function toggleTanggalKawin() {
        let status = $('select[name="status_perkawinan"]').val();
        let tanggal = $('input[name="tanggal_perkawinan"]');

        if (status === "KAWIN") {
            tanggal.prop("disabled", false);
        } else {
            tanggal.val("").prop("disabled", true);
        }
    }

    // ================= INIT SELECTRIC =================
    if ($.fn.selectric) {
        $(".selectric").selectric();
    }

    // ================= INIT STATE =================
    toggleKitap();
    toggleTanggalKawin();

    // ================= EVENT CHANGE =================
    $('select[name="kewarganegaraan"]').on("change", toggleKitap);
    $('select[name="status_perkawinan"]').on("change", toggleTanggalKawin);

    // ================= TAMBAH DATA =================
    $(document).on("click", "#btnTambahPenduduk", function (e) {
        e.preventDefault();

        $("#anggotaForm")[0].reset();
        $("#formMethod").val("POST");
        $("#anggotaForm").attr("action", "/admin/master_penduduk/masuk");
        $("#exampleModalLabel").text("Tambah Anggota Keluarga");
        $('[name="nik"]').prop("readonly", false);

        if ($.fn.selectric) {
            $("select").selectric("refresh");
        }

        toggleKitap();
        toggleTanggalKawin();

        $("#exampleModal").modal("show");
    });

    // ================= EDIT DATA =================
    $(document).on("click", ".btn-edit", function (e) {
        e.preventDefault();

        const $btn = $(this).closest(".btn-edit");
        const nik = $btn.attr("data-nik") || $btn.data("nik");

        $("#exampleModalLabel").text("Edit Anggota Keluarga");
        $("#anggotaForm").attr("action", "/admin/master_penduduk/" + nik);
        $("#formMethod").val("PUT");

        $('[name="nik"]').val(nik).prop("readonly", true);
        $('[name="nama_lengkap"]').val($btn.attr("data-nama_lengkap") || $btn.data("nama_lengkap") || "");
        $('[name="tempat_lahir"]').val($btn.attr("data-tempat_lahir") || $btn.data("tempat_lahir") || "");
        $('[name="tanggal_lahir"]').val($btn.attr("data-tanggal_lahir") || $btn.data("tanggal_lahir") || "");

        $('[name="jenis_kelamin"]').val($btn.attr("data-jenis_kelamin") || $btn.data("jenis_kelamin") || "");
        $('[name="agama"]').val($btn.attr("data-agama") || $btn.data("agama") || "");
        $('[name="pendidikan"]').val($btn.attr("data-pendidikan") || $btn.data("pendidikan") || "");
        $('[name="pekerjaan"]').val($btn.attr("data-pekerjaan") || $btn.data("pekerjaan") || "");
        $('[name="golongan_darah"]').val($btn.attr("data-golongan_darah") || $btn.data("golongan_darah") || "");

        $('[name="tanggal_perkawinan"]').val($btn.attr("data-tanggal_perkawinan") || $btn.data("tanggal_perkawinan") || "");
        $('[name="no_paspor"]').val($btn.attr("data-no_paspor") || $btn.data("no_paspor") || "");
        $('[name="no_kitap"]').val($btn.attr("data-no_kitap") || $btn.data("no_kitap") || "");
        $('[name="nama_ayah"]').val($btn.attr("data-nama_ayah") || $btn.data("nama_ayah") || "");
        $('[name="nama_ibu"]').val($btn.attr("data-nama_ibu") || $btn.data("nama_ibu") || "");

        $('[name="status_perkawinan"]').val($btn.attr("data-status_perkawinan") || $btn.data("status_perkawinan") || "");
        $('[name="status_keluarga"]').val($btn.attr("data-status_keluarga") || $btn.data("status_keluarga") || "");
        $('[name="kewarganegaraan"]').val($btn.attr("data-kewarganegaraan") || $btn.data("kewarganegaraan") || "");

        if ($.fn.selectric) {
            $("select").selectric("refresh");
        }

        toggleTanggalKawin();
        toggleKitap();

        $("#exampleModal").modal("show");
    });

    // ================= DELETE =================
    $(document).on("click", ".btndeletependuduk", function (e) {
        e.preventDefault();

        const $btn = $(this).closest(".btndeletependuduk");
        const $form = $btn.closest("form");
        const nama = $btn.attr("data-nama_lengkap") || $btn.data("nama_lengkap") || "penduduk ini";

        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: 'Data penduduk atas nama "' + nama + '" akan dihapus!',
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
