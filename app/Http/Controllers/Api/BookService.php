<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookService extends Controller
{
    // Lihat semua data buku
    public function index()
    {
        $data = Book::all();
        
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diambil',
            'data' => $data
        ], 200);
    }

    // Lihat detail buku berdasarkan ID
    public function show($id)
    {
        $data = Book::find($id);
        
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $data
        ], 200);
    }

    // Simpan data buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|integer|min:1900',
            'stock' => 'required|integer|min:0'
        ]);

        $data = Book::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menyimpan data',
            'data' => $data
        ], 201);
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $data = Book::find($id);
        
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|integer|min:1900',
            'stock' => 'required|integer|min:0'
        ]);

        $data->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Berhasil update data',
            'data' => $data
        ], 200);
    }

    // Hapus data buku
    public function destroy($id)
    {
        $data = Book::find($id);
        
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus data',
            'data' => null
        ], 200);
    }
}