<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoListController extends Controller
{
    public function index(Request $request)
    {
        $todos = $request->user()->todos()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data todo berhasil diambil',
            'data' => $todos
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $todo = $request->user()->todos()->create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'belum selesai',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Todo berhasil dibuat',
            'data' => $todo
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Todo berhasil diambil',
            'data' => $todo
        ]);
    }

    public function update(Request $request, $id)
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $todo->update($request->only(['judul', 'deskripsi']));

        return response()->json([
            'success' => true,
            'message' => 'Todo berhasil diperbarui',
            'data' => $todo
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:selesai,belum selesai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $todo->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status todo berhasil diperbarui',
            'data' => $todo
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo tidak ditemukan'
            ], 404);
        }

        $todo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Todo berhasil dihapus'
        ]);
    }
}