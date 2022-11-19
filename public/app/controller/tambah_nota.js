var CtrlTambahNota = function(){
    return {
        init : function(){
            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    event.preventDefault()
                    if (!form.checkValidity()) {
                        event.stopPropagation();
                        form.classList.add('was-validated')
                        return;
                    }
                    CtrlTambahNota.submitForm();
                }, false)
            });
        },
        submitForm: function () {
            $.LoadingOverlay("show");
            var namaToko = $("#nama_toko").val();
            var alamatToko = $("#alamat_toko").val();
            var kasir = $("#kasir").val();
            var tanggal = $("#tanggal").val();
            var jam = $("#jam").val();
            var tunai = $("#tunai").val();
            var footer = $("#footer").val();
            $.ajax({
                type: "POST",
                url: globalPath + '/nota',
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "nama_toko" : namaToko,
                    "alamat" : alamatToko,
                    "kasir" : kasir,
                    "tanggal" : tanggal,
                    "jam" : jam,
                    "tunai" : tunai,
                    "footer" : footer,
                },
                success: function (result) {
                    console.log(result)
                    window.location = globalPath + '/nota/' + result.data.id;
                },
                error: function(erors){
                    var response = erors.responseJSON;
                    console.log(response)
                    $.LoadingOverlay("hide");
                    alert('Error Connection ..');
                }
            });
        }
    }
}();

CtrlTambahNota.init();