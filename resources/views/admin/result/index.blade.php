<x-admin>
    @section('title', 'Results')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Result List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.result.create') }}" class="btn btn-sm btn-info">New Result</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Batch</th>
                        <th>Passing Year</th>
                        <th>GPA/CGPA</th>
                        <th>Semesters</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                        <tr>
                            <td>{{ ($results->currentPage() - 1) * $results->perPage() + $loop->iteration }}</td>
                            <td>{{ $result->student_id }}</td>
                            <td>{{ $result->student_name }}</td>
                            <td>{{ $result->batch }}</td>
                            <td>{{ $result->passing_year }}</td>
                            <td>{{ $result->gpa_cgpa }}</td>
                            <td>{{ $result->formatted_semesters }}</td>
                            <td>
                                <span class="badge badge-{{ $result->status === 'on' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($result->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.result.show', $result) }}" 
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.result.edit', $result) }}" 
                                       class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.result.destroy', $result) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                title="Delete" onclick="return confirm('Are you sure you want to delete this result?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No results found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $results->links() }}
            </div>
        </div>
    </div>
</x-admin>