@extends('layout')
@section('content')
@include('navbar')
<div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8">Tutorial Membeli Barang dan Konfirmasi Pembayaran</h1>

        <div class="mb-8">
            <h2 class="text-3xl font-semibold mb-4">Cara Membeli Barang</h2>
            <ol class="list-decimal pl-5 space-y-2">
                <li>
                    <p>Di halaman dashboard, klik tombol <strong>Beli</strong> untuk melihat semua produk yang tersedia.</p>
                    <center>
                    <img src="{{ asset('gambar/t1.PNG') }}" alt="Dashboard Beli" width="50%" class="my-4 border border-5">
                    </center>
                </li>
                <li>
                    <p>Pilih produk yang ingin Anda beli dari daftar produk yang ditampilkan.</p>
                    <center>
                    <img src="{{ asset('gambar/t2.PNG') }}" alt="Dashboard Beli" width="50%" class="my-4 border border-5">
                    </center>
                </li>
                <li>
                    <p>Halaman baru akan muncul untuk menentukan jumlah barang dan memilih ongkos kirim. Isi informasi yang diperlukan.</p>
                    <center>
                    <img src="{{ asset('gambar/t3.PNG') }}" alt="Dashboard Beli" width="50%" class="my-4 border border-5">
                    </center>
                </li>
                <li>
                    <p>Klik tombol <strong>Beli</strong> untuk membuat pesanan Anda.</p>
                    
                </li>
            </ol>
        </div>

        <div>
            <h2 class="text-3xl font-semibold mb-4">Konfirmasi Pembayaran</h2>
            <ol class="list-decimal pl-5 space-y-2">
                <li>
                    <p>Klik menu <strong>Pesanan</strong> di navbar untuk melihat daftar pesanan Anda.</p>
                    
                </li>
                <li>
                    <p>Terdapat tombol <strong>Konfirmasi Pembayaran</strong> di setiap pesanan yang belum dibayar. Klik tombol tersebut.</p>
                    <center>
                    <img src="{{ asset('gambar/t4.PNG') }}" alt="Dashboard Beli" width="50%" class="my-4 border border-5">
                    </center>
                </li>
                <li>
                    <p>Anda akan diarahkan ke halaman pembayaran untuk mengupload bukti pembayaran. Isi informasi yang diperlukan.</p>
                    <center>
                    <img src="{{ asset('gambar/t5.PNG') }}" alt="Dashboard Beli" width="50%" class="my-4 border border-5">
                    </center>
                </li>
                <li>
                    <p>Setelah mengupload bukti pembayaran, klik tombol <strong>Beli</strong> untuk memproses konfirmasi.</p>
                    <center>
                    <img src="{{ asset('gambar/t6.PNG') }}" alt="Dashboard Beli" width="50%" class="my-4 border border-5">
                    </center>
                </li>
            </ol>
        </div>
    </div>
@endsection