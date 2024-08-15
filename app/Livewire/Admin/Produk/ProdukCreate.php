<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProdukCreate extends Component
{
    use WithFileUploads;

    #[Rule('nullable|sometimes|image|max:2048')]
    public $gambar;

    #[Title('Tambah Produk')]
    public function render()
    {
        return view('livewire.admin.produk.produk-create');
    }

    public function store(){
       if($this->gambar){
        dd('sukses');
       }
    }
}
