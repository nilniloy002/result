<x-admin>
    @section('title', 'Edit Result')
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Result</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.result.update', $result) }}" method="POST" id="resultForm">
                @csrf @method('PUT')
                
                <!-- Basic Information -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Student ID *</label>
                            <input type="text" name="student_id" class="form-control" value="{{ old('student_id', $result->student_id) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Student Name *</label>
                            <input type="text" name="student_name" class="form-control" value="{{ old('student_name', $result->student_name) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Father's Name *</label>
                            <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $result->father_name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mother's Name *</label>
                            <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $result->mother_name) }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Program *</label>
                            <input type="text" name="program" class="form-control" value="{{ old('program', $result->program) }}" required>
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Study Center *</label>
                            <input type="text" name="study_center" class="form-control" value="{{ old('study_center', $result->study_center) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Batch *</label>
                            <input type="text" name="batch" class="form-control" value="{{ old('batch', $result->batch) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Passing Year *</label>
                            <input type="number" name="passing_year" class="form-control" value="{{ old('passing_year', $result->passing_year) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GPA/CGPA *</label>
                            <input type="number" step="0.01" name="gpa_cgpa" class="form-control" value="{{ old('gpa_cgpa', $result->gpa_cgpa) }}" min="0" max="4.00" required>
                        </div>
                    </div>
                </div>

                <!-- Semester Selection -->
                <div class="form-group">
                    <label>Select Semesters *</label>
                    <div class="row">
                        @foreach(['1st Year', '2nd Year', '1st Semester', '2nd Semester', '3rd Semester', '4th Semester', '5th Semester', '6th Semester'] as $semester)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input semester-checkbox" type="checkbox" 
                                           name="selected_semesters[]" value="{{ $semester }}" 
                                           id="sem_{{ str_replace(' ', '_', $semester) }}"
                                           {{ in_array($semester, old('selected_semesters', $result->selected_semesters ?? [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sem_{{ str_replace(' ', '_', $semester) }}">
                                        {{ $semester }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Dynamic Semester Forms -->
                <div id="semesterForms">
                    @php
                        $selectedSemesters = old('selected_semesters', $result->selected_semesters ?? []);
                    @endphp
                    @foreach($selectedSemesters as $semester)
                        <div class="semester-form card mt-3" id="form_{{ str_replace(' ', '_', $semester) }}">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">{{ $semester }} Results</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="15%">Year</th>
                                                <th width="20%">Course Code</th>
                                                <th width="45%">Course Name</th>
                                                <th width="20%">Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $isYear = str_contains($semester, 'Year');
                                                $rowCount = $isYear ? 8 : 6;
                                                $semesterResults = old("semester_results.$semester", $result->semester_results[$semester] ?? []);
                                            @endphp
                                            @for($i = 0; $i < $rowCount; $i++)
                                            <tr>
                                                <td>
                                                    <input type="number" 
                                                           name="semester_results[{{ $semester }}][{{ $i }}][year]" 
                                                           class="form-control form-control-sm" 
                                                           min="2000" 
                                                           max="2030"
                                                           placeholder="Year"
                                                           value="{{ $semesterResults[$i]['year'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" 
                                                           name="semester_results[{{ $semester }}][{{ $i }}][course_code]" 
                                                           class="form-control form-control-sm" 
                                                           maxlength="20"
                                                           placeholder="Course Code"
                                                           value="{{ $semesterResults[$i]['course_code'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" 
                                                           name="semester_results[{{ $semester }}][{{ $i }}][course_name]" 
                                                           class="form-control form-control-sm" 
                                                           maxlength="255"
                                                           placeholder="Course Name"
                                                           value="{{ $semesterResults[$i]['course_name'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <select name="semester_results[{{ $semester }}][{{ $i }}][grade]" 
                                                            class="form-control form-control-sm">
                                                        <option value="">Select Grade</option>
                                                        @foreach(['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'D', 'F', 'P', 'I'] as $grade)
                                                            <option value="{{ $grade }}" 
                                                                {{ ($semesterResults[$i]['grade'] ?? '') == $grade ? 'selected' : '' }}>
                                                                {{ $grade }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label>Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="on" {{ old('status', $result->status) == 'on' ? 'selected' : '' }}>Active</option>
                        <option value="off" {{ old('status', $result->status) == 'off' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Result</button>
                <a href="{{ route('admin.result.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    @section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Edit semester form system initialized');
            
            const semesterForms = document.getElementById('semesterForms');
            const checkboxes = document.querySelectorAll('.semester-checkbox');

            // Function to generate semester form
            function generateSemesterForm(semester) {
                const formId = 'form_' + semester.replace(/\s+/g, '_');
                const isYear = semester.includes('Year');
                const rowCount = isYear ? 8 : 6;
                
                let formHTML = `
                <div class="semester-form card mt-3" id="${formId}">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">${semester} Results</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="15%">Year</th>
                                        <th width="20%">Course Code</th>
                                        <th width="45%">Course Name</th>
                                        <th width="20%">Grade</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                
                for (let i = 0; i < rowCount; i++) {
                    formHTML += `
                                    <tr>
                                        <td>
                                            <input type="number" 
                                                   name="semester_results[${semester}][${i}][year]" 
                                                   class="form-control form-control-sm" 
                                                   min="2000" 
                                                   max="2030"
                                                   placeholder="Year">
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   name="semester_results[${semester}][${i}][course_code]" 
                                                   class="form-control form-control-sm" 
                                                   maxlength="20"
                                                   placeholder="Course Code">
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   name="semester_results[${semester}][${i}][course_name]" 
                                                   class="form-control form-control-sm" 
                                                   maxlength="255"
                                                   placeholder="Course Name">
                                        </td>
                                        <td>
                                            <select name="semester_results[${semester}][${i}][grade]" 
                                                    class="form-control form-control-sm">
                                                <option value="">Select Grade</option>
                                                <option value="A+">A+</option>
                                                <option value="A">A</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B">B</option>
                                                <option value="B-">B-</option>
                                                <option value="C+">C+</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="F">F</option>
                                                <option value="P">Pass</option>
                                                <option value="I">Incomplete</option>
                                            </select>
                                        </td>
                                    </tr>`;
                }
                
                formHTML += `
                                </tbody>
                            </table>
                        </div>
                        <small class="text-muted">Fill in the course details for ${semester}. Leave blank if not applicable.</small>
                    </div>
                </div>`;
                
                return formHTML;
            }

            // Function to handle checkbox change
            function handleCheckboxChange() {
                const semester = this.value;
                const formId = 'form_' + semester.replace(/\s+/g, '_');
                
                console.log('Checkbox changed:', semester, 'Checked:', this.checked);
                
                if (this.checked) {
                    if (!document.getElementById(formId)) {
                        semesterForms.insertAdjacentHTML('beforeend', generateSemesterForm(semester));
                    }
                } else {
                    const formToRemove = document.getElementById(formId);
                    if (formToRemove) {
                        formToRemove.remove();
                    }
                }
            }

            // Add event listeners to all checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', handleCheckboxChange);
            });

            // Form submission validation
            document.getElementById('resultForm').addEventListener('submit', function(e) {
                const checkedBoxes = document.querySelectorAll('.semester-checkbox:checked');
                if (checkedBoxes.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one semester.');
                    return false;
                }
            });
        });
    </script>
    @endsection
</x-admin>