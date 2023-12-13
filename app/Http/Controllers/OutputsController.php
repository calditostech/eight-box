<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Repositories\OutputsRepository;

class OutputsController extends Controller
{
    protected $outputsRepository;

    public function __construct(OutputsRepository $outputsRepository)
    {
        $this->outputsRepository = $outputsRepository;
    }

    public function index()
    {
        $outputs = $this->outputsRepository->all();
        return Inertia::render('Outputs/Index', ['outputs' => $outputs]);
    }

    public function filters(Request $request)
    {
        $tipo = $request->tipo;
        $marca = $request->marca;
        $preco = $request->preco;

        $query = $this->outputsRepository->getModel();
        
        if ($tipo) {
            $query->where('tipo', 'like', "%$tipo%");
        }
    
        if ($marca) {
            $query->where('marca', 'like', "%$marca%");
        }
    
        if ($preco) {
            $query->where('preco', 'like', "%$preco%");
        }
    
        $outputs = $query->get();

        return Inertia::render('Outputs/Index', ['outputs' => $outputs]);
    }
   
    public function create(Request $request)
    {
        $marca = $request->input('marca');
        $tipo = $request->input('tipo');
        $quantidade = (int) $request->input('quantidade');
        $data_saida_produto = \Illuminate\Support\Carbon::parse($request->input('data_saida_produto'))->toDateTimeString();

        $data = compact('marca', 'tipo', 'quantidade', 'data_saida_produto');

        return Inertia::render('Outputs/Create', $data);
    }

    public function store(Request $request)
    {
        try {
            $outputs = $this->outputsRepository->create($request->all());
            return redirect()->route('outputs.index', ['id' => $outputs->id]);
        } catch (\Exception $e) {
            return redirect()->route('outputs.index')->with('error', 'Erro ao criar o registro.');
        }
    }

    public function show($id)
    {
        $outputs = $this->outputsRepository->find($id);
        return Inertia::render('Outputs/Show', ['outputs' => $outputs]);
    }

    public function edit($id)
    {
        $outputs = $this->outputsRepository->find($id);
        return Inertia::render('Outputs/Edit', ['outputs' => $outputs]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'marca' => 'required',
            'tipo' => 'required',
            'quantidade' => 'required|numeric',
            'data_saida_produto' => 'required'
        ]);

        $data = $request->only(['marca', 'tipo', 'quantidade', 'data_saida_produto']);

        $outputs = $this->outputsRepository->update($data, $id);

        if ($outputs) {
            return redirect()->route('outputs.index', $outputs->id);
        } else {
            return redirect()->back()->with('error', 'Erro ao atualizar o produto de saída');
        }
    }

    public function destroy($id)
    {
        $this->outputsRepository->delete($id);
        return redirect()->route('outputs.index');
    }
}
