@extends('layout')
@section('content')
    @include('navbar')
    <div class="flex">
        <div class="w-1/2 pl-28 pb-36">
            <h1 class="font-bold text-4xl pt-28">Nikmati Berbelanja Dengan Harga Super Mewah</h1><br>
            <h1 class="text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam, eos ex ea sit eius
                minus, voluptates dicta sunt nobis ullam illo ipsam qui error, commodi perferendis? Harum, porro, odit
                cupiditate soluta esse facilis incidunt vel accusantium aliquid voluptatem consequatur excepturi dolorem
                voluptate libero minus cumque dolores suscipit. Nam, distinctio doloremque.</h1><br>
            <ul class="flex gap-5">
                <li><a href="javascript:void(0);" id="scroll-to-product-grid"
                        class="bg-primary-500 px-7 py-2 rounded-md text-white border-double border-4 hover:bg-primary-600">Beli</a>
                </li>
                <li><a href="{{route('keranjang')}}"
                        class="bg-orange-400 px-7 py-2 rounded-md text-white border-double border-4 hover:bg-orange-500">Keranjang</a>
                </li>
            </ul>
        </div>
        <div class="w-1/2 grid place-content-center">
            <img src="{{ asset('gambar/cowok.png') }}" alt="">
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0099ff" fill-opacity="1"
            d="M0,96L40,101.3C80,107,160,117,240,101.3C320,85,400,43,480,37.3C560,32,640,64,720,90.7C800,117,880,139,960,128C1040,117,1120,75,1200,64C1280,53,1360,75,1400,85.3L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
    <div class="bg-[#0099ff]">
        <div class="flex ml-5 gap-5 pb-5 pl-16">
            <input type="text" id="search-input" class="border border-gray-300 rounded-md w-48 shadow-md px-5 py-1"
                placeholder="Cari Barang Anda">
            {{-- <a href="" id="search-button"
                class="bg-orange-400 px-7 py-1 rounded-md text-white border-double border-4 hover:bg-orange-500">Cari</a> --}}
        </div>
        <div class="grid grid-cols-5 gap-4 pb-5 px-20" id="product-grid">
            @foreach ($produks as $a)
                <div class="w-52 pt-2 pb-4 px-2 bg-white rounded-lg hover:bg-slate-200">
                    <img src="{{ asset('gambar/' . $a->foto) }}" class="rounded-lg" alt="">
                    <h1 class="text-center font-bold">{{ $a->nama }}</h1>
                    <h1 class="text-center mb-2">Rp.{{ $a->harga }}</h1>

                    <ul>
                        <center>
                            <li
                                class="bg-green-400 w-44 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-green-500">
                                <a href="{{ route('detail', ['id' => $a->id_produk]) }}">Detail</a>
                            </li>
                            <li class="flex gap-2 place-content-center">
                                <form method="POST" action="{{ route('masukkeranjang', ['id' => $a->id_produk]) }}">
                                    @csrf
                                    <button type="submit"
                                        class="bg-orange-400 w-24 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-orange-500">Keranjang</button>
                                </form>
                                <a href="{{ route('beli', ['id' => $a->id_produk]) }}"
                                    class="bg-primary-400 w-16 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-primary-500">Beli</a>
                            </li>
                        </center>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: {'query': query},
                    success: function(data) {
                        $('#product-grid').empty();
                        if (data.length > 0) {
                            data.forEach(function(product) {
                                var productHtml = '<div class="w-52 pt-2 pb-4 px-2 bg-white rounded-lg hover:bg-slate-200">';
                                productHtml += '<img src="{{ asset('gambar/') }}/' + product.foto + '" class="rounded-lg" alt="">';
                                productHtml += '<h1 class="text-center font-bold">' + product.nama + '</h1>';
                                productHtml += '<h1 class="text-center mb-2">Rp.' + product.harga + '</h1>';
                                productHtml += '<ul><center>';
                                productHtml += '<li class="bg-green-400 w-44 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-green-500">';
                                productHtml += '<a href="{{ route('detail', ['id' => ':id']) }}".replace(":id", product.id_produk)>' + 'Detail' + '</a>';
                                productHtml += '</li><li class="flex gap-2 place-content-center">';
                                productHtml += '<form method="POST" action="{{ route('masukkeranjang', ['id' => ':id']) }}".replace(":id", product.id_produk)>';
                                productHtml += '@csrf';
                                productHtml += '<button type="submit" class="bg-orange-400 w-24 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-orange-500">Keranjang</button>';
                                productHtml += '</form>';
                                productHtml += '<a href="{{ route('beli', ['id' => ':id']) }}".replace(":id", product.id_produk) class="bg-primary-400 w-16 mb-1 py-1 rounded-md text-white border-double border-4 hover:bg-primary-500">Beli</a>';
                                productHtml += '</li></center></ul></div>';
                                $('#product-grid').append(productHtml);
                            });
                        } else {
                            $('#product-grid').append('<p class="text-white">Produk tidak ditemukan.</p>');
                        }
                    }
                });
            });

            $('#scroll-to-product-grid').on('click', function() {
                $('html, body').animate({
                    scrollTop: $('#product-grid').offset().top
                }, 1000);
            });
            
        });
    </script>
@endsection
