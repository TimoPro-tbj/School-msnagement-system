<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Teachers Test PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Teachers Test List (100 Records)</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>course</th>
                <th>grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['course'] }}</td>
                    <td>{{ $student['grade'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
