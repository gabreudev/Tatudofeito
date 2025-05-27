<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all(); 
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('reviews.create', ['service_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'comment' => 'required|string|max:1000',
            'url_image' => 'nullable|url|max:255',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        Review::create($validatedData);

        return redirect()->route('reviews.index')->with('success', 'Comentário enviado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::findOrFail($id);

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        $user = Auth::user();

        $service = $review->service;

        // Permite que apenas o cliente que criou a avaliação e o admin editem o comentário
        if ($user->role !== 'admin' && $service->client_id !== $user->id) {
            return redirect()->route('reviews.index')->with('error', 'Você não tem permissão para editar esta avaliação.');
        }
        //Array para ser usado em views que esperam uma lista de serviços.
        //Útil quando se usa a mesma view para criar e editar avaliações.
        // $services = [$service]; 
        // return view('reviews.edit', compact('review', 'services));

        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = Review::findOrFail($id);
        $user = Auth::user();

        // Veirfica Permissões
        $service = $review->service;
        if ($user->role !== 'admin' && $service->client_id !== $user->id) {
            return redirect()->route('servicos.index')->with('error', 'Você não tem permissão para atualizar esta avaliação.');
        }

        $validatedData = $request->validate([
            'comment' => 'required|string|max:1500',
            'url_image' => 'nullable|url|max:255',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $review->update($validatedData);

        // Teoricamente Atualiza a avaliação media do trablahador - Maas, não está implementado corretamente, ainda.
        //$this->updateWorkerRating($service->worker_id);

        return redirect()->route('reviews.index')->with('sucess', 'Avaliação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $user = Auth::user();

        // Verifica Permissões
        $service = $review->service;
        if ($user->role !== 'admin' && $service->client_id !== $user->id) {
            return redirect()->route('reviews.index')->with('error', 'Você não tem permissão para excluir esta avaliação.');
        }

        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Avaliação excluída com sucesso!');
    }
}
