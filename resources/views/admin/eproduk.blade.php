<!-- resources/views/admin/edit_product.blade.php -->
@extends('admin.layout')

@section('content')
<div class="flex-1 p-10">
    <h1 class="text-2xl font-bold mb-5">Edit Product</h1>
    <form action="{{ route('updateProduct', $product->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama" class="block text-gray-700">Nama Produk:</label>
            <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-md" value="{{ $product->nama }}" required>
        </div>
        <div class="mb-4">
            <label for="keterangan" class="block text-gray-700">Deskripsi:</label>
            <textarea name="keterangan" id="keterangan" class="w-full px-4 py-2 border rounded-md" required>{{ $product->keterangan }}</textarea>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700">Harga:</label>
            <input type="number" name="harga" id="harga" class="w-full px-4 py-2 border rounded-md" value="{{ $product->harga }}" required>
        </div>
        <div class="mb-4">
            <label for="foto" class="block text-gray-700">Foto:</label>
            <input type="file" name="foto" id="foto" class="w-full px-4 py-2 border rounded-md">
            @if ($product->foto)
                <img src="{{ asset('gambar/' . $product->foto) }}" alt="Product Image" class="mt-2 w-32">
            @endif
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Update Product</button>
        </div>
    </form>
</div>
@endsection
