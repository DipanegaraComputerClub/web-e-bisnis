@extends('layout')
@section('content')
@include('navbar')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div>
    @foreach ($keranjang as $k )
    <div class="flex justify-between mx-10 bg-slate-300 my-5 py-2 px-2">
        <div class="w-28 flex gap-5 place-items-center">
            <img src="{{ asset('gambar/' . $k->foto) }}" alt="">
            <div>
                <h1 class="font-bold">{{$k->nama}}</h1><br>
            </div>
        </div>
        <div class=" flex gap-3 place-items-center font-bold text-2xl">Rp.{{$k->harga}}</div>
        <div class=" flex gap-3 place-items-center">
            <a href="{{ route('hapusker', ['id' => $k->id_produk]) }}" class="bg-red-500 px-7 py-2 rounded-md text-white border-double border-4 hover:bg-red-600">Hapus</a>
            <a href="{{route('beli', ['id' => $k->id_produk])}}" class="bg-primary-500 px-7 py-2 rounded-md text-white border-double border-4 hover:bg-primary-600">Beli</a>
        </div>
    </div>
    @endforeach

</div>



@endsection