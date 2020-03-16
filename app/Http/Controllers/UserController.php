<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Auth;
use App\User;
use DB;
use Barryvdh\DomPDF\Facade as PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        $user = Auth::user();
        return view('users.index', [
            'data' => $data,
            'titulo' => 'Listado de usuarios',
            'role' => $user->role,
            'descripcion' => 'Usuarios del sistema',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
            'titulo' => 'Crear Usuario',
            'descripcion' => '',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => ['required', Rule::in(['OPERARIO', 'SUPERVISOR',
                'SUPERUSUARIO'])],
            'password' => 'required|string|min:8',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);
            $user->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('users.index')
            ->with('success', 'El usuario ha sido registrado exitosamente');
    }

    /**
     * Display the specified profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', [
            'data' => $user,
            'titulo' => 'Perfil',
            'descripcion' => 'Datos de usuario'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'data' => $user,
            'titulo' => 'Editar Usuarios',
            'descripcion' => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => ['required', Rule::in(['OPERARIO', 'SUPERVISOR',
                'SUPERUSUARIO'])],
            'password' => 'required|string|min:8',
        ]);
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return redirect()->route('users.index')
            ->with('success', 'El usuario ha sido editado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request, User $user)
    {
        if (strcmp($request['password'], $request['verify_password']) != 0) {
            return redirect()->back()
                ->with('warning', 'Ambas contraseñas son distintas');
        }
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return redirect()->back()
            ->with('success', 'El perfil ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('users.index')
            ->with('success', 'El usuario ha sido eliminado exitosamente');
    }
}
