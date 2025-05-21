<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    if (Auth::user()->role == 'client') {
        $requests = Auth::user()->clientRequests;
    } else {
        $requests = Auth::user()->workerRequests;
    }
    
        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'worker_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);
    
        $existing_pending = ServiceRequest::where('client_id', Auth::id())
            ->where('worker_id', $request->worker_id)
            ->where('status', 'pendente')
            ->first();

        if ($existing_pending) {
            return back()->withErrors(['Já existe uma solicitação pendente para este profissional.']);
        }
    
        ServiceRequest::create([
            'client_id' => Auth::id(),
            'worker_id' => $request->worker_id,
            'service_id' => $request->service_id,
            'status' => 'pendente',
        ]);
    
        return redirect()->back()->with('status', 'Solicitação enviada com sucesso.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    public function accept($id)
{
    $solicitacao = ServiceRequest::findOrFail($id);
    
    if (auth()->id() !== $solicitacao->worker_id) {
        abort(403);
    }

    // Verificar se o serviço ainda está pendente
    $servico = Service::findOrFail($solicitacao->service_id);
    if ($servico->status !== 'pendente') {
        return back()->withErrors(['O serviço já foi aceito por outro profissional']);
    }
    
    $solicitacao->status = 'aceita';
    $solicitacao->save();

    $servico->status = 'em andamento';
    $servico->worker_id = $solicitacao->worker_id;
    $servico->save();
    
    // Rejeita automaticamente as outras solicitações pendentes do mesmo serviço
    ServiceRequest::where('service_id', $servico->id)
        ->where('id', '!=', $solicitacao->id)
        ->where('status', 'pendente')
        ->update(['status' => 'expirada']);

    return redirect()->route('requests.index')->with('success', 'Solicitação aceita com sucesso.');
}

    public function reject($id)
    {
        $solicitacao = ServiceRequest::findOrFail($id);
        
        if (auth()->id() !== $solicitacao->worker_id) {
            abort(403);
        }
        
        $solicitacao->status = 'recusada';
        $solicitacao->save();
        
        return redirect()->route('requests.index')->with('success', 'Solicitação recusada com sucesso.');
    }
    
    public function destroy($id)
    {
        $solicitacao = ServiceRequest::findOrFail($id);
    
        if (auth()->id() !== $solicitacao->client_id) {
            abort(403);
        }
    
        $solicitacao->delete();
    
        return back()->with('success', 'Solicitação cancelada.');
    }
    
}
