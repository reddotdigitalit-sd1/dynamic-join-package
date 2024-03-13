<?php

namespace RedDotDigitalIT\DynamicJoin\Http\Controllers;

use Illuminate\Http\Request;
use RedDotDigitalIT\DynamicJoin\Models\Report;
use DB;

class ViewReportListController extends Controller
{
    public function index()
    {
        $reports = DB::table('reports')->get();
        // $reports = Report::all();
        // dd($reports);
        return view('reportList.index', ['reports' => $reports]);
    }

    public function show($id)
    {
        $reports = Report::find($id);
        return view('reportList.show', ['reports' => $reports]);
    }
}
