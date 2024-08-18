@extends('layout')
@section('content')
@include('navbar')
<div class="container mx-auto mt-10">
        <div class="bg-white p-10 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-5">Konfirmasi Pembayaran</h1>

            <div class="mb-5">
                <h2 class="text-xl font-semibold">Nomor Rekening Tujuan</h2>
                <p>BRI 98765847382746 / MERI</p>
            </div>

            <form action="{{route('upload',['id' => $pesanan->id_pesanan])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="mt-1 block w-full">
                    @error('bukti_pembayaran')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim</button>
            </form>
        </div>
    </div>
@endsection