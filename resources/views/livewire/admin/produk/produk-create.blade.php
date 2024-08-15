<div>
    <form wire:submit="store" method="POST">
        
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label" >Gambar</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" wire:model="gambar" accept="image/png, image/jpeg">
            </div>
        </div>
        <!-- End General Form Elements -->
        <button wire:click="closeModal" type="button" class="btn btn-secondary "
            data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary float-end">Simpan</button>
    </form>

</div>
