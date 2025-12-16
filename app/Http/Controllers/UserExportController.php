<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserExportController extends Controller
{
    public function pdf()
    {
        $users = User::select('id', 'name', 'email')->get();

        $pdf = Pdf::loadView('reports.pdf.users', ['users' => $users])->setPaper('a4', 'portrait');

        return $pdf->download('reporte_usuarios_' . now()->format('d_m_Y_H:i'));
    }

    public function excel()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
    }
}
