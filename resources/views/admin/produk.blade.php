@extends('admin.layout')
@section('content')
    <!-- Main Content -->
    <div class="flex-1 p-10">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">All Products</h1>
            <a href="{{ route('tproduk') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Tambah
                Produk</a>
        </div>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b w-32">Foto</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Harga</th>
                    <th class="py-2 px-4 border-b">Deskripsi</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b"><img src="{{ asset('gambar/' . $product->foto) }}"
                                alt="gambar produk"></td>
                        <td class="py-2 px-4 border-b">{{ $product->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->harga }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->keterangan }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('editProduct', $product->id_produk) }}"
                                class="text-blue-500 hover:text-blue-700">Edit</a>
                            <form action="{{ route('deleteProduct', $product->id_produk) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
