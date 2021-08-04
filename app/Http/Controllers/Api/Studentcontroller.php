<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class Studentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::where('id', '>', $request->last_id)->limit(10)->get();
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $students = Student::all()->take($id);
        $difference = array_udiff_assoc($request->students, $students->toArray(), function ($a, $b) {
            if ($a === $b) {
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        });
        // dd($request->students, $students->toArray(), $difference);

        foreach ($difference as $key => $sortedStudent) {
            $student = Student::find($key + 1);
            $student->name = $sortedStudent['name'] === null ? '' : $sortedStudent['name'];
            $student->email = $sortedStudent['email'] === null ? '' : $sortedStudent['email'];
            $student->username = $sortedStudent['username'] === null ? '' : $sortedStudent['username'];
            $student->phone = $sortedStudent['phone'] === null ? '' : $sortedStudent['phone'];
            $student->dob = $sortedStudent['dob'] === null ? '' : $sortedStudent['dob'];
            $student->update();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
