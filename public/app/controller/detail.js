var CtrlDetail = function () {
    return {
        init: function () {
            var id = $("#id").val();
            const forms = document.querySelectorAll('.needs-validation');

            CtrlDetail.loadDetailItem(id);
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    event.preventDefault()
                    if (!form.checkValidity()) {
                        event.stopPropagation();
                        form.classList.add('was-validated')
                        return;
                    }
                    CtrlDetail.submitForm(id);
                }, false)
            });

            $('.btn-tambah').click(function(){
                CtrlDetail.onBtnTambahClick();
            });

            $("#modalHapus form").submit(function(event){
                event.preventDefault();
                CtrlDetail.deleteItem(id);
            });

            $("#unduhModal .list-group-item").hover(
                function(){
                    $(this).addClass('active');
                },
                function(){
                    $(this).removeClass('active').animate();
                },
            )
        },
        setItem: function (data) {
            var elementUlItem = $("#item");
            var total = 0;
            html = ``;
            data.forEach(item => {
                total += (item.kuantitas * item.harga) - item.diskon;
                var template = `
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">${item.barang}</h6>
                    <small class="text-muted">${onextConf.numberFormat(item.kuantitas)} x Rp. ${onextConf.numberFormat(item.harga)}</small>
                    ${ item.diskon > 0 ? '<small class="text-muted d-block">Disc. ' + item.diskon + ' </small>' : ''}
                </div>
                <span class="text-muted">Rp. ${onextConf.numberFormat((item.kuantitas * item.harga) - item.diskon)}
                <button type="button" class="btn btn-link btn-xs dropdown-toggle float-end" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </button>
                <ul class="dropdown-menu gap-1 p-2 rounded-3 mx-0 shadow w-220px dropdown-menu-lg-end">
                    <li>
                        <button class="dropdown-item rounded-2 py-2 btn-ubah" data-id='${item.id}' data-barang='${item.barang}' data-kuantitas='${item.kuantitas}' data-harga='${item.harga}' data-diskon='${item.diskon}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        Ubah
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item rounded-2 py-2 text-danger btn-hapus" data-id='${item.id}' data-barang='${item.barang}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        Hapus
                        </button>
                    </li>
                </ul>
                </span>
            </li>

                `;
                html += template;
            });
            if(html == ``)
            {
                html = "Tidak ada data."
            }
            elementUlItem.html(html);
            $('#total').text("Rp. " + onextConf.numberFormat(total));

            $(".btn-ubah").click(function(){
                var id = $(this).data('id');
                var barang = $(this).data('barang');
                var harga = $(this).data('harga');
                var kuantitas = $(this).data('kuantitas');
                var diskon = $(this).data('diskon');
                CtrlDetail.onBtnUbahClick(id, barang, harga, kuantitas, diskon)
            })
            $(".btn-hapus").click(function(){
                var id = $(this).data('id');
                var barang = $(this).data('barang');
                $('#id_detail_hapus').val(id)
                $('#modalHapus .modal-body p').html(`Yakin ingin menghapus <b>${barang}</b> ?`)
                $("#modalHapus").modal('show');
            })
        },
        onBtnTambahClick : function(){
            $("#id_detail").val(0);
            $("#barang").val('');
            $("#harga").val('');
            $("#kuantitas").val('');
            $("#diskon").val('');
            $(".modal-title").text("Tambah Item Barang");
            $('#staticBackdrop button[type="submit"]').text('Tambah');
        },
        onBtnUbahClick : function(id, barang, harga, kuantitas, diskon) {
            $("#id_detail").val(id);
            $("#barang").val(barang);
            $("#harga").val(harga);
            $("#kuantitas").val(kuantitas);
            $("#diskon").val(diskon);
            $(".modal-title").text("Ubah");
            $('#staticBackdrop button[type="submit"]').text('Ubah');
            $("#staticBackdrop").modal('show');
        },
        loadDetailItem: function (id) {
            $("#item").LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: globalPath + '/nota/' + id + '/item',
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    $("#item").LoadingOverlay("hide");
                    CtrlDetail.setItem(result.data);
                },
                error: function (erors) {
                    $("#item").LoadingOverlay("hide");
                    var response = erors.responseJSON;
                    console.log(response)
                    alert('Error Connection ..');
                }
            });
        },
        submitForm: function (id) {
            $.LoadingOverlay("show");
            var idDetail = $("#id_detail").val();
            var namaBarang = $("#barang").val();
            var harga = $("#harga").val();
            var kuantitas = $("#kuantitas").val();
            var diskon = $("#diskon").val();

            $.ajax({
                type: "POST",
                url: globalPath + '/nota/' + id,
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id_detail": idDetail,
                    "barang": namaBarang,
                    "harga": harga,
                    "kuantitas": kuantitas,
                    "diskon": diskon
                },
                success: function (result) {
                    $("#staticBackdrop").modal('hide');
                    $.LoadingOverlay("hide");
                    CtrlDetail.loadDetailItem(id);
                },
                error: function (erors) {
                    $.LoadingOverlay("hide");
                    var response = erors.responseJSON;
                    console.log(response)
                    alert('Error Connection ..');
                }
            });
        },
        deleteItem : function(id){
            $.LoadingOverlay("show");

            var action = $('#modalHapus form').attr('action');
            var id_detail = $('#id_detail_hapus').val();
            $.ajax({
                type: "POST",
                url: action,
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id_detail": id_detail,
                    "_method"  : "delete"
                },
                success: function (result) {
                    $.LoadingOverlay("hide");
                    $("#modalHapus").modal('hide');
                    CtrlDetail.loadDetailItem(id);
                },
                error: function (erors) {
                    $.LoadingOverlay("hide");
                    var response = erors.responseJSON;
                    console.log(response)
                    alert('Error Connection ..');
                }
            });
        }
    }
}();

CtrlDetail.init();