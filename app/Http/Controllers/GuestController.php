<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function search(Request $request)
    {
        $students = Student::with('school')->guestSearch($request->all())->get();
        return view('student',compact('students'));
    }
}
