@extends('layout')
@section('content')
    @include('navbar')
    <div class="flex mx-5 mt-8 gap-5">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold mb-4">Detail Produk</h1>
            <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                <img src="{{ asset('gambar/' . $produk->foto) }}" alt="" width="30%">
                <p><span class="font-semibold">Nama:</span> {{ $produk->nama }}</p>
                <p><span class="font-semibold">Keterangan:</span> {{ $produk->keterangan }}</p>
                <p><span class="font-semibold">Harga:</span> {{ $produk->harga }}</p>
            </div>
        </div>
        <div class="w-1/2">
            <h1 class="text-2xl font-bold mb-4">Pembelian</h1>
            <form method="post" action="{{route('proses.beli')}}">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="jumlah">Jumlah:</label>
                        <input type="number"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                            id="jumlah" name="jumlah" min="1" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="daerah">Daerah:</label>
                        <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                            id="daerah" name="daerah" required>
                            <option value="">Pilih Daerah</option>
                            @foreach ($ongkir as $item)
                                <option value="{{ $item->id_ongkir }}" data-harga="{{ $item->ongkos }}">{{ $item->daerah }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="harga_ongkir">Harga Ongkir:</label>
                        <input type="text"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                            id="harga_ongkir" name="harga_ongkir" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="total_harga">Total Harga:</label>
                        <input type="text"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                            id="total_harga" name="total_harga" readonly>
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Beli</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#daerah').change(function() {
                var hargaOngkir = $(this).find(':selected').data('harga');
                $('#harga_ongkir').val(hargaOngkir);

                var hargaProduk = {{ $produk->harga }};
                var jumlah = $('#jumlah').val();
                var totalHarga = parseInt(hargaProduk) * parseInt(jumlah) + parseInt(hargaOngkir);
                $('#total_harga').val(totalHarga);
            });

            $('#jumlah').keyup(function() {
                var hargaProduk = {{ $produk->harga }};
                var jumlah = $(this).val();
                var hargaOngkir = $('#daerah').find(':selected').data('harga');
                var totalHarga = parseInt(hargaProduk) * parseInt(jumlah) + parseInt(hargaOngkir);
                $('#total_harga').val(totalHarga);
            });
        });
    </script>
@endsection
