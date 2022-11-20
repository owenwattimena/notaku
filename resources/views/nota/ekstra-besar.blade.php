@php
$width = 0;
$total = 0;
$total_diskon = 0;
if($type == 'extra-large')
{
$width = 226.77165354330708;
}else{
die;
}
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Large Reciept</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DotGothic16&display=swap');

        body {
            background-color: rgb(214, 214, 214);
            font-size: 10pt;
        }

        .width {
            width: {{$width}}pt;
        }

        .receipt {
            background-color: whitesmoke !important;

            width: {{$width}}pt;
        }

        .hr {
            overflow: hidden;
            color: grey
        }

        .border-black {
            border-color: black;
            border-width: 0.1px !important;
        }

        .w90 {
            width: 90%;
        }

        .border-top {
            border-top: 1px dashed #000 !important;
        }

        pre {
            font-family: 'DotGothic16', sans-serif;
            color: #000;
            font-weight: 500;
        }

    </style>
</head>
<body>
    <div class="btn-unduh width mx-auto mt-3">
        <button id="unduh" class="btn btn-success w-100"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
          </svg> UNDUH</button>
    </div>
    <div id="receipt" class="receipt mx-auto mt-2">
        <div class="header text-center">
            <pre class="mb-0 pt-5">{!! $nota->nama_toko !!}</pre>
            <pre class="mb-0">{!! $nota->alamat !!}</pre>
        </div>
        <div class="info px-3">
            <pre class="hr mb-0">-----------------------------------------------------------------</pre>
            {{-- <hr class="mx-auto border-black mb-2 mt-2"> --}}
            {{-- <div style="background-color: black; height: 2px;"></div> --}}
            <table class="w-100">
                <tr>
                    <td>
                        <pre class="d-inline">Kasir</pre>
                    </td>
                    <td>
                        <pre class="d-inline">: {{ $nota->kasir }}</pre>
                    </td>
                </tr>
                <tr>
                    <td>
                        <pre class="d-inline">Tgl</pre>
                    </td>
                    <td>
                        <pre class="d-inline">: {{ $nota->tanggal }}</pre>
                        <pre class="d-inline">{{ $nota->jam }}</pre>
                    </td>
                </tr>
            </table>
            <pre class="hr mb-0">-----------------------------------------------------------------</pre>
        </div>
        <div class="item px-3">
            @foreach ($nota->item as $item)
            <table class="w-100">
                <tr>
                    <td>
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">{{ $item->barang }}</pre>
                    </td>
                </tr>
                <tr>
                    <td class="row">
                        <pre class="mb-0 d-inline col-1" style="word-wrap: break-word; overflow: hidden;">{{ $item->kuantitas }}</pre>
                        <pre class="mb-0 d-inline col-2" style="word-wrap: break-word; overflow: hidden;"></pre>
                        <pre class="mb-0 d-inline col-4" style="word-wrap: break-word; overflow: hidden;">x {{ $item->harga }}</pre>
                        <pre class="mb-0 d-inline col-5" style="word-wrap: break-word; overflow: hidden;"> = {{ number_format($item->kuantitas * $item->harga) }}</pre>
                    </td>

                </tr>
            </table>
            @php
            $total += ($item->kuantitas * $item->harga);
            $total_diskon += $item->diskon;
            @endphp
            @endforeach
        </div>
        <div class="total px-3">
            <div class="">
                <pre class="hr mb-0">-----------------------------------------------------------------</pre>
                <table class="w-100">
                    <tr>
                        <td class="row">
                            <pre class="mb-0 d-inline col-1" style="word-wrap: break-word; overflow: hidden;">{{ count($nota->item) }}</pre>
                            <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;">ITEMS</pre>
                            <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;">TOTAL</pre>
                            <pre class="mb-0 d-inline col-5" style="word-wrap: break-word; overflow: hidden;"> = {{ number_format($total) }}</pre>
                        </td>
                    </tr>
                </table>
                <pre class="hr mb-0">-----------------------------------------------------------------</pre>
            </div>
        </div>
        <div class="total px-3">
            <div class="">
                <table class="w-100">
                    <tr>
                        <td class="row">
                            <pre class="mb-0 d-inline col-1" style="word-wrap: break-word; overflow: hidden;"></pre>
                            <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;"></pre>
                            <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;">POTONGAN</pre>
                            <pre class="mb-0 d-inline col-5" style="word-wrap: break-word; overflow: hidden;"> = {{ number_format($total_diskon) }}</pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="row">
                            <pre class="mb-0 d-inline col-1" style="word-wrap: break-word; overflow: hidden;"></pre>
                            <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;"></pre>
                            <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;">TUNAI</pre>
                            <pre class="mb-0 d-inline col-5" style="word-wrap: break-word; overflow: hidden;"> = {{ number_format($nota->tunai) }}</pre>
                        </td>
                    </tr>
                </table>
                <pre class="hr mb-0">-----------------------------------------------------------------</pre>
            </div>
            <div class="row">
                <pre class="mb-0 d-inline col-1" style="word-wrap: break-word; overflow: hidden;"></pre>
                <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;"></pre>
                <pre class="mb-0 d-inline col-3" style="word-wrap: break-word; overflow: hidden;">KEMBALI</pre>
                <pre class="mb-0 d-inline col-5" style="word-wrap: break-word; overflow: hidden;"> = {{ number_format(($nota->tunai - ($total - $total_diskon))) }}</pre>
            </div>
        </div>
        <footer>
            <pre class="text-center mt-2" style="overflow: hidden;">{{ $nota->footer }}</pre>
        </footer>
        <hr>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/canvas.js') }}"></script>
    <script>
        document.getElementById("unduh").addEventListener("click", function() {
            html2canvas(document.getElementById("receipt"), {
                allowTaint: true
                , useCORS: true
            }).then(function(canvas) {
                var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                // document.getElementById("previewImg").appendChild(canvas);
                anchorTag.download = "nota.jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
        });

    </script>
</body>
</html>
