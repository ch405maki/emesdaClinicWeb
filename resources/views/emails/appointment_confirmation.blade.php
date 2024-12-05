<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }
        h1 {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Confirmation</h1>
        <p>Hello, {{ $data['user_name'] }}!</p>
        <p>We are pleased to confirm your appointment.</p>
        <p><strong>Date and Time:</strong> {{ $data['appointment_date'] }}</p>
        <p>If you have any questions, feel free to contact us at <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.name') }}</a>.</p>
        <p>Thank you for choosing Emesda Dental Clinic!</p>
    </div>
</body>
</html>
