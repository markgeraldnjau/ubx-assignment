<?php

namespace App\Http\Controllers;

use App\Imports\ExcelDatasImport;
use App\Models\ExcelData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    //
    public function getExcelData()
    {
        $excelDatas = ExcelData::all();

        return view('excel-data')
            ->with('excelDatas', $excelDatas);
    }

    function uploadExcel(Request $request)
    {
        $this->validate($request, [
            'excel_file'  => 'required'
        ]);

        DB::beginTransaction();
        $import = Excel::import(new ExcelDatasImport(), $request->file('excel_file')->store('temp'));

        if ($import) {
            //Return Success
            DB::commit();
            Session::flash('status_message_success', 'Success: Excel file imported successful!!');
        } else {
            // Return failed
            DB::rollBack();
            Session::flash('status_message_failed', 'Failed: There is something wrong please try again');
        }
        return back();
    }

    public function getExcelDataAPI()
    {
        $excelData = ExcelData::all();

        if ($excelData) {

            return response()->json([
                'status' => 'success',
                'excelData' => $excelData,
            ]);

        } else {
            
            return response()->json([
                'status' => 'failed',
                'excelData' => [],
            ]);
        }
    }
}
