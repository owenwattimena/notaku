@php
$width = 0;
$total = 0;
$total_diskon = 0;
if($type == 'small')
{
$width = 138.89763779527559;
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
    <link rel="stylesheet" href="{{ asset('assets/css/nota.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DotGothic16&display=swap');
        body {
            background-color: rgb(214, 214, 214);
            font-size: 8pt;
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
        <div class="mx-1 header text-center pt-3">
            <pre style="overflow: hidden;" class="mb-0">{{ $nota->nama_toko }}</pre>
            <pre style="overflow: hidden;" class="mb-0">{!! $nota->alamat !!}</pre>
        </div>
        <div class="info px-1">
            <pre class="hr mb-0">=================================================================</pre>
            <table class="w-100">
                <tr>
                    <td>
                        <pre class="d-inline">Kasir</pre> 
                        :
                        <pre class="d-inline">{{ $nota->kasir }}</pre>
                    </td>
                </tr>
            </table>
            <pre class="hr mb-0">=================================================================</pre>
        </div>
        <div class="item px-1">
            @foreach ($nota->item as $item)
            <table class="w-100">
                <tr>
                    <td>
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">{{ $item->barang }}</pre>
                    </td>
                    <td>
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">{{ $item->kuantitas }}</pre>
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">{{ $item->harga }}</pre>
                    </td>
                    <td class="text-end" style="width: 60px">
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">{{ number_format($item->kuantitas * $item->harga) }}</pre>
                    </td>
                </tr>
                @if ($item->diskon > 0)
                <tr>
                    <td>
                        <pre class="mb-0" style="word-wrap: break-word; overflow: hidden;">Disc. -{{ $item->diskon }}</pre>
                    </td>
                    <td>
                    </td>
                    <td class="text-end">
                    </td>
                    <td class="text-end" style="width: 60px">
                    </td>
                </tr>
                @endif

            </table>
        @php
        $total += ($item->kuantitas * $item->harga);
        $total_diskon += $item->diskon;
        @endphp
        @endforeach
    </div>
    <div class="total row justify-content-end px-1">
        <pre class="hr mb-0">--------------------------------------</pre>
        
        <div class="col-12">
            <table class="w-100">
                <tr>
                    <td class="text-start w-50">
                        <pre class="mb-0" style="overflow: hidden;">Total Item</pre>
                    </td>
                    <td class="text-start">
                        <pre class="mb-0">{{ count($nota->item) }}</pre>
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="overflow: hidden;">{{ number_format($total) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td class="text-start w-50">
                        <pre class="mb-0" style="overflow: hidden;">Total Disc.</pre>
                    </td>
                    <td class="text-start">
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="overflow: hidden;">{{ number_format($total_diskon) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td class="text-start w-50">
                        <pre class="mb-0" style="overflow: hidden;">Total Belanja</pre>
                    </td>
                    <td class="text-start">
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="overflow: hidden;">{{ number_format($total - $total_diskon) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">
                        <pre class="mb-0" style="overflow: hidden;">Tunai</pre>
                    </td>
                    <td class="text-start">
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="overflow: hidden;">{{ number_format($nota->tunai) }}</pre>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">
                        <pre class="mb-0" style="overflow: hidden;">Kembalian</pre>
                    </td>
                    <td class="text-start">
                    </td>
                    <td class="text-end">
                        <pre class="mb-0" style="overflow: hidden;">{{ number_format(($nota->tunai - ($total - $total_diskon))) }}</pre>
                    </td>
                </tr>
            </table>
            <pre class="hr mb-0">=================================================================</pre>
            <pre class="mb-0">Tgl. {{ $nota->tanggal }} {{ $nota->jam }}</pre>
            <pre class="hr mb-0">+-----------------------------------------------------------------</pre>
        </div>
    </div>
    <div class="mx-1 header text-center">
        <pre style="overflow: hidden;" class="mb-0">{!! $nota->footer !!}</pre>
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
