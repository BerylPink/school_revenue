<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\College;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth:web');
    }


    public function index()
    {
        $courses = Course::orderBy('course_name', 'ASC')->get();

        $data = compact('courses');

        return view('courses.course-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::select('id', 'colleges_id', 'departments_id','course_name', 
        'course_description')->orderBy('course_name', 'ASC')->get();

        $colleges = College::select('id', 'college_name', 'college_description')
        ->orderBy('college_name', 'ASC')->get();

        $data = compact('courses', 'colleges');

        return view('courses.course-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest();

        //INSERT INTO `users` table
        $createCourse = Course::create([
            'colleges_id'                =>   $request->input('colleges_id'),
            'departments_id'             =>   $request->input('departments_id'),
            'course_name'                =>   $request->input('course_name'),
            'course_description'         =>   $request->input('course_description'),
        ]);

        //If successfully created go to login page
        if($createCourse){
            return redirect()->route('courses.index')->with('success', $request->input('course_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    private function validateRequest(){
        return request()->validate([
            'colleges_id'                      =>   'required',
            'departments_id'                   =>   'required',
            'course_name'                     =>   'required|unique:courses,course_name',
            'course_description'              =>   'required', 
        ]);
    }

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
        $courseExists = Course::findOrFail($id);

        $course = Course::select('id', 'colleges_id', 'departments_id', 'course_name', 'course_description')->where('id', $id)->first();

        $colleges = College::select('id', 'college_name', 'college_description')
        ->orderBy('college_name', 'ASC')->get();

        $departments = Department::select('id', 'colleges_id', 'department_name', 'department_description')
        ->orderBy('department_name', 'ASC')->get();

        $data = compact('course', 'departments', 'colleges');

        return view('courses.course-edit', $data);
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
        $updateCourse = Course::where('id', $id)->update([
            'colleges_id'                     =>   $request->input('colleges_id'),
            'departments_id'                  =>   $request->input('departments_id'),
            'course_name'                    =>   $request->input('course_name'),
            'course_description'             =>   $request->input('course_description'),
        ]);


        if( $updateCourse){

            return redirect('/courses')->with('success', 'Updated '.$request->input('course_name').' details.');
        }
            
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseExists = Course::findOrFail($id);

        $deleteCourse = Course::where('id', $id)->delete();

        if($deleteCourse){
            return back()->with('success', 'Course has been deleted.');
        }
    }
}
