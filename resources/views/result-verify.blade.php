<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bangladesh Open University - Verified Academic Record</title>
  <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 20px;
        background: #ffffff;
        color: #000000;
        font-size: 10px;
        line-height: 1.2;
    }

    .page {
        width: 100%;
        max-width: 210mm;
        margin: 0 auto;
        background: #ffffff;
        border: 1px solid #ccc;
        padding: 20px;
    }

    .topbar {
        height: 70px;
        position: relative;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-center {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-grow: 1;
    }

    .logo {
        width: 60px;
        height: 60px;
        margin-right: 15px;
    }

    .title {
        text-align: left;
    }

    .title h1 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #000000;
    }

    .title span {
        font-size: 14px;
        color: #000000;
    }

    .qr {
        width: 60px;
        height: 60px;
        background: #ffffff;
        padding: 3px;
        border: 1px solid #000000;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    table.info {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        margin-bottom: 8px;
    }

    table.info td {
        padding: 2px 4px;
        border: 1px solid #ccc;
    }

    table.info td.label {
        width: 120px;
        font-weight: unset;
    }

    .section-title {
        text-align: center;
        font-weight: bold;
        margin: 6px 0 3px;
        font-size: 12px;
        padding: 2px;
    }

    table.grades {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        margin-bottom: 5px;
    }

    table.grades th,
    table.grades td {
        border: 1px solid #ccc;
        padding: 2px 4px;
    }

    table.grades th {
        text-align: center;
        font-weight: bold;
    }

    .grades thead th:nth-child(1) {
        width: 80px;
    }

    .grades thead th:nth-child(3) {
        width: 60px;
        text-align: center;
    }

    table.grades td {
        padding: 1px 3px !important;
    }

    .note {
        font-size: 12px;
        margin-top: 8px;
        padding: 5px;
        border: 1px solid #ccc;
    }

    .footer {
        border-top: 1px solid #000000;
        padding: 8px 0;
        font-size: 12px;
        text-align: center;
        font-style: italic;
        margin-top: 8px;
    }

    .section {
        margin-bottom: 4px;
    }

    .content {
        padding: 0;
    }

    .main-content {
        min-height: auto;
    }

    * {
        color: #000000 !important;
        background-color: #ffffff !important;
    }

    th {
        font-weight: unset !important;
    }

    .qr-fallback {
        width: 50px;
        height: 50px;
        border: 1px solid #000;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 6px;
        background: #f9f9f9 !important;
    }

    .download-btn {
        display: inline-block;
        background: #2d3748;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        margin: 10px 0;
        font-size: 14px;
    }

    .download-btn:hover {
        background: #4a5568;
    }

    .verified-badge {
        background: #10b981;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        margin-left: 10px;
    }
  </style>
</head>
<body>
  <!-- <div style="text-align: center; margin-bottom: 20px;">
    <a href="{{ route('transcript.download', $result->student_id) }}" class="download-btn">
        📄 Download PDF Transcript
    </a>
    <span class="verified-badge">✅ Verified Online</span>
  </div> -->

  <div class="page">
    <div class="topbar">
      <div class="header-center">
        <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin/dist/img/bou-logo-lg.png'))) }}" alt="BOU logo">
        <div class="title">
          <h1>Bangladesh Open University</h1>
          <span>Higher Secondary Certificate<br>ACADEMIC RECORD (Online Verified Version)</span>
        </div>
      </div>

      <div class="qr">
        @if(!$qrCodeBase64)
          <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin/dist/img/qrn.png'))) }}" 
               width="70" height="70"
               alt="Verify Transcript">
        @else
          <div class="qr-fallback">
            <div style="font-weight: bold; margin-bottom: 2px;">VERIFY</div>
            <div style="font-size: 5px;">Online at:</div>
            <div style="font-size: 4px; margin: 1px 0;">bou.edu.bd</div>
            <div style="font-weight: bold;">ID: {{ substr($result->student_id, -4) }}</div>
          </div>
        @endif
        
      </div>
    </div>

    <div class="main-content">
      <div class="content">
        <table class="info">
          <tr>
            <td class="label">Student ID:</td>
            <td>{{ $result->student_id }}</td>
          </tr>
          <tr>
            <td class="label">Student Name:</td>
            <td>{{ $result->student_name }}</td>
          </tr>
          <tr>
            <td class="label">Father's Name:</td>
            <td>{{ $result->father_name }}</td>
          </tr>
          <tr>
            <td class="label">Mother's Name:</td>
            <td>{{ $result->mother_name }}</td>
          </tr>
          <tr>
            <td class="label">Academic Year/Batch:</td>
            <td>{{ $result->batch }}</td>
          </tr>
          <tr>
            <td class="label">Passing Year:</td>
            <td>{{ $result->passing_year }}</td>
          </tr>
          <tr>
            <td class="label">Result:</td>
            <td>{{ number_format($result->gpa_cgpa, 2) }}</td>
          </tr>
          <tr>
            <td class="label">Study Center:</td>
            <td>{{ $result->study_center }}</td>
          </tr>
        </table>

        @foreach($result->selected_semesters as $semester)
          @if(isset($result->semester_results[$semester]) && count($result->semester_results[$semester]) > 0)
            <div class="section">
              <div class="section-title">{{ $semester }}</div>
              <table class="grades">
                <thead>
                  <tr>
                    <th>Subject/Course<br>Code</th>
                    <th>Subject/Course Name</th>
                    <th>Letter Grade</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($result->semester_results[$semester] as $course)
                    <tr>
                      <td>{{ $course['course_code'] ?? 'N/A' }}</td>
                      <td>{{ $course['course_name'] ?? 'N/A' }}</td>
                      <td style="text-align:center">{{ $course['grade'] ?? 'N/A' }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        @endforeach

        <div class="note">
          <strong>Note 1:</strong>  (-) - Waiver,AB - Absent,PR - Problem Related to OMR Sheet fill-up,RP - Expelled in the respective course,WH- Withheld, IC - Incomplete,NA - Not Applicable,X - No Grade Received.
          <br><strong>Note 2:</strong> This is an officially verified online transcript. No signature required.
          <br><strong>Verified on:</strong> {{ date('F d, Y \a\t h:i A') }}
        </div>
      </div>
    </div>

    <div class="footer">All Rights Reserved by BOU. Developed &amp; Maintained by ICT Unit, BOU.</div>
  </div>
</body>
</html>