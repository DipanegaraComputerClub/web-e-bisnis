@extends('layout')
@section('content')
    @include('navbar')
    <div class="grid grid-cols-5 gap-4 pb-5 px-20 mt-10">
        @foreach ($ws as $w )
            <div class="w-52 pt-2 pb-4 px-2 bg-primary-200 rounded-lg hover:bg-slate-200">
            <img src="{{ asset('gambar/' . $w->foto) }}" class="rounded-lg" alt="">
            <h1 class="text-center font-bold">{{$w->nama}}</h1>
            <h1 class="text-center mb-2">{{$w->harga}}</h1>
            <ul>
                <center>
                    <li class="bg-green-400 w-44 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-green-500">
                        <a href="{{ route('detail', ['id' => $w->id_produk]) }}">Detail</a>
                    </li>
                    <li class="flex gap-2 place-content-center">
                        <form method="POST" action="{{ route('masukkeranjang', ['id' => $w->id_produk]) }}">
                                    @csrf
                                    <button type="submit"
                                        class="bg-orange-400 w-24  mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-orange-500">Keranjang</button>
                                </form>
                        <a href="{{ route('beli', ['id' => $w->id_produk]) }}"
                            class="bg-primary-400 w-16 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-primary-500">Beli</a>
                    </li>
                </center>
            </ul>
        </div>
        @endforeach
        

    </div>
@endsection
