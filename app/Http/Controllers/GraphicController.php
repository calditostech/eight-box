<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphicController extends Controller
{
    public function getData() 
    {
        $appetizers = DB::table('appetizer')
            ->select('tipo', 'marca', DB::raw('MAX(quantidade) as max_quantidade'), DB::raw('MAX(data_entrada_produto) as data_entrada'))
            ->groupBy('tipo', 'marca')
            ->orderByDesc('max_quantidade')
            ->get();

        $outputs = DB::table('outputs')
            ->select('tipo', 'marca', DB::raw('MAX(quantidade) as max_quantidade'), DB::raw('MAX(data_saida_produto) as data_saida'))
            ->groupBy('tipo', 'marca')
            ->orderByDesc('max_quantidade')
            ->get();
       
        return response()->json([
            'appetizer' => $appetizers,
            'outputs' => $outputs,
        ]);
    }
}
