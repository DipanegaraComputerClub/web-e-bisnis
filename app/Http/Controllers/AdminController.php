<?php

namespace App\Http\Controllers;

use App\Models\Konfirmasi;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index() {
    $produk = Produk::count();
    $pesanan = Pesanan::count();
    $konfirmasi = Konfirmasi::count();
    $user = User::where('level','user')->count();

    return view('admin.index', compact('produk', 'pesanan', 'konfirmasi', 'user'));
}
     public function produk(){
      $products = Produk::all();
        return view('admin.produk', compact('products'));
     }
     public function tproduk(){
      return view('admin.tproduk');
     }
     public function proproduk(Request $request) {
    $request->validate([
        'nama' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        'harga' => 'required|numeric',
        'keterangan' => 'required',
    ]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $imageName = time() . '_' . $file->getClientOriginalName(); // Use a unique name for the image
        $file->move(public_path('gambar'), $imageName);

        Produk::create([
            'nama' => $request->nama,
            'foto' => $imageName, // Save the image name in the database
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);
    }

    return redirect()->route('aproduk')->with('success', 'Produk berhasil ditambahkan!');
}
    public function editProduct($id) {
        $product = Produk::findOrFail($id);
        return view('admin.eproduk', compact('product'));
    }
    public function updateProduct(Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif',
            'harga' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        $product = Produk::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Delete the old image
            if ($product->foto && file_exists(public_path('gambar/' . $product->foto))) {
                unlink(public_path('gambar/' . $product->foto));
            }
            
            // Upload the new image
            $file = $request->file('foto');
            $imageName = time() . '_' . $file->getClientOriginalName(); 
            $file->move(public_path('gambar'), $imageName);
            $product->foto = $imageName;
        }

        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->keterangan = $request->keterangan;
        $product->save();

        return redirect()->route('aproduk')->with('success', 'Produk berhasil diperbarui!');
    }
    public function deleteProduct($id) {
        $product = Produk::findOrFail($id);

        // Delete the image
        if ($product->foto && file_exists(public_path('gambar/' . $product->foto))) {
            unlink(public_path('gambar/' . $product->foto));
        }

        $product->delete();
        return redirect()->route('aproduk')->with('success', 'Produk berhasil dihapus!');
    }

     public function user(){
        $user = User::where('level','user')->get();
        return view('admin.user', compact('user'));
     }
     public function deleteuser($id){
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('auser')->with('success', 'User berhasil dihapus!');
     }

     public function pesanan(){
        // Dapatkan semua pesanan pengguna
        $pesanan = Pesanan::all();

        // Dapatkan produk terkait dengan pesanan dan user terkait dengan pesanan
        $produk_pesanan = [];
        foreach ($pesanan as $p) {
            $produk = Produk::find($p->id_produk);
            $user = User::find($p->id_user);
            
            if ($produk && $user) {
                $produk->total = $p->total;
                $produk->status = $p->status;
                $produk->id_pesanan = $p->id_pesanan;
                $p->nama = $produk->nama;
                $produk->name = $user->name; 
                $produk_pesanan[] = $produk;
            }
        }
        return view('admin.pesanan',['produk' => $produk_pesanan]);
     }
     public function deletepesanan($id){
        $pesanan=Pesanan::findOrFail($id);
        $pesanan->delete();
        return redirect()->route('apesanan')->with('success', 'Pesanan berhasil dihapus!');
     }
     public function konfirmasi()
    {
        $konfirmasi = Konfirmasi::all();

        // Prepare an array to store the details
        $konfirmasi_details = [];
        foreach ($konfirmasi as $k) {
            $pesanan = Pesanan::find($k->id_pesanan);
            $produk = Produk::find($pesanan->id_produk);
            $user = User::find($k->id_user);

            if ($produk && $user) {
                $detail = [
                    'id_konfirmasi' => $k->id_konfirmasi,
                    'name' => $user->name,
                    'nama' => $produk->nama,
                    'harga' => $pesanan->total, // Assuming total is the product price
                    'bukti' => $k->bukti
                ];
                $konfirmasi_details[] = $detail;
            }
        }

        return view('admin.konfirmasi', ['konfirmasi' => $konfirmasi_details]);
    }

    public function acceptKonfirmasi($id)
    {
        $konfirmasi = Konfirmasi::find($id);
        if ($konfirmasi) {
            $pesanan = Pesanan::find($konfirmasi->id_pesanan);
            if ($pesanan) {
                $pesanan->status = 'selesai';
                $pesanan->save();
            }
            $konfirmasi->delete();
        }
        return redirect()->route('akonfirmasi')->with('success', 'Konfirmasi berhasil diterima!');
    }

    public function rejectKonfirmasi($id)
    {
        $konfirmasi = Konfirmasi::find($id);
        if ($konfirmasi) {
            $pesanan = Pesanan::find($konfirmasi->id_pesanan);
            if ($pesanan) {
                $pesanan->status = 'gagal';
                $pesanan->save();
            }
            $konfirmasi->delete();
        }
        return redirect()->route('akonfirmasi')->with('error', 'Konfirmasi ditolak.');
    }

}
