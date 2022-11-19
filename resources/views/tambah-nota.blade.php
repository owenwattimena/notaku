@extends('templates.index')

@section('style')
<style>
    .list-group {
        /* max-width: 460px; */
        /* margin: 4rem auto; */
    }

    .form-check-input:checked+.form-checked-content {
        opacity: .5;
    }

    .form-check-input-placeholder {
        border-style: dashed;
    }

    [contenteditable]:focus {
        outline: 0;
    }

    .list-group-checkable .list-group-item {
        cursor: pointer;
    }

    .list-group-item-check {
        position: absolute;
        clip: rect(0, 0, 0, 0);
    }

    .list-group-item-check:hover+.list-group-item {
        background-color: var(--bs-light);
    }

    .list-group-item-check:checked+.list-group-item {
        color: #fff;
        background-color: var(--bs-blue);
    }

    .list-group-item-check[disabled]+.list-group-item,
    .list-group-item-check:disabled+.list-group-item {
        pointer-events: none;
        filter: none;
        opacity: .5;
    }

    .list-group-radio .list-group-item {
        cursor: pointer;
        border-radius: .5rem;
    }

    .list-group-radio .form-check-input {
        z-index: 2;
        margin-top: -.5em;
    }

    .list-group-radio .list-group-item:hover,
    .list-group-radio .list-group-item:focus {
        background-color: var(--bs-light);
    }

    .list-group-radio .form-check-input:checked+.list-group-item {
        background-color: var(--bs-body);
        border-color: var(--bs-blue);
        box-shadow: 0 0 0 2px var(--bs-blue);
    }

    .list-group-radio .form-check-input[disabled]+.list-group-item,
    .list-group-radio .form-check-input:disabled+.list-group-item {
        pointer-events: none;
        filter: none;
        opacity: .5;
    }

</style>

@endsection

@section('content')
<div class="py-5">
    <h2>Tambah Nota</h2>
    <p class="lead">Dibawah ini adalah form untuk memasukan data nota.</p>
    <hr>
</div>
<form class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="nama_toko" class="form-label">Nama Toko</label>
        <textarea type="text" class="form-control" id="nama_toko" name="nama_toko" required></textarea>
        <div class="invalid-feedback">
            Tidak boleh kosong
        </div>
    </div>
    <div class="mb-3">
        <label for="alamat_toko" class="form-label">Keterangan</label>
        <textarea type="text" class="form-control" id="alamat_toko" name="alamat_toko" required></textarea>
        <div class="invalid-feedback">
            Tidak boleh kosong
        </div>
    </div>
    <div class="mb-3">
        <label for="kasir" class="form-label">Kasir</label>
        <input type="text" class="form-control" id="kasir" name="kasir" required>
        <div class="invalid-feedback">
            Tidak boleh kosong
        </div>
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        <div class="invalid-feedback">
            Tidak boleh kosong
        </div>
    </div>
    <div class="mb-3">
        <label for="jam" class="form-label">Jam</label>
        <input type="time" class="form-control" id="jam" name="jam" required>
        <div class="invalid-feedback">
            Tidak boleh kosong
        </div>
    </div>
    <div class="mb-3">
        <label for="tunai" class="form-label">Tunai</label>
        <input type="number" class="form-control" id="tunai" name="tunai" required>
        <div class="invalid-feedback">
            Tidak boleh kosong
        </div>
    </div>
    <div class="mb-3">
        <label for="footer" class="form-label">Catatan Kaki</label>
        <textarea type="text" class="form-control" id="footer" name="footer" required></textarea>
        <div class="invalid-feedback">
            Tidak boleh kosong
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Buat nota</button>
</form>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="{{ asset('app/config.js') }}"></script>
    <script src="{{ asset('app/controller/tambah_nota.js') }}"></script>
@endsection
