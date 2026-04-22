<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryService extends Controller
{
    // Lihat semua data
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    // Lihat detail data berdasarkan ID
    public function show($id)
    {
        $data = Category::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        
        return response()->json($data, 200);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories'
        ]);

        $data = new Category();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->save();

        return response()->json([
            'message' => 'Berhasil menyimpan data',
            'data' => $data
        ], 201);
    }

    // Update data
    public function update(Request $request, $id)
    {
        $data = Category::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required|string|unique:categories,name,'.$id
        ]);

        if ($data->name != $request->name) {
            $data->name = $request->name;
            $data->slug = Str::slug($request->name);
            $data->save();
        }

        return response()->json([
            'message' => 'Berhasil update data',
            'data' => $data
        ], 200);
    }

    // Hapus data
    public function destroy($id)
    {
        $data = Category::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}