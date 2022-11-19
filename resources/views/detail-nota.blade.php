@extends('templates.index')

@section('style')
<style>
    .dropdown-toggle::after {
        display: none !important;
    }
</style>
@endsection

@section('content')
<div class="py-5">
    <h2>Detail Nota</h2>
    <p class="lead"></p>

    <hr>

    <button class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#unduhModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
        </svg>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="unduhModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Lihat Nota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group w-auto mb-3">
                        <a href="{{ route('nota.preview', ['id'=> $nota->id,'type'=>'large']) }}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Nota Besar</h6>
                                    <p class="mb-0 opacity-75">Nota besar dengan ukuran 7,9 CM.</p>
                                </div>
                            </div>
                        </a>
                       
                    </div>
                    <div class="list-group w-auto mb-3">
                        <a href="{{ route('nota.preview', ['id'=> $nota->id,'type'=>'medium']) }}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Nota Sedang</h6>
                                    <p class="mb-0 opacity-75">Nota sedang dengan ukuran 7,1 CM.</p>
                                </div>
                            </div>
                        </a>
                       
                    </div>
                    <div class="list-group w-auto mb-3">
                        <a href="{{ route('nota.preview', ['id'=> $nota->id,'type'=>'small']) }}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Nota Kecil</h6>
                                    <p class="mb-0 opacity-75">Nota kecil dengan ukuran 4,9 CM.</p>
                                </div>
                            </div>
                        </a>
                       
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="list-group">
    <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
        <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0">{{ $nota->nama_toko }}</h6>
                <small>{!! $nota->alamat !!}</small>
                <p class="mb-0 opacity-75">{{ $nota->tanggal }}</p>
                <p class="mb-0 opacity-75">{{ $nota->kasir }}</p>
            </div>
            <small class="text-nowrap fw-bold text-success" id="total"></small>
        </div>
    </div>
</div>
<div class="text-end">

    <button class="btn btn-primary my-2 btn-sm btn-tambah" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-lg fw-bold" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
        </svg>
    </button>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Item Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="needs-validation" novalidate>
                    <input type="hidden" name="id" value="{{ $nota->id }}" id="id">
                    <input type="hidden" name="id_detail" value="0" id="id_detail">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="barang" class="form-label">Nama item barang</label>
                            <input type="text" class="form-control" id="barang" name="barang" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="kuantitas" class="form-label">Kuantitas</label>
                            <input type="number" class="form-control" id="kuantitas" name="kuantitas" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="text" class="form-control" id="diskon" name="diskon">
                        </div>
                    </div>
                    <div class="modal-footer flex-nowrap p-0">
                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<ul id="item" class="list-group mb-3">
    {{-- @forelse ($nota->item as $item)
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
                <h6 class="my-0">Malin Babi 50gr</h6>
                <small class="text-muted">1 x Rp. 47.000.000,-</small>
            </div>
            <span class="text-muted">Rp. 47.000.000,-</span>
        </li>
    @empty
        Belum ada item barang.
    @endforelse --}}
</ul>
<div class="modal fade" id="modalHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Item Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('nota.detail.destroy') }}">
                <input type="hidden" name="id_detail" value="0" id="id_detail_hapus">
                <div class="modal-body">
                    <p>Yakin ingin menghapus {item}</p>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none text-danger col-6 m-0 rounded-0">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<script src="{{ asset('app/config.js') }}"></script>
<script src="{{ asset('app/controller/detail.js') }}"></script>
@endsection
