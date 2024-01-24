<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index() {
        $usuarios = User::join('roles', 'users.rol_id', 'roles.id')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'roles.nombre'
            ])
            ->get();

        return view('usuarios.index')->with([
            'usuarios' => $usuarios
        ]);
    }

    function create() {

        $roles = Rol::all();

        return view('usuarios.create')->with([
            'roles' => $roles
        ]);
    }

    function store() {

        User::create([
            'name' => request()->input("name"),
            'email' => request()->input("email"),
            'password' => \Hash::make(request()->input("password")),
            'rol_id' => request()->input("rol_id")
        ]);

        return $this->index();
    }

    function show(User $usuario) {

        $rol = Rol::find($usuario->rol_id);

        return view('usuarios.show')->with([
            'usuario' => $usuario,
            'rol' => $rol
        ]);
    }

    function edit(User $usuario) {

        $roles = Rol::all();

        return view('usuarios.edit')->with([
            'usuario' => $usuario,
            'roles' => $roles
        ]);
    }

    function update(User $usuario) {

        $usuario->update([
            'name' => request()->input('name'),
            'email' => request()->input('email'),
            'rol_id' => request()->input('rol_id')
        ]);

        return $this->index();
    }
}
