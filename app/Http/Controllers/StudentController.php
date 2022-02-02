<?php

namespace App\Http\Controllers;

use App\Models\Student; // load Post model
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
            'name' => 'required|string|max:155',
            'gender' => 'required',
            'age' => 'numeric'
        ]);

        $student = Student::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age
        ]);

        if ($student) {
            return redirect()
                ->route('student.index')
                ->with([
                    'success' => 'New student has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
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
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
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
        //
		$this->validate($request, [
            'name' => 'required|string|max:155',
            'gender' => 'required',
            'age' => 'numeric'
        ]);

		$student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age
        ]);
		
		if ($student) {
            return redirect()
                ->route('student.index')
                ->with([
                    'success' => 'Student has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
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
        $student = Student::findOrFail($id);
        $student->delete();

        if ($student) {
            return redirect()
                ->route('student.index')
                ->with([
                    'success' => 'Student Data has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('student.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
