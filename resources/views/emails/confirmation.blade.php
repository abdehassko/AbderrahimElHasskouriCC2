<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-left: 4px solid #007bff;
        }
        strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Appointment Is Officially Booked!</h2>

        <p>Hi {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }},</p>

        <p>Great news! Your appointment has been confirmed and everything is ready for your visit.</p>

        <ul>
            <li>
                <strong>Doctor:</strong>
                {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
            </li>
            <li><strong>Service:</strong> {{ $appointment->service->name }}</li>
            <li><strong>Date:</strong> {{ $appointment->appointment_date }}</li>
        </ul>

        <p>Thank you for choosing us. We look forward to providing you with exceptional care.</p>
        <p>If you need to make any changes, please get in touch as soon as possible.</p>
    </div>
</body>
</html>
