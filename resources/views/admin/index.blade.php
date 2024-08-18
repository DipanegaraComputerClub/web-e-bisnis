@extends('admin.layout')
@section('content')
    <div class="flex flex-wrap p-10 justify-between w-full gap-2 text-2xl font-bold text-white">
        <div class="w-1/5 h-1/4 bg-gray-700 text-center p-5 rounded">
            <h1>PRODUK</h1>
            <h1>{{$produk}}</h1>
        </div>
        <div class="w-1/5 h-1/4 bg-gray-700 text-center p-5 rounded">
            <h1>PESANAN</h1>
            <h1>{{$pesanan}}</h1>
        </div>
        <div class="w-1/5 h-1/4 bg-gray-700 text-center p-5 rounded">
            <h1>KONFIRMASI</h1>
            <h1>{{$konfirmasi}}</h1>
        </div>
        <div class="w-1/5 h-1/4 bg-gray-700 text-center p-5 rounded">
            <h1>USER</h1>
            <h1>{{$user}}</h1>
        </div>
    </div>
@endsection
