<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Repositories\BebidaRepository;

class BebidaController extends Controller
{
    protected $bebidaRepository;

    public function __construct(BebidaRepository $bebidaRepository)
    {
        $this->bebidaRepository = $bebidaRepository;
    }

    public function index()
    {
        $bebidas = $this->bebidaRepository->all();
        return Inertia::render('Bebidas/Index', ['bebidas' => $bebidas]);
    }
   
    public function create(Request $request)
    {
        $marca = $request->input('marca');
        $tipo = $request->input('tipo');
        $preco = $request->input('preco');

        // Restante do seu código...

        return Inertia::render('Bebidas/Create', [
            'marca' => $marca,
            'tipo' => $tipo,
            'preco' => $preco
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $bebida = $this->bebidaRepository->create($data);
        return redirect()->route('bebidas.show', $bebida->id);
    }

    public function show($id)
    {
        $bebida = $this->bebidaRepository->find($id);
        return Inertia::render('Bebidas/Show', ['bebida' => $bebida]);
    }

    public function edit($id)
    {
        $bebida = $this->bebidaRepository->find($id);
        return Inertia::render('Bebidas/Edit', ['bebida' => $bebida]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'marca' => 'required',
            'tipo' => 'required',
            'preco' => 'required|numeric',
        ]);

        $data = $request->only(['marca', 'tipo', 'preco']);

        $bebida = $this->bebidaRepository->update($data, $id);

        return redirect()->route('bebidas.show', $bebida->id);
    }

    public function destroy($id)
    {
        $this->bebidaRepository->delete($id);
        return redirect()->route('bebidas.index');
    }
}
