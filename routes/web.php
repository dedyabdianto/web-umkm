<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Produk\ProdukCreate;
use App\Livewire\Admin\Produk\ProdukList;
use App\Livewire\Front\ProdukFront;
use App\Livewire\Front\Tentang;
use App\Livewire\Index;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/index', Index::class)->name('index');
Route::get('/counter', Counter::class)->name('counter');
Route::get('/front-produk', ProdukFront::class)->name('front.produk');
Route::get('/tentang', Tentang::class)->name('tentang');
Route::get('/produk-list', ProdukList::class)->name('produk-list');
Route::get('/produk-create', ProdukCreate::class)->name('produk-create');

