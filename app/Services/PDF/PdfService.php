<?php


namespace App\Services\PDF;
use Illuminate\Support\Facades\View;
use PDF;
use App\Services\PDF\Contracts\PdfServiceInterface;
use App;

class PdfService implements PdfServiceInterface
{
    /**
     * Display a listing of the resource.
     *
     * @param string view_name
     * @param array $data
     * @return PDF
     */
    public function generatePdf(string $view_name ,array $data){
        //generate report view
        $html = View::make('UsersPdfReport',$data)->render();
        //generate pdf
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        return $pdf;
    }

}
