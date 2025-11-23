<!doctype html>
<html data-capo="">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bangladesh Open University - Result Search</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://result.bou.ac.bd/img/bou-logo-lg.png">
    <link rel="stylesheet" href="{{ asset('css/tailwind-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-theme.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div>
        <div>
            <div>
                <div class="min-h-screen flex flex-col bg-white">
                    <header class="sticky top-0 z-40 w-full border-b border-b-slate-200 bg-white/75 backdrop-blur-sm">
                        <div class="container mx-auto px-4">
                            <div class="flex h-16 items-center justify-center">
                                <a href="/">
                                    <div class="flex items-center">
                                        <img
                                            src="{{ asset('admin/dist/img/bou-logo-lg.png') }}"
                                            alt="BOU"
                                            class="img-fluid header-logo-img mt-2 mr-2"
                                            title="Bangladesh Open University"
                                            width="55"
                                            height="55"
                                        />
                                        <img
                                            src="https://result.bou.ac.bd/img/header.png"
                                            alt="Bangladesh Open University"
                                            width="350"
                                            height="55"
                                            class="img-fluid header-banner-img hidden md:block"
                                            title="Bangladesh Open University"
                                        />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </header>

                    <main class="flex-grow container mx-auto py-2 px-4 sm:px-6 lg:px-8">
                        <div class="text-center mt-4 mb-8">
                            <h2 class="text-3xl font-bold mb-2 text-gray-800">Search Your Result</h2>
                            <p class="text-sm text-gray-600">Enter your Student ID to view your results</p>
                        </div>

                        

                        <form method="GET" action="{{ route('result') }}" class="max-w-md mx-auto mb-8">
                            <div class="relative">
                                <input
                                    type="text"
                                    name="student_id"
                                    value="{{ old('student_id', $studentId ?? '') }}"
                                    placeholder="Enter student ID without (-)hyphen"
                                    class="w-full py-2 px-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent rounded-md"
                                    required
                                />
                                <button
                                    type="submit"
                                    class="absolute right-0 top-0 bottom-0 px-4 bg-gray-700 hover:bg-gray-800 text-white rounded-r-md"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="h-5 w-5"
                                    >
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.3-4.3"></path>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </form>

                        <!-- Display Messages -->
                        @if(session('error'))
                            <div class="bg-white shadow rounded-lg max-w-md mx-auto text-center py-6 text-red-600">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="max-w-md mx-auto mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(isset($result) && $result)
                       <div id="result-content" class="w-full max-w-4xl space-y-6 mx-auto">
                        <div class="flex justify-end mb-4">
                            <a
                                href="{{ route('result.download', $result->student_id) }}"
                                target="_blank"
                                class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md flex items-center no-print"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-download-icon h-5 w-5 mr-2"
                                >
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" x2="12" y1="15" y2="3"></line>
                                </svg>
                                <span>Download</span>
                            </a>
                        </div>
                            
                            <div class="bg-white shadow rounded-lg">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">Student Information</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Program:</dt>
                                            <dd class="">{{ $result->program }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Study Center:</dt>
                                            <dd class="">{{ $result->study_center }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Student ID:</dt>
                                            <dd class="">{{ $result->student_id }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Student Name:</dt>
                                            <dd class="">{{ $result->student_name }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Father Name:</dt>
                                            <dd class="">{{ $result->father_name }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Mother Name:</dt>
                                            <dd class="">{{ $result->mother_name }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Batch:</dt>
                                            <dd class="">{{ $result->batch }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">Passing Year:</dt>
                                            <dd class="">{{ $result->passing_year }}</dd>
                                        </div>
                                        <div class="flex justify-between sm:col-span-1">
                                            <dt class="font-semibold">G P A:</dt>
                                            <dd class="">{{ number_format($result->gpa_cgpa, 2) }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            @foreach($result->selected_semesters as $semester)
                            @if(isset($result->semester_results[$semester]))
                            <div class="bg-white shadow rounded-lg mt-6">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">{{ $semester }}</h3>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Exam Year/Term
                                                    </th>
                                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Course Code
                                                    </th>
                                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Course Name
                                                    </th>
                                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Letter Grade
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($result->semester_results[$semester] as $course)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $result->passing_year }}
                                                    </td>
                                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $course['course_code'] ?? 'N/A' }}
                                                    </td>
                                                    <td class="px-3 py-2 text-sm text-gray-500">
                                                        {{ $course['course_name'] ?? 'N/A' }}
                                                    </td>
                                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        {{ $course['grade'] ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach

                            <div class="bg-white shadow rounded-lg mt-6">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">Note</h3>
                                    <p class="text-sm text-gray-600">
                                        (-)- Waiver, AB- Absent, PR- Problem Related to OMR Sheet fill-up, RP- Expelled in the respective
                                        course, WH- Withheld, IC- Incomplete, NA- Not Applicable, X- No Grade Received
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </main>

                    <footer class="border-t border-slate-200 bg-white/75 backdrop-blur-sm mt-8">
                        <div class="container mx-auto px-4">
                            <div class="flex items-center justify-between py-4">
                                <p class="text-sm text-slate-600">© Bangladesh Open University.</p>
                                <div class="flex items-center space-x-4">
                                    <p class="text-sm text-slate-600">
                                        Development &amp; maintenance by:
                                        <a
                                            class="text-sm text-slate-600 hover:text-blue-600"
                                            href="https://bou.ac.bd/Division/ICTELearning"
                                            target="_blank"
                                            title="ICT Unit, ICT &amp; e-Learning Center, BOU"
                                        >
                                            ICT Unit, ICT &amp; e-Learning Center, BOU.
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        function downloadResult() {
            const element = document.getElementById('result-content');
            const options = {
                margin: 1,
                filename: 'result_{{ $result->student_id ?? "unknown" }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'cm', format: 'a4', orientation: 'portrait' }
            };
            
            html2pdf().set(options).from(element).save();
        }





        
    </script> -->


{{-- Add this script to your result.blade.php --}}
<script>
function downloadResult() {
    // Show loading
    const downloadBtn = event.target;
    const originalText = downloadBtn.innerHTML;
    downloadBtn.innerHTML = '<span>Generating PDF...</span>';
    downloadBtn.disabled = true;

    // Get the result content
    const element = document.getElementById('result-content');
    
    // Use html2pdf.js to generate blob
    const options = {
        margin: 0.5,
        filename: 'result_{{ $result->student_id ?? "unknown" }}.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { 
            scale: 2,
            useCORS: true,
            logging: false
        },
        jsPDF: { 
            unit: 'mm', 
            format: 'a4', 
            orientation: 'portrait' 
        }
    };
    
    html2pdf().set(options).from(element).toBlob().then(blob => {
        // Create blob URL
        const blobUrl = URL.createObjectURL(blob);
        
        // Open in new tab
        const newWindow = window.open(blobUrl, '_blank');
        
        // Revoke blob URL after some time
        setTimeout(() => {
            URL.revokeObjectURL(blobUrl);
        }, 1000);
        
        // Reset button
        downloadBtn.innerHTML = originalText;
        downloadBtn.disabled = false;
    }).catch(error => {
        console.error('PDF generation failed:', error);
        downloadBtn.innerHTML = originalText;
        downloadBtn.disabled = false;
        alert('Failed to generate PDF. Please try again.');
    });
}
</script>
</body>
</html>