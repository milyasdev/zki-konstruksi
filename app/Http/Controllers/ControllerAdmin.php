<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\Storage;

class ControllerAdmin extends Controller
{
    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function indexProduct()
    {
        $data = ProdukModel::all();
        return view('backend.product.index', compact('data'));
    }

    public function formProduct()
    {
        $kategori = KategoriModel::all();
        // dd($kategori);
        return view('backend.product.form', compact('kategori'));
    }

    public function saveFormProduct(Request $request)
    {
        // 1. Lakukan Validasi Data (Sangat penting!)
        $request->validate([
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'harga'         => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'kategori'      => 'required|integer',
            'berat'         => 'required|numeric|min:0',
            'merk'          => 'required|string|max:100',
            'satuan'        => 'required|string|max:50',
            'gambar'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
        ]);

        // 2. Tentukan Mode: Simpan Baru (Create) atau Update
        $product_id = $request->input('product_id');

        if ($product_id) {
            // MODE UPDATE
            $product = ProdukModel::findOrFail($product_id);
            $message = 'Produk berhasil diupdate!';
        } else {
            // MODE SIMPAN BARU
            $product = new ProdukModel();
            $message = 'Produk baru berhasil ditambahkan!';
        }

        // 3. Persiapkan Data Umum
        $data = $request->only([
            'judul',
            'deskripsi',
            'harga',
            'stock',
            'kategori',
            'berat',
            'merk',
            'satuan'
        ]);

        // 4. Penanganan Upload Gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan gambar baru ke direktori 'uploads/produk' (storage/app/public/uploads/produk)
            $filePath = $file->storeAs('uploads/produk', $fileName, 'public');

            // Hapus gambar lama jika mode update dan ada file lama
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }

            $data['gambar'] = $filePath; // Simpan path baru ke database
        }

        $product->fill($data)->save();

        return redirect()->route('admin.indexProduct')->with('success', $message);
    }

    public function deleteProduct($id)
    {
        $data = ProdukModel::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.indexProduct')
            ->with('danger', 'Data berhasil dihapus');
    }

    public function editFormProduct($id = null)
    {
        $kategori   = KategoriModel::all();
        $product    = null;

        if ($id) {
            $product = ProdukModel::findOrFail($id);
        }

        return view('backend.product.form', compact(
            'product',
            'kategori',
        ));
    }

    // kategori =================================================================================

    public function indexKategori()
    {
        $data = KategoriModel::all();
        return view('backend.master.kategori.index', compact('data'));
    }

    public function formKategori()
    {
        $judul = 'Tambah Kategori Baru';
        return view('backend.master.kategori.form', compact('judul'));
    }

    public function saveFormKategori(Request $request)
    {
        $status = 1;
        $validated = $request->validate([
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string'
        ], [
            'judul.required'        => 'Kategori wajib diisi',
            'judul.max'             => 'Kategori maksimal 255 karakter',
            'deskripsi.required'    => 'Deskripsi wajib diisi'
        ]);
        // Simpan data
        try {
            KategoriModel::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => $status
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan kategori: ' . $e->getMessage());
        }

        // Redirect dengan pesan sukses
        return redirect()->route('admin.indexKategori')
            ->with('success', 'Kategori berhasil ditambah');
    }

    public function deleteFormKategori($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.indexKategori')
            ->with('danger', 'Data berhasil dihapus');
    }
}
