<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEO Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>NEO Details: {{ $neoDetails['name'] }}</h1>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> {{ $neoDetails['id'] }}</li>
            <li class="list-group-item"><strong>Designation:</strong> {{ $neoDetails['designation'] }}</li>
            <li class="list-group-item"><strong>Absolute Magnitude:</strong> {{ $neoDetails['absolute_magnitude_h'] }}</li>
            <li class="list-group-item"><strong>Is Potentially Hazardous:</strong> {{ $neoDetails['is_potentially_hazardous_asteroid'] ? 'Yes' : 'No' }}</li>
            <li class="list-group-item"><strong>NASA JPL URL:</strong> <a href="{{ $neoDetails['nasa_jpl_url'] }}" target="_blank">View NASA Data</a></li>
        </ul>
        <a href="/dashboard" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
