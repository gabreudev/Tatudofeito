<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicos = Service::all();
        // Caso vá usar paginação, utilizar a função
        // $servicos = Service::latest()->paginate(10);

        return view('servicos.index', compact('servicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $clientId = $request->input('client_id');
        $workerId = $request->input('worker_id');

        return view('servicos.create', compact("clientId", "workerId"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'description' => 'required|string',
        ]);
      
        $validated['client_id'] = Auth::id();
        Service::create($validated);
  
        return redirect()->route('servicos.index')->with('success', 'Serviço criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servico = Service::with(['client', 'worker'])->findOrFail($id);
        return view('servicos.show', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $servico)
    {
        return view('servicos.edit', compact('servico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $servico)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'description' => 'required|string',
        ]);

        $servico->update($validated);

        return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $servico)
    {
        $servico->delete();
        return redirect()->route('servicos.index')->with('success', 'Serviço excluído com sucesso!');
    }
}
