@extends('backend.layout.master')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">List Kategori</h2>
                <p>Buat Kategori Barang Disini</p>
            </div>
            <div>
                <a href="{{ route('admin.formKategori') }}" class="btn btn-primary btn-sm rounded">Tambah Baru</a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success rounded-pill alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close custom-close" data-bs-dismiss="alert" aria-label="Close"><i
                        class="bi bi-x"></i></button>
            </div>
        @elseif (session('danger'))
            <div class="alert alert-danger rounded-pill alert-dismissible fade show">
                {{ session('danger') }}
                <button type="button" class="btn-close custom-close" data-bs-dismiss="alert" aria-label="Close"><i
                        class="bi bi-x"></i></button>
            </div>
        @endif
        <div class="card mb-4">
            <!-- card-header end// -->
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Kategori</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $no++ }}
                                </td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge rounded-pill alert-success" style="color: green">Active</span>
                                    @elseif ($item->status == 0)
                                        <span class="badge rounded-pill alert-success" style="color: rgb(243, 0, 0)">Not
                                            Active</span>
                                    @else
                                        <span class="badge rounded-pill alert-success" style="color: rgb(243, 0, 0)">Not
                                            Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.deleteFormKategori', $item->id) }}"
                                        class="btn btn-sm font-sm btn-light rounded confirm-delete">
                                        {{-- ^ Pindah class 'confirm-delete' ke elemen 'a' --}}
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
    </section>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap semua elemen dengan class 'confirm-delete'
            const deleteButtons = document.querySelectorAll('.confirm-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {

                    // Mencegah tautan berjalan ke href-nya
                    e.preventDefault();

                    const deleteUrl = this.getAttribute('href'); // Ambil URL dari atribut href

                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: "Tindakan ini akan menghapus data data kategori!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna menekan "Ya, Hapus!", lanjutkan navigasi ke URL
                            window.location.href = deleteUrl;
                        }
                    })
                });
            });
        });
    </script>
@endsection
