@extends('backend.layout.master')
@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-12">
                <div class="content-header">
                    <h2 class="content-title">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk'}}  </h2>
                    <div>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.saveFormProduct') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($product))
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                @endif
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>{{ isset($product) ? 'Data Produk Nomor : ' : 'Data Umum' }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Judul Produk<span class="text-danger">
                                            *</span></label>
                                    <input type="text" placeholder="Masukkan Judul" name="judul"
                                        class="form-control @error('judul') is-invalid @enderror" id="product_name"
                                        value="{{ old('judul', isset($product) ? $product->judul : '') }}" />
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Deskripsi<span class="text-danger"> *</span></label>
                                    <textarea placeholder="Masukkan Deskripsi" name="deskripsi" class="form-control @error('judul') is-invalid @enderror"
                                        rows="4">{{ old('deskripsi', isset($product) ? $product->deskripsi : '') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label class="form-label">Harga<span class="text-danger">
                                                    *</span></label>
                                            <div class="row gx-2">
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input name="harga" placeholder="Jangan Pakai Titik/Koma"
                                                        type="number"
                                                        class="form-control  @error('harga') is-invalid @enderror"
                                                        value="{{ old('harga', isset($product) ? $product->harga : '') }}" />
                                                    @error('harga')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label class="form-label">Stock<span class="text-danger"> *</span></label>
                                            <input placeholder="" name="stock" type="text"
                                                class="form-control @error('stock') is-invalid @enderror"
                                                value="{{ old('stock', isset($product) ? $product->stock : '') }}" />
                                            @error('stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label class="form-label">Satuan<span class="text-danger"> *</span></label>
                                            <input placeholder="" name="satuan" type="text"
                                                class="form-control @error('satuan') is-invalid @enderror"
                                                value="{{ old('satuan', isset($product) ? $product->satuan : '') }}" />
                                            @error('satuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Kategori<span class="text-danger"> *</span></label>
                                        <select class="form-select @error('kategori') is-invalid @enderror" name="kategori">
                                            <option value="" disabled
                                                {{ old('kategori', isset($product) ? $product->kategori : '') == '' ? 'selected' : '' }}>
                                                -- Pilih Kategori --
                                            </option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('kategori', isset($product) ? $product->kategori : '') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->judul }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label class="form-label">Berat (KG)<span class="text-danger"> *</span></label>
                                            <input placeholder="" name="berat" type="text"
                                                class="form-control @error('berat') is-invalid @enderror"
                                                value="{{ old('berat', isset($product) ? $product->berat : '') }}" />
                                            @error('berat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label class="form-label">Merk<span class="text-danger"> *</span></label>
                                            <input placeholder="" name="merk" type="text"
                                                class="form-control @error('merk') is-invalid @enderror"
                                                value="{{ old('merk', isset($product) ? $product->merk : '') }}" />
                                            @error('merk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card end// -->

                        <!-- card end// -->
                    </div>
                    <div class="col-lg-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Data Gambar</h4>
                            </div>
                            <div class="card-body">
                                <div
                                    class="mb-3 text-center d-flex justify-content-center align-items-start gap-3 flex-wrap">
                                    {{-- Tempat untuk menampilkan gambar lama (hanya kalau edit) --}}
                                    @if (isset($product) && $product->gambar)
                                        <div class="mb-3 text-center">
                                            <label class="form-label d-block">Gambar Lama</label>
                                            <img src="{{ route('admin.portal.secure.image', $product->gambar) }}"
                                                alt="Gambar Lama"
                                                style="max-width: 150px; height: auto; border: 1px solid #ccc; padding: 5px;" />
                                        </div>
                                    @endif

                                    {{-- Tempat untuk menampilkan preview gambar --}}
                                    <div class="mb-3 text-center">
                                        <label class="form-label d-block">Preview Gambar</label>
                                        <img id="imagePreview"
                                            src="{{ isset($product) && $product->gambar ? Storage::url($product->gambar) : 'assets/imgs/theme/upload.svg' }}"
                                            alt="Preview Gambar"
                                            style="max-width: 150px; height: auto; border: 1px solid #ccc; padding: 5px;" />
                                    </div>
                                </div>

                                <div class="input-upload">
                                    {{-- Hapus <img src="assets/imgs/theme/upload.svg" alt="" /> lama, diganti dengan yang di atas --}}

                                    <input class="form-control @error('gambar') is-invalid @enderror" type="file"
                                        name="gambar" accept="image/*" id="gambarInput" />

                                    @error('gambar')
                                        {{-- Pesan error akan muncul jika validasi gambar gagal --}}
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        {{-- Catatan: 'd-block' sering diperlukan untuk membuat invalid-feedback terlihat di input type="file" --}}
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <hr>
                                    <a href="{{ route('admin.indexProduct') }}"
                                        class="btn btn-light rounded font-sm mr-5 text-body hover-up">Kembali</a>
                                    <button class="btn btn-md rounded font-sm hover-up" type="submit">{{ isset($product) ? 'Update' : 'Simpan' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gambarInput = document.getElementById('gambarInput');
            const imagePreview = document.getElementById('imagePreview');

            if (gambarInput) {
                gambarInput.addEventListener('change', function(event) {
                    // Pastikan ada file yang dipilih
                    if (event.target.files && event.target.files[0]) {
                        const reader = new FileReader();

                        // Fungsi yang dijalankan setelah file berhasil dibaca
                        reader.onload = function(e) {
                            // Mengubah atribut src dari tag <img> dengan data URL file
                            imagePreview.src = e.target.result;
                        }

                        // Baca file sebagai Data URL (base64)
                        reader.readAsDataURL(event.target.files[0]);
                    }
                });
            }
        });
    </script>
@endsection
