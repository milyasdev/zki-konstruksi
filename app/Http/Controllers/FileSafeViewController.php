<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileSafeViewController extends Controller
{
    public function showPrivateImage($filename)
    {
        // ini buat amankan agar nggak bisa akses direktori sembarangan
        $cleanPath = str_replace(['..', './', '\\'], '', $filename);
        $path = storage_path('app/private/' . $cleanPath);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Type' => mime_content_type($path),
        ]);
    }

    public function showPublicImage($filename)
    {
        // ini buat amankan agar nggak bisa akses direktori sembarangan
        $cleanPath = str_replace(['..', './', '\\'], '', $filename);
        $path = storage_path('app/public/' . $cleanPath);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        return response()->stream(function () use ($path) {
            readfile($path);
        }, 200, [
            'Content-Type' => mime_content_type($path),
            'Content-Length' => filesize($path),
            'Cache-Control' => 'max-age=86400, public',
        ]);
    }

    public function showPublicPdf($filename)
    {
        // Bersihkan path agar tidak bisa akses direktori sembarangan
        $cleanPath = str_replace(['..', './', '\\'], '', $filename);
        $path = storage_path('app/public/' . $cleanPath);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Pastikan hanya file PDF yang diizinkan
        if (mime_content_type($path) !== 'application/pdf') {
            abort(403, 'Akses ditolak: file bukan PDF');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
