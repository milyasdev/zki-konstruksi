@extends('backend.layout.master')
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Products List</h2>
                <p>Berbagai Data Data Produk</p>
            </div>
            <div>
                <a href="{{ route('admin.formProduct') }}" class="btn btn-primary btn-sm rounded">Create new</a>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%;">No</th>
                                <th scope="col" style="width: 30%;">Item</th>
                                <th scope="col" style="width: 15%;">Harga</th>
                                <th scope="col" style="width: 15%;">Status</th>
                                <th scope="col" style="width: 15%;">Kategori</th>
                                <th scope="col" style="width: 30%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <a class="itemside" href="#">
                                            <div>
                                                <img src="{{ route('admin.portal.secure.image', $item->gambar) }}"
                                                    class="img-sm img-thumbnail" alt="{{ $item->judul }}" />
                                            </div>
                                            <div class="info">
                                                <h6 class="mb-0">{{ $item->judul }}</h6>
                                            </div>
                                        </a>
                                    </td>
                                    <td><span>{{ $item->harga }}</span></td>
                                    <td>
                                        <span class="badge rounded-pill alert-success" style="color: green">Active</span>
                                    </td>
                                    <td><span>{{ $item->kategoriRelasi->judul }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.formProductEdit', $item->id) }}" class="btn btn-sm font-sm rounded btn-brand">
                                            <i class="material-icons md-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.deleteProduct', $item->id) }}"
                                            class="btn btn-sm font-sm btn-light rounded">
                                            <i class="material-icons md-delete_forever"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
