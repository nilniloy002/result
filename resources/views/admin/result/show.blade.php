<x-admin>
    @section('title', 'View Result - ' . $result->student_name)
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View Result - {{ $result->student_name }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.result.edit', $result) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('admin.result.index') }}" class="btn btn-sm btn-secondary">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Basic Information -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="border-bottom pb-2">Student Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Student ID</th>
                            <td>{{ $result->student_id }}</td>
                        </tr>
                        <tr>
                            <th>Student Name</th>
                            <td>{{ $result->student_name }}</td>
                        </tr>
                        <tr>
                            <th>Father's Name</th>
                            <td>{{ $result->father_name }}</td>
                        </tr>
                        <tr>
                            <th>Mother's Name</th>
                            <td>{{ $result->mother_name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="border-bottom pb-2">Academic Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Study Center</th>
                            <td>{{ $result->study_center }}</td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td>{{ $result->batch }}</td>
                        </tr>
                        <tr>
                            <th>Passing Year</th>
                            <td>{{ $result->passing_year }}</td>
                        </tr>
                        <tr>
                            <th>GPA/CGPA</th>
                            <td><strong>{{ $result->gpa_cgpa }}</strong></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge badge-{{ $result->status === 'on' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($result->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Semester Results -->
            <h5 class="border-bottom pb-2 mb-3">Semester Results</h5>
            
            @if($result->selected_semesters && count($result->selected_semesters) > 0)
                @foreach($result->selected_semesters as $semester)
                    @if(isset($result->semester_results[$semester]))
                        <div class="semester-result card mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">{{ $semester }} - Course Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Year</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $semesterData = $result->semester_results[$semester];
                                                $counter = 1;
                                            @endphp
                                            @foreach($semesterData as $course)
                                                @if(!empty($course['course_code']) || !empty($course['course_name']) || !empty($course['grade']))
                                                    <tr>
                                                        <td>{{ $counter++ }}</td>
                                                        <td>{{ $course['year'] ?? '-' }}</td>
                                                        <td>{{ $course['course_code'] ?? '-' }}</td>
                                                        <td>{{ $course['course_name'] ?? '-' }}</td>
                                                        <td>
                                                            @if(!empty($course['grade']))
                                                                <span class="badge badge-{{ $course['grade'] }}">
                                                                    {{ $course['grade'] }}
                                                                </span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            
                                            @if($counter == 1)
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">
                                                        No course data available for this semester
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            No result data available for {{ $semester }}
                        </div>
                    @endif
                @endforeach
            @else
                <div class="alert alert-info">
                    No semesters selected for this result.
                </div>
            @endif
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <strong>Created:</strong> {{ $result->created_at->format('M d, Y h:i A') }}
                </div>
                <div class="col-md-6 text-right">
                    <strong>Last Updated:</strong> {{ $result->updated_at->format('M d, Y h:i A') }}
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Result view page loaded');
        });
    </script>
    @endsection

    @push('styles')
    <style>
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .semester-result {
            border: 1px solid #dee2e6;
        }
        .badge-success { background-color: #28a745; }
        .badge-warning { background-color: #ffc107; color: #212529; }
        .badge-danger { background-color: #dc3545; }
        .badge-secondary { background-color: #6c757d; }
        .badge-info { background-color: #17a2b8; }
    </style>
    @endpush
</x-admin>