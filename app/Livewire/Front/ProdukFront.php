<?php

namespace App\Livewire\Front;

use Livewire\Attributes\Title;
use Livewire\Component;

class ProdukFront extends Component
{
    #[Title('Produk')]
    public function render()
    {
        return view('livewire.front.produk-front');
    }
}
