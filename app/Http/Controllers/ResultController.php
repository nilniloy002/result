<?php
// app/Http/Controllers/ResultController.php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::latest()->paginate(10);
        return view('admin.result.index', compact('results'));
    }

    public function create()
    {
        return view('admin.result.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:50',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'study_center' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'gpa_cgpa' => 'required|numeric|min:0|max:4.00',
            'selected_semesters' => 'required|array|min:1',
            'selected_semesters.*' => 'string|in:1st Year,2nd Year,1st Semester,2nd Semester,3rd Semester,4th Semester,5th Semester,6th Semester',
            'semester_results' => 'required|array',
            'status' => 'required|in:on,off',
        ]);

        try {
            // Process semester results
            $processedResults = [];
            foreach ($request->selected_semesters as $semester) {
                if (isset($request->semester_results[$semester])) {
                    $processedResults[$semester] = $request->semester_results[$semester];
                }
            }

            Result::create([
                'student_id' => $request->student_id,
                'student_name' => $request->student_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'program' => $request->program,
                'study_center' => $request->study_center,
                'batch' => $request->batch,
                'passing_year' => $request->passing_year,
                'gpa_cgpa' => $request->gpa_cgpa,
                'selected_semesters' => $request->selected_semesters,
                'semester_results' => $processedResults,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.result.index')
                ->with('success', 'Result created successfully.');

        } catch (\Exception $e) {
            Log::error('Result creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to create result. Please try again.');
        }
    }

    public function show(Result $result)
    {
        return view('admin.result.show', compact('result'));
    }

    public function edit(Result $result)
    {
        return view('admin.result.edit', compact('result'));
    }

    public function update(Request $request, Result $result)
    {
        $request->validate([
            'student_id' => 'required|string|max:50',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
             'program' => 'required|string|max:255',
            'study_center' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'gpa_cgpa' => 'required|numeric|min:0|max:4.00',
            'selected_semesters' => 'required|array|min:1',
            'selected_semesters.*' => 'string|in:1st Year,2nd Year,1st Semester,2nd Semester,3rd Semester,4th Semester,5th Semester,6th Semester',
            'semester_results' => 'required|array',
            'status' => 'required|in:on,off',
        ]);

        try {
            // Process semester results
            $processedResults = [];
            foreach ($request->selected_semesters as $semester) {
                if (isset($request->semester_results[$semester])) {
                    $processedResults[$semester] = $request->semester_results[$semester];
                }
            }

            $result->update([
                'student_id' => $request->student_id,
                'student_name' => $request->student_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'program' => $request->program,
                'study_center' => $request->study_center,
                'batch' => $request->batch,
                'passing_year' => $request->passing_year,
                'gpa_cgpa' => $request->gpa_cgpa,
                'selected_semesters' => $request->selected_semesters,
                'semester_results' => $processedResults,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.result.index')
                ->with('success', 'Result updated successfully.');

        } catch (\Exception $e) {
            Log::error('Result update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update result. Please try again.');
        }
    }

    public function destroy(Result $result)
    {
        try {
            $result->delete();
            return redirect()->route('admin.result.index')
                ->with('success', 'Result deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Result deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete result. Please try again.');
        }
    }
}