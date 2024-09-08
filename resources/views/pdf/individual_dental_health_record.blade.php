<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Individual Dental Health Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            margin-bottom: 10px;
        }
        .section dl {
            display: flex;
            flex-wrap: wrap;
        }
        .section dt, .section dd {
            width: 50%;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('path/to/logo.png') }}" alt="Logo">
        <h1>Kalinga State University</h1>
        <h2>Individual Dental Health Record</h2>
    </div>
    <div class="section">
        <h3>Diagnostic Information</h3>
        <dl>
            <dt>Description:</dt>
            <dd>{{ $latestDiagnostic->description ?? 'No diagnostic available' }}</dd>
            <dt>Service Rendered:</dt>
            <dd>{{ $latestDiagnostic->service_rendered ?? 'No Service Rendered available' }}</dd>
            <dt>Remarks:</dt>
            <dd>{{ $latestDiagnostic->remarks ?? 'No Remarks available' }}</dd>
        </dl>
    </div>
    <div class="section">
        <h3>Appointment Information</h3>
        <dl>
            <dt>Status:</dt>
            <dd>{{ $appointment->status }}</dd>
            <dt>Appointment Date:</dt>
            <dd>{{ $appointment->appointment_date->format('F j, Y, g:i a') }}</dd>
            <!-- Add more fields as needed -->
        </dl>
    </div>
    <div class="section">
        <h3>Student Information</h3>
        <dl>
            <dt>Name:</dt>
            <dd>{{ $appointment->student->name }}</dd>
            <dt>Email:</dt>
            <dd>{{ $appointment->student->email }}</dd>
            <!-- Add more fields as needed -->
        </dl>
    </div>
    <div class="section">
        <h3>Dentist Information</h3>
        <dl>
            <dt>Name:</dt>
            <dd>{{ $appointment->dentist->name }}</dd>
            <dt>Email:</dt>
            <dd>{{ $appointment->dentist->email }}</dd>
        </dl>
    </div>
</body>
</html>