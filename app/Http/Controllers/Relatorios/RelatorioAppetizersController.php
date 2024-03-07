<?php

namespace App\Http\Controllers\Relatorios;

use App\Models\Appetizer;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RelatorioAppetizersController
{
    public function viewPDF()
    {
        $appetizers = Appetizer::all();
        $logoPath = asset('img/new-eight-box.png'); 

        return Inertia::render('Relatorios/RelatoriosAppetizer', [
            'appetizers' => $appetizers,
            'logoPath' => $logoPath,
        ]);
    }

    public function downloadPDF()
    {
        $appetizers = Appetizer::all();
        $logoPath = public_path('img/new-eight-box.png');

        $storagePath = storage_path('app/temp');

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $pdf = PDF::loadView('Relatorios/RelatoriosAppetizers', compact('appetizers', 'logoPath'))
            ->setPaper('a4', 'portrait');

        $tempFilePath = $storagePath . '/appetizers.pdf';
        $pdf->save($tempFilePath);

        return response()->download($tempFilePath, 'Relatório-Entrada.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
