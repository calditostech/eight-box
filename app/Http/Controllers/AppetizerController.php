<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Repositories\AppetizerRepository;

class AppetizerController extends Controller
{
    protected $appetizerRepository;

    public function __construct(AppetizerRepository $appetizerRepository)
    {
        $this->appetizerRepository = $appetizerRepository;
    }

    public function index()
    {
        $appetizers = $this->appetizerRepository->all();
        return Inertia::render('Appetizer/Index', ['appetizers' => $appetizers]);
    }

    public function filters(Request $request)
    {
        $tipo = $request->tipo;
        $marca = $request->marca;
        $preco = $request->preco;

        $query = $this->appetizerRepository->getModel();
        
        if ($tipo) {
            $query->where('tipo', 'like', "%$tipo%");
        }
    
        if ($marca) {
            $query->where('marca', 'like', "%$marca%");
        }
    
        if ($preco) {
            $query->where('preco', 'like', "%$preco%");
        }
    
        $appetizer = $query->get();

        return Inertia::render('Appetizer/Index', ['appetizer' => $appetizer]);
    }
   
    public function create(Request $request)
    {
        $marca = $request->input('marca');
        $tipo = $request->input('tipo');
        $quantidade = (int) $request->input('quantidade');
        $data_entrada_produto = \Illuminate\Support\Carbon::parse($request->input('data_entrada_produto'))->toDateTimeString();

        $data = compact('marca', 'tipo', 'quantidade', 'data_entrada_produto');

        return Inertia::render('Appetizer/Create', $data);
    }

    public function store(Request $request)
    {
        try {
            $appetizer = $this->appetizerRepository->create($request->all());
            return redirect()->route('appetizer.index', ['id' => $appetizer->id]);
        } catch (\Exception $e) {
            return redirect()->route('appetizer.index')->with('error', 'Erro ao criar o registro.');
        }
    }

    public function show($id)
    {
        $appetizer = $this->appetizerRepository->find($id);
        return Inertia::render('Appetizer/Show', ['appetizer' => $appetizer]);
    }

    public function edit($id)
    {
        $appetizer = $this->appetizerRepository->find($id);
        return Inertia::render('Appetizer/Edit', ['appetizer' => $appetizer]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'marca' => 'required',
            'tipo' => 'required',
            'quantidade' => 'required|numeric',
            'data_entrada_produto' => 'required'
        ]);

        $data = $request->only(['marca', 'tipo', 'quantidade', 'data_entrada_produto']);

        $appetizer = $this->appetizerRepository->update($data, $id);

        if ($appetizer) {
            return redirect()->route('appetizer.index', $appetizer->id);
        } else {
            return redirect()->back()->with('error', 'Erro ao atualizar o produto de entrada');
        }
    }

    public function destroy($id)
    {
        $this->appetizerRepository->delete($id);
        return redirect()->route('appetizer.index');
    }
}
