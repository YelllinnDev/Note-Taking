@extends('layouts.app')

@section('title', 'Users')

@section('content')
 @auth
    @if (auth()->check() && auth()->user()->role_id === 1)
        <style>
            .card {
                background: rgba(255, 255, 255, 0.9);
                border-radius: 16px;
                padding: 30px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
                backdrop-filter: blur(10px);
                overflow-x: auto;
            }

            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .card-header h2 {
                font-size: 24px;
                font-weight: 600;
                color: #333;
            }

            .btn-create {
                background-color: #4f46e5;
                color: white;
                padding: 10px 18px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 14px;
                transition: background-color 0.3s ease;
                text-decoration: none;
            }

            .btn-create:hover {
                background-color: #4338ca;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                background: white;
                border-radius: 12px;
                overflow: hidden;
            }

            table thead {
                background-color: #f1f5f9;
            }

            th, td {
                padding: 14px 20px;
                text-align: left;
                border-bottom: 1px solid #e5e7eb;
            }

            tbody tr:hover {
                background-color: #f9fafb;
            }
            
        </style>

        <div class="card">
            <div class="card-header">
                <h2>Users</h2>
                @auth
                    @if (auth()->check() && auth()->user()->role_id !== 2)
                        <a href="{{ url('/users/create') }}" class="btn-create">+ Create New</a>
                    @endif
                @endauth
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}">Edit</a> |
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No user found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endsection
    @endif
@endauth

