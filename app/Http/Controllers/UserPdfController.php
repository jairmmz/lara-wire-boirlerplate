<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class UserPdfController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::select('id', 'name', 'email')->get();

        $pdf = Pdf::loadView('reports.pdf.users', ['users' => $users])->setPaper('a4', 'portrait');

        return $pdf->download('reporte_usuarios_'. now()->format('d_m_Y_H:i'));
    }
}
