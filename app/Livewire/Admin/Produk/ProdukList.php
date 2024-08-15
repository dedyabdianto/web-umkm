<?php

namespace App\Livewire\Admin\Produk;

use App\Models\Produk;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

class ProdukList extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $isOpen = 0;
    public $isOpenDelete = 0;

    public $produkId;

    #[Validate('required|min:3')]
    public $nama_produk;
    // public $user_id;
    // public $slug;
    public $deskripsi;

    #[Validate('required|integer')]
    public $harga;

    #[Validate('nullable|image|max:2048')]
    public $gambar;

    #[Title('Produk')]
    public function render()
    {
        return view('livewire.admin.produk.produk-list', [
            'produks' => Produk::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }


    public function store()
    {

        if ($this->gambar) {
            $filepath = $this->gambar->store('uploads', 'public');
        } else {
            $filepath = '';
        }

        $validated = $this->validate();
        if ($validated) {
            Produk::create([
                'nama_produk' => $this->nama_produk,
                'user_id' => 1,
                'slug' => 'test-produk',
                'deskripsi' => $this->deskripsi,
                'harga' => $this->harga,
                'gambar' => $filepath,
            ]);
            session()->flash('success', 'Berhasil menambahkan produk');
            $this->reset();
            $this->closeModal();
        }


        // return $this->redirect('/produk-list', navigate:false);
    }

    public function create()
    {
        $this->reset();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function openModalDelete()
    {
        $this->isOpenDelete = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function closeModalDelete()
    {
        $this->isOpenDelete = false;
        $this->reset();
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $this->produkId = $id;
        $this->nama_produk = $produk->nama_produk;
        $this->deskripsi = $produk->deskripsi;
        $this->harga = $produk->harga;
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);
        $produk = Produk::find($this->produkId);
        $produk->update([
            'nama_produk' => $this->nama_produk,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
        ]);
        session()->flash('success', 'Berhasil mengedit produk');
        $this->reset();
        $this->closeModal();
    }

    public function konfirm_delete($id)
    {
        $this->produkId = $id;
        $this->openModalDelete();
    }

    public function delete()
    {
        $produk = Produk::find($this->produkId);
        $produk->delete();
        session()->flash('success', 'Berhasil menghapus produk');
        $this->reset();
        $this->closeModalDelete();
    }


}
