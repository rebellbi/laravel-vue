<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        return view('intro1');
    }


    public function getStudents(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::latest()->get();
            $datatable = DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', 'Hi, {{$name}}!')
                ->setRowId(function ($data) {
                    return 'SID-' . $data->id;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->setRowClass(function ($data) {
                    return $data->id % 2 == 0 ? 'alert-success' : 'alert-warning';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->has('username') && $request->username !== null) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['username'], $request->get('username')) ? true : false;
                        });
                    }
                })
                ->make(true);
            return $datatable;
        }
    }

    public function intro2(StudentDataTable $dataTable)
    {
        return $dataTable->render('intro2');
    }
}
