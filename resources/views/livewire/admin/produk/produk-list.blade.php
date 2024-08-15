<div>
    @if (session()->has('success'))
        <div class="alert alert-success mt-4 ml-4 mr-4 col-12" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">Produk List</h5>
                    </div>
                    <div class="col-6">
                        <a wire:click="create" class="btn btn-primary float-end">Tambah Produk</a>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img class="rounded-circle" width="50" height="50"
                                    src="{{ url(Storage::url($produk->gambar)) }}"></td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td><button type="button" class="btn btn-sm btn-warning" wire:click="edit({{ $produk->id }})"><i
                                        class="bi bi-pencil-square"></i></button>
                                <button type="button" class="btn btn-sm btn-danger" wire:click='konfirm_delete({{$produk->id}})'><i
                                        class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $produks->links() }}
        </div>
    </div>

    {{-- MODAL CREATE --}}
    @if ($isOpen)
        <div class="modal show" tabindex="-1" aria-hidden="true" role ="dialog" style="display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{$produkId ? 'Edit Produk' : 'Tambah Produk' }} </h5>
                        <button wire:click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- General Form Elements -->
                        <form wire:submit={{$produkId ? 'update' : 'store'}} method="POST">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="nama_produk">
                                </div>
                            </div>

                            {{-- <input type="hidden" class="form-control"> --}}

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" wire:model="harga">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="deskripsi">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="gambar"
                                        accept="image/png, image/jpeg"><br>
                                        <div class="spinner-border text-success" wire:loading wire:target="gambar" role="status">
                                            <span class="visually-hidden"><strong>Please wait.. Uploading...<strong></span>
                                        </div>
                                </div>
                            </div>
                            <!-- End General Form Elements -->
                            <button wire:click="closeModal" type="button" class="btn btn-secondary "
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary float-end">{{$produkId ? 'Update' : 'Simpan'}}</button>
                        </form>

                    </div>
                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Add Post
                        </h5>
                        <svg wire:click="closeModal" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="store">
                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" class="form-control" id="title"
                                    placeholder="Enter post title">
                            </div>
                            <div class="form-group">
                                <label for="body">Post Body</label>
                                <textarea class="form-control" id="body" rows="4" placeholder="Enter post body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">
                                Save
                            </button>
                            <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="modal-backdrop fade show"></div>
    @endif


    {{-- MODAL DELETE --}}
    @if ($isOpenDelete)
        <div class="modal fade show" tabindex="-1" aria-hidden="true" role ="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi!!! </h5>
                        <button wire:click="closeModalDelete" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini? <br>
                        <hr/>
                        <form wire:submit='delete' method="POST">
                            <button wire:click="closeModalDelete" type="button" class="btn btn-secondary "
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger float-end">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
