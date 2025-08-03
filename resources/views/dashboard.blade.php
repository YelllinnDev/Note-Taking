@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>

        .container {
            width:100%;
            margin: auto;
            padding: 0;
        }

        h2 {
            margin-bottom: 30px;
            color: #444;
        }

        /* Card Grid */
        .card-grid {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
            margin-bottom: 40px;
        }

        .card {
            width:250px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 24px;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-right: 16px;
            color: white;
        }

        .bg-blue { background-color: #4a90e2; }
        .bg-green { background-color: #28a745; }
        .bg-yellow { background-color: #ffc107; }

        .card h5 {
            margin: 0;
            font-weight: 500;
            font-size: 14px;
            color: #888;
        }

        .card h3 {
            margin: 5px 0 0;
            font-size: 22px;
            font-weight: 700;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        table th, table td {
            padding: 16px 20px;
            text-align: left;
        }

        table thead {
            background-color: #f6f6f6;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .highlight {
            background-color: #e6ffe6;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Dashboard Overview</h2>
    
    <div class="card-grid">
        @auth
            @if (auth()->check() && auth()->user()->role_id === 1)
                <div class="card">
                    <div class="icon bg-blue"> &#128274;</div>
                    <div>
                        <h5>Total Acc</h5>
                        <h3>{{ $totals['admins']+ $totals['users']}}</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="icon bg-blue">&#128105;</div>
                    <div>
                        <h5>Admins</h5>
                        <h3>{{ $totals['admins'] }}</h3>
                    </div>
                </div>
                <!-- Users -->
                <div class="card">
                    <div class="icon bg-green">&#128100;</div>
                    <div>
                        <h5>Users</h5>
                        <h3>{{ $totals['users'] }}</h3>
                    </div>
                </div>
            @endif
        @endauth
        

        <!-- Notes -->
        <div class="card">
            <div class="icon bg-yellow">&#128221;</div>
            <div>
                <h5>Notes</h5>
                <h3>{{ $totals['notes'] }}</h3>
            </div>
        </div>
    </div>
    @auth
        @if (auth()->check() && auth()->user()->role_id === 1)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $totals['records'] as $record)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->email }}</td>
                        <td>{{ $record->role->name }}</td>
                        <td>{{ $record->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Titles</th>
                        <th>Descriptions</th>
                        <th>Remind Date</th>
                        <th>Created_at</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach( $totals['records'] as $record)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $record->title }}</td>
                        <td>{{ $record->description }}</td>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endauth
    
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Highlight row on click
    $('table tbody tr').on('click', function () {
        $('table tbody tr').removeClass('highlight');
        $(this).addClass('highlight');
    });
</script>

</body>
</html>
@endsection
