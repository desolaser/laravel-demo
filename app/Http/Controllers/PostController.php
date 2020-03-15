<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post, Cotizacion};
use Auth;

class PostController extends Controller
{
    public function show(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $posts = Post::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('post.show', [
                'status' => $status,
                'data' => $posts
            ]);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $post = new Post();
            $post->cotizacion_id = $request->cotizacion_id;
            $post->mensaje = $request->mensaje;
            $post->usuario = Auth::user()->name;
            $post->save();
            $alert = ['success' => 'Post subido exitosamente'];

            $posts = Post::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('post.show', [
                'status' => $status,
                'data' => $posts,
            ])->nest('alerts', 'alerts', $alert);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()) {
            $post = Post::find($request->id);
            return view('post.edit', [
                'post' => $post
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $post = Post::find($request->id);
            $post->mensaje = $request->mensaje;
            $post->save();
            $alert = ['success' => 'Post actualizado exitosamente'];

            $posts = Post::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('post.show', [
                'status' => $status,
                'data' => $posts,
            ])->nest('alerts', 'alerts', $alert);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $status = Cotizacion::find($request->cotizacion_id)->status;

            $post = Post::find($request->id);
            $post->delete();
            $alert = ['success' => 'Post eliminado exitosamente'];

            $posts = Post::where('cotizacion_id', $request->cotizacion_id)->get();
            return view('post.show', [
                'status' => $status,
                'data' => $posts,
            ])->nest('alerts', 'alerts', $alert);
        }
    }
}
