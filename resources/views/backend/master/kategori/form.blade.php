@extends('backend.layout.master')
@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-12">
                <div class="content-header">
                    <h2 class="content-title">{{ $judul }}</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.saveFormKategori') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Kategori</label>
                                <input type="text" placeholder="Type here" name='judul'
                                    class="form-control @error('judul') is-invalid @enderror" id="product_name"
                                    value="{{ old('judul') }}" />
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Full description</label>
                                <textarea placeholder="Type here" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                    rows="4">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <hr>
                                <a href="{{ route('admin.indexKategori') }}"
                                    class="btn btn-light rounded font-sm hover-up">Kembali</a>
                                <button type="submit" class="btn btn-md rounded font-sm hover-up">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- card end// -->

                <!-- card end// -->
            </div>
        </div>
    </section>
@endsection
