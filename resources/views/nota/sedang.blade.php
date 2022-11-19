@php
$width = 0;
$total = 0;
if($type == 'medium')
{
$width = 201.25984251968504;
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
            width: {{ $width }}pt;
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
        .border-top{
            border-top: 1px dashed #000!important; 
        }
        pre{
            font-family: 'DotGothic16', sans-serif;
            color: #000;
            font-weight: 500;
        }

    </style>
</head>
<body>
    <div class="width mx-auto">
        <a href="#" id="unduh">Unduh</a>
    </div>
    <div id="receipt" class="receipt mx-auto">
        <div class="header text-center">
            <pre class="mb-0 pt-5">{!! $nota->nama_toko !!}</pre>
            <pre class="mb-0">{!! $nota->alamat !!}</pre>
        </div>
        <div class="info px-3 mt-2">
            <table class="w-100">
                <tr>
                    <td>
                        <pre class="d-inline">{{ $nota->tanggal }}</pre>
                        <pre class="d-inline">{{ $nota->jam }}</pre>
                        /
                        <pre class="d-inline">{{ $nota->kasir }}</pre>
                    </td>
                </tr>
            </table>
        </div>
        <div class="item px-3 mt-2">
            @foreach ($nota->item as $item)
            <table class="w-100">
                <tr>
                    <td>
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">{{ $item->barang }}</pre>
                    </td>
                    <td class="text-end" style="width: 60px">
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">{{ number_format($item->kuantitas * $item->harga) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <pre class="mb-0 d-inline col-5 text-end" style="word-wrap: break-word; overflow: hidden; padding-right:0;">{{ $item->kuantitas }}</pre>
                            <pre class="mb-0 d-inline col-1" style="word-wrap: break-word; overflow: hidden;">x</pre>
                            <pre class="mb-0 d-inline col-5" style="word-wrap: break-word; overflow: hidden;">{{ number_format($item->harga) }}</pre>
                        </div>
                    </td>
                </tr>
            </table>
        @php
        $total += ($item->kuantitas * $item->harga) - $item->diskon;
        @endphp
        @endforeach
    </div>
    <div class="total row justify-content-end px-3">
        <pre class="hr mb-0">-----------------------------------------------------------------</pre>
        
        <div class="col-8">
            <table class="w-100">
                <tr>
                    <td class="text-start w-50">
                        <pre class="mb-0" style="overflow: hidden;">TOTAL</pre>
                    </td>
                    <td class="text-center">
                        <pre class="mb-0">:</pre>
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="overflow: hidden;">{{ number_format($total) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">
                        <pre class="mb-0" style="overflow: hidden;">CASH</pre>
                    </td>
                    <td class="text-center">
                        <pre class="mb-0">:</pre>
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="overflow: hidden;">{{ number_format($nota->tunai) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">
                        <pre style="overflow: hidden;">CHANGE</pre>
                    </td>
                    <td class="text-center">
                        <pre>:</pre>
                    </td>
                    <td class="text-end">
                        <pre style="overflow: hidden;">{{ number_format($nota->tunai - $total) }}</pre>
                    </td>
                </tr>
            </table>
        </div>
        <footer class="text-center">
            <pre class="mb-0" style="overflow: hidden;">{!! $nota->footer !!}</pre>
        </footer>
    </div>
    <hr>
    </div>
    <div id="previewImg"></div>
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
