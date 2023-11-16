<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = Divisi::all();
        return response()->json($divisi);
    }

    public function show($id)
    {
        $divisi = Divisi::find($id);
        if ($divisi) {
            return response()->json($divisi);
        } else {
            return response()->json(['message' => 'Divisi not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'namadivisi' => 'required|string|max:14',
            'status' => 'required|string|max:35',
            'created_at' => 'date',
            'updated_at' => 'date',
            'user_id' => 'integer',
        ]);

        $divisi = Divisi::create($request->all());
        return response()->json($divisi, 201);
    }

    public function update(Request $request, $id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            return response()->json(['message' => 'Divisi not found'], 404);
        }

        $request->validate([
            'namadivisi' => 'required|string|max:14',
            'status' => 'required|string|max:35',
            'created_at' => 'date',
            'updated_at' => 'date',
            'user_id' => 'integer',
        ]);

        $divisi->update($request->all());
        return response()->json($divisi);
    }

    public function destroy($id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            return response()->json(['message' => 'Divisi not found'], 404);
        }

        $divisi->delete();
        return response()->json(['message' => 'Divisi deleted'], 204);
    }
}
