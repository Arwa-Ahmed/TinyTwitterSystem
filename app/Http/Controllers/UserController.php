<?php

namespace App\Http\Controllers;
use App\Services\ReportService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UsersReport()
    {
        try{
            //create pdf report
            $pdf = $this->reportService->UsersReport();
            //download pdf report
            return $pdf->download('UsersReport.pdf');
        }catch(\Exception $e){
            $result = [
                'status'=>500,
                'error'=>$e->getMessage(),
            ];
            return response()->json($result, $result['status']);
        }
    }
}
