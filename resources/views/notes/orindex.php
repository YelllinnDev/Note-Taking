@extends('layouts.app')

@section('title', 'Notes')

@section('content')
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

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .pagination .page-link {
        padding: 8px 14px;
        background: white;
        border: 1px solid #ddd;
        color: #333;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .pagination .page-link:hover {
        background-color: #f0f0f0;
    }

    .pagination .active span {
        background-color: #4f46e5;
        color: white;
        border-color: #4f46e5;
    }
</style>

<div class="card">
    <div class="card-header">
        <h2>Notes</h2>
        @auth
            @if (auth()->check() && auth()->user()->role_id !== 1)
                <a href="{{ url('/notes/create') }}" class="btn-create">+ Create New</a>
            @endif
        @endauth
        
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Titles</th>
                <th>Descriptions</th>
                <th>Remind Date</th>
                <th>Created_at</th>
                @auth
                    @if (auth()->check() && auth()->user()->role_id === 2)
                        <th>Actions</th>
                    @endif
                @endauth
                
            </tr>
        </thead>
        <tbody>
           @forelse ($notes as $index => $note)
                <tr>
                    <td>{{ $notes->firstItem() + $index }}</td>
                    <td>{{ $note->user->name ?? 'Unknown'}}</td>
                    <td>{{ $note->title }}</td>
                    <td>{{ $note->description }}</td>
                    <td>{{ $note->date }}</td>
                    <td>{{ $note->created_at->format('M d, Y') }}</td>
                    @auth
                        @if (auth()->check() && auth()->user()->role_id === 2)
                             <td>
                                <a href="{{ route('notes.edit', $note->id) }}">Edit</a> |
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>
                                </form>
                            </td>
                        @endif
                    @endauth
                   
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center">No notes found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $notes->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
