<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all(); 
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:14|unique:users',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:client,worker,admin',
            'specialties' => 'nullable|string',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'payment_methods' => 'nullable|string',
            'daily_value' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'is_banned' => 'boolean',
            'email_verified' => 'boolean',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'cpf' => $validated['cpf'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'specialties' => $validated['specialties'] ?? null,
            'average_rating' => $validated['average_rating'] ?? null,
            'payment_methods' => $validated['payment_methods'] ?? null,
            'daily_value' => $validated['daily_value'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_banned' => $validated['is_banned'] ?? false,
            'email_verified' => $validated['email_verified'] ?? false,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario /*string $id*/)
    {
    //==========================================================================
        // $user = User::findOrFail($id);

        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'cpf' => 'nullable|string|max:14|unique:users,cpf,' . $user->id,
        //     'phone' => 'nullable|string|max:20',
        //     'email' => 'required|email|unique:users,email,' . $user->id,
        //     'password' => 'nullable|string|min:6|confirmed',
        //     'role' => 'required|in:client,worker,admin',
        //     'specialties' => 'nullable|string',
        //     'average_rating' => 'nullable|numeric|min:0|max:5',
        //     'payment_methods' => 'nullable|string',
        //     'daily_value' => 'nullable|numeric|min:0',
        //     'description' => 'nullable|string',
        //     'is_banned' => 'boolean',
        //     'email_verified' => 'boolean',
        // ]);

        // // Preparar dados para atualização
        // $userData = [
        //     'name' => $validated['name'],
        //     'cpf' => $validated['cpf'] ?? null,
        //     'phone' => $validated['phone'] ?? null,
        //     'email' => $validated['email'],
        //     'role' => $validated['role'],
        //     'specialties' => $validated['specialties'] ?? null,
        //     'average_rating' => $validated['average_rating'] ?? null,
        //     'payment_methods' => $validated['payment_methods'] ?? null,
        //     'daily_value' => $validated['daily_value'] ?? null,
        //     'description' => $validated['description'] ?? null,
        //     'is_banned' => $validated['is_banned'] ?? false,
        //     'email_verified' => $validated['email_verified'] ?? false,
        // ];

        // // Atualiza a senha somente se for enviada
        // if (!empty($validated['password'])) {
        //     $userData['password'] = Hash::make($validated['password']);
        // }

        // try {
        //     $user->update($userData);
        //     return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
        // } catch (\Exception $e) {
        //     return redirect()->back()->withInput()->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage());
        // }
    //==========================================================================

        // Definir regras de validação
        $rules = [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:users,cpf,' . $usuario->id,
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:client,worker,admin',
        ];
        
        // Adicionar regras para campos específicos de prestador se o role for worker
        if ($request->input('role') === 'worker') {
            $rules['specialties'] = 'nullable|string';
            $rules['payment_methods'] = 'nullable|string';
            $rules['daily_value'] = 'nullable|numeric|min:0';
            $rules['description'] = 'nullable|string';
        }
        
        // Validar os dados
        $validated = $request->validate($rules);
        
        // Preparar dados para atualização
        $userData = [
            'name' => $validated['name'],
            'cpf' => $validated['cpf'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];
        
        // Adicionar campos de prestador apenas se o papel for worker
        if ($validated['role'] === 'worker') {
            $userData['specialties'] = $validated['specialties'] ?? null;
            $userData['payment_methods'] = $validated['payment_methods'] ?? null;
            $userData['daily_value'] = $validated['daily_value'] ?? null;
            $userData['description'] = $validated['description'] ?? null;
            // Mantém a nota média atual, não permitindo alteração manual
            $userData['average_rating'] = $usuario->average_rating;
        } else {
            // Limpar campos de prestador se o usuário não for mais um worker
            $userData['specialties'] = null;
            $userData['payment_methods'] = null;
            $userData['daily_value'] = null;
            $userData['description'] = null;
            $userData['average_rating'] = null;
        }
        
        // Atualiza a senha somente se for enviada
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }
        
        try {
            $usuario->update($userData);
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //
    }
}
