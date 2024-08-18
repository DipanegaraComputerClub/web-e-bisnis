@extends('layout')
@section('content')
@include('navbar')
<div class="flex">
    <div class="w-1/2 py-10">
    <center>
        <img src="{{ asset('gambar/' . $produk->foto) }}" alt="" width="50%">
    </center>
    </div>
    <div class="w-1/2 grid place-content-center gap-2 pr-10">
        <h1 class="font-bold text-2xl">{{$produk->nama}}</h1>
        <h1 class="font-bold text-2xl">Rp.{{$produk->harga}}</h1>
        <h1 class="font-bold text-2xl">Deskripsi</h1>
        <h1>{{$produk->keterangan}}</h1>
        <div class="py-5">
            <a href="" class="bg-orange-400 p-2  mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-orange-500" >Keranjang</a>
            <a href="" class="bg-primary-400 px-5 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-primary-500">Beli</a>
        </div>
    </div>
</div>


@endsection