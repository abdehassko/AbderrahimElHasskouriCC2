<h2>Appointment Confirmed</h2>

<p>Hello {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>

<p>Your appointment is confirmed:</p>

<ul>
    <li>
        Doctor: {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
    </li>
    <li>Service: {{ $appointment->service->name }}</li>
    <li>Date: {{ $appointment->appointment_date }}</li>
</ul>
