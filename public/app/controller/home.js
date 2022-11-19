var CtrlHome = function(){
    return {
        init: function(){
            var id = 0;
            $('.action-delete').submit(function(event){
                event.preventDefault();
                id = $(this).find('input').val();
                $('#modalHapus .modal-body p').html(`Yakin ingin menghapus nota ?`)
                $("#modalHapus").modal('show');
            });

            $("#modalHapus form").submit(function(event){
                event.preventDefault();
                CtrlHome.onDelete(id);
            });
        },
        onDelete: function(id){
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: globalPath + '/nota/' + id,
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_method"  : "delete"
                },
                success: function (result) {
                    window.location.reload();
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

CtrlHome.init();