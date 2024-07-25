<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class MenuController extends BaseApiController
{
    public function listMenu(Request $request)
    {
        $model = MenuModel::query()->where(['active' => 'Y'])->get();

        return $this->sendResponse($model);
    }

    public function downloadPDF()
    {
        $data = [
            'title' => 'Laravel PDF Example',
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('pdf_view', $data);

        $pdfPath = storage_path('app/public/example.pdf');
        dd($pdfPath);
        Storage::put('public/example.pdf', $pdf->output());

        return response()->download($pdfPath, 'example.pdf')->deleteFileAfterSend(true);
    }
}
