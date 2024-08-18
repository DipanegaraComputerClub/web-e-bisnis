@extends('admin.layout')

@section('content')
<div class="flex-1 p-10">
    <h1 class="text-2xl font-bold mb-5">Add Product</h1>
    <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-gray-700">Nama Produk:</label>
            <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="keterangan" class="block text-gray-700">Deskripsi:</label>
            <textarea name="keterangan" id="keterangan" class="w-full px-4 py-2 border rounded-md" required></textarea>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700">Harga:</label>
            <input type="number" name="harga" id="harga" class="w-full px-4 py-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="foto" class="block text-gray-700">Foto:</label>
            <input type="file" name="foto" id="foto" class="w-full px-4 py-2 border rounded-md" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Add Product</button>
        </div>
    </form>
</div>
@endsection
