<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container mt-5">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    <div class="container mt-5">
        <h1>NEO (Near Earth Objects) List</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size (Diameter in KM)</th>
                    <th>Potentially Hazardous</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($neoData as $date => $objects)
                    @foreach ($objects as $object)
                        <tr>
                            <td>{{ $object['name'] }}</td>
                            <td>
                                {{ $object['estimated_diameter']['kilometers']['estimated_diameter_min'] }} - 
                                {{ $object['estimated_diameter']['kilometers']['estimated_diameter_max'] }} km
                            </td>
                            <td>{{ $object['is_potentially_hazardous_asteroid'] ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="/dashboard/neo/{{ $object['id'] }}" class="btn btn-primary">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
