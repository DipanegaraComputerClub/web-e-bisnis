<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Konfirmasi;
use App\Models\Ongkir;
use App\Models\Pesanan;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){
      $produk=Produk::all();
        return view('dashboard',['produks'=>$produk]);
     }

    public function keranjang(){
      $id_user = Auth::id();
      $id_produk_keranjang = Keranjang::where('id_user', $id_user)->pluck('id_produk');
      $produk_keranjang = Produk::whereIn('id_produk', $id_produk_keranjang)->get();
                  
      return view('keranjang',['keranjang' => $produk_keranjang]);
     }

     public function hapuskeranjang($id){
      $id_user = Auth::id();
      Keranjang::where('id_produk', $id)
               ->where('id_user', $id_user)
               ->delete();
      return redirect()->route('keranjang')->with('success', 'Produk berhasil dihapus dari keranjang.');
     }

     public function detail($id){
         $produk = Produk::find($id);
         if (!$produk) {
            abort(404, 'Produk tidak ditemukan');
        }
        return view('detail', ['produk' => $produk]);
     }

     public function masukkeranjang($id){
      $produk = Produk::find($id);
      if (!$produk) {
        abort(404, 'Produk tidak ditemukan');
      }
      $id_user = Auth::id();
      $existingKeranjang = Keranjang::where('id_produk', $id)
                                    ->where('id_user', $id_user)
                                    ->first();
      if ($existingKeranjang) {
        return redirect()->route('keranjang')->with('success', 'Produk sudah ada dalam keranjang.');
    }
      $kr=new Keranjang();
      $kr->id_produk = $id;
      $kr->id_user = $id_user;
      $kr->save();

      $ws=new Wishlist();
      $ws->id_produk = $id;
      $ws->id_user = $id_user;
      $ws->save();

      return redirect()->route('keranjang')->with('success', 'Produk telah ditambahkan ke keranjang.');
     }

     public function hpes($id){
      $id_user = Auth::id();
      Pesanan::where('id_pesanan', $id)
               ->where('id_user', $id_user)
               ->delete();
      Konfirmasi::where('id_pesanan', $id)
               ->where('id_user', $id_user)
               ->delete();
      return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibatalkan.');
     }

     public function tutorial(){
      return view('tutorial');
     }

     public function pesanan(){
      $id_user = Auth::id();

    // Dapatkan semua pesanan pengguna
    $pesanan = Pesanan::where('id_user', $id_user)->get();

    // Dapatkan produk terkait dengan pesanan
    $produk_pesanan = [];
    foreach ($pesanan as $p) {
        $produk = Produk::where('id_produk', $p->id_produk)->first();
        if ($produk) {
            $produk->total = $p->total;
            $produk->status = $p->status;
            $produk->id_pesanan = $p->id_pesanan;
            $produk_pesanan[] = $produk;
        }
    }
      return view('pesanan',['produk'=>$produk_pesanan]);
     }

     public function konfirmasii($id){
      $id_user = Auth::id();
      $pesanan = Pesanan::where('id_pesanan', $id)->where('id_user', $id_user)->first();

      if (!$pesanan) {
        return redirect()->route('pesanan')->with('error', 'Pesanan tidak ditemukan.');
      }
      return view('konfirmasi',['pesanan'=>$pesanan]);
     }

     public function upload(Request $request ,$id){
      $id_user = Auth::id();
      $pesanan = Pesanan::where('id_pesanan', $id)->where('id_user', $id_user)->first();

      $request->validate([
        'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif',
      ]);

      if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $imageName = $file->getClientOriginalName(); 
        $file->move(public_path('gambar'), $imageName);

        Konfirmasi::insert([
          'id_user'=>$id_user,
          'id_pesanan'=>$pesanan->id_pesanan,
          'bukti'=>$imageName,
        ]);
        $pesanan->status = 'diproses'; 
        $pesanan->save();
    }

    return redirect()->route('pesanan')->with('success', 'Konfirmasi berhasil dilakukan.');
      
     }

     public function wishlist(){
    $id_user = Auth::id();
    $ws = Wishlist::where('id_user', $id_user)->get();
    $produk_wishlist = [];

    foreach ($ws as $p) {
        $produk = Produk::where('id_produk', $p->id_produk)->first();
        if ($produk) {
            $p->nama = $produk->nama;  // Use $produk properties directly
            $p->foto = $produk->foto;
            $p->harga = $produk->harga;
            $produk->id_produk = $p->id_produk;
            $produk_wishlist[] = $produk;
        }
    }

    return view('wishlist', ['ws' => $produk_wishlist]);
}

    public function search(Request $request) {
      $query = $request->input('query');
      $produks = Produk::where('nama', 'LIKE', "%{$query}%")->get();

      return response()->json($produks);
    }

     public function beli($id){
      $produk = Produk::find($id);
      if (!$produk) {
        abort(404, 'Produk tidak ditemukan');
      }
      $ongkir=Ongkir::all();
      
      return view('beli',['produk'=>$produk,'ongkir'=>$ongkir]);
     }

     public function prosesBeli(Request $request)
{
    $id_produk = $request->produk_id;
    $id_user = Auth::id();
    $id_ongkir = $request->daerah;
    $jumlah = $request->jumlah;
    $total_harga = $request->total_harga;

    // Simpan data pembelian ke dalam tabel pesanan
    Pesanan::create([
        'id_produk' => $id_produk,
        'id_ongkir' => $id_ongkir,
        'id_user' => $id_user,
        'jumlah' => $jumlah,
        'total' => $total_harga,
        'status' => 'belum bayar',
    ]);

    Keranjang::where('id_produk', $id_produk)
             ->where('id_user', $id_user)
             ->delete();

    // Redirect ke halaman atau berikan respon sesuai kebutuhan aplikasi Anda
    return redirect()->route('pesanan')->with('success', 'Pembelian berhasil dilakukan.');
}
}
