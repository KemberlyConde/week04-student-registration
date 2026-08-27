<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Landing / dashboard page shown at the site root.
     */
    public function dashboard(): View
    {
        $totalStudents = Student::count();

        $perProgram = Student::selectRaw('program, count(*) as total')
            ->groupBy('program')
            ->orderByDesc('total')
            ->get();

        $recentStudents = Student::latest()->take(5)->get();

        return view('dashboard', compact('totalStudents', 'perProgram', 'recentStudents'));
    }

    /**
     * Display a listing of registered students.
     */
    public function index(): View
    {
        $students = Student::latest()->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the student registration form.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Validate and store a newly registered student.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id'      => 'required|string|max:20|unique:students,student_id',
            'first_name'      => 'required|string|max:100',
            'middle_name'     => 'nullable|string|max:100',
            'last_name'       => 'required|string|max:100',
            'email'           => 'required|email|max:150|unique:students,email',
            'mobile_number'   => 'required|numeric|digits_between:7,15',
            'gender'          => 'required|in:male,female,other',
            'date_of_birth'   => 'required|date|before:today',
            'program'         => 'required|string|max:100',
            'year_level'      => 'required|string|max:20',
            'address'         => 'required|string|max:255',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Store the profile picture inside storage/app/public/profile_pictures
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $validated['profile_picture'] = $path;

        $student = Student::create($validated);

        return redirect()
            ->route('students.show', $student->id)
            ->with('success', 'Student registered successfully!');
    }

    /**
     * Display the registered student's profile.
     */
    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }
}
