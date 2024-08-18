@extends('layout')
@section('content')
@include('navbar')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div>
    @foreach ($produk as $p)
        <div class="flex justify-between mx-10 bg-slate-300 my-5 py-2 px-2">
        <div class="w-28 flex gap-5 place-items-center">
            <img src="{{asset('gambar/'.$p->foto)}}" alt="">
            <div>
                <h1 class="font-bold">{{$p->nama}}</h1>
            </div>
        </div>
        <div class=" flex gap-3 place-items-center font-bold text-2xl">{{$p->total}}</div>
        <div class=" flex gap-3 place-items-center">{{$p->status}}</div>
        <div class=" flex gap-3 place-items-center">
            @if ($p->status == 'belum bayar')
                <a href="{{ route('konfirmasii', ['id' => $p->id_pesanan]) }}" class="bg-yellow-500 px-7 py-2 rounded-md text-white border-double border-4 hover:bg-yellow-600">Konfirmasi</a>
            @elseif ($p->status== 'diproses')
                <a href="{{route('hpes', ['id' => $p->id_pesanan])}}" class="bg-red-500 px-7 py-2 rounded-md text-white border-double border-4 hover:bg-red-600">Batalkan</a>
            @elseif ($p->status== 'gagal')
                <h1 class="bg-gray-600 px-7 py-2 rounded-md text-white border-double border-4">Ditolak</h1>
            @else
                <h1 class="bg-green-500 px-7 py-2 rounded-md text-white border-double border-4">Selesai</h1>
            @endif
            
        </div>
    </div>
    @endforeach
    
</div>
@endsection