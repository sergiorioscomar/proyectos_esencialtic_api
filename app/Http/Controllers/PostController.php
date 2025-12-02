<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all());
    }

    public function show($id)
    {
        return response()->json(Post::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
            'categoria' => 'nullable|string|max:100',
            'url' => 'nullable|url',
            'fecha_publicacion' => 'nullable|date',
            'autor' => 'nullable|string|max:100',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'status' => 'ok',
            'data' => $post
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only([
            'titulo',
            'descripcion',
            'imagen',
            'categoria',
            'url',
            'fecha_publicacion',
            'autor',
        ]));

        return response()->json($post);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
