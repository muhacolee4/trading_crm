<?php

namespace App\Http\Controllers\Admin;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Response;

class ImportController extends Controller
{
    //
    public function fileImport(Request $request)
    {
        $request->validate([
            'file' => 'mimes:csv,xlsx,xls',
        ]);

        Excel::import(new UsersImport, $request->file('file'));
        return redirect()->back()->with('success', 'Leads Sucessfully imported!');
    }

    public function downloadDoc()
    {
        $download_path = (public_path() .  '/storage/' . 'leads.xlsx');
        return (Response::download($download_path));
    }
}