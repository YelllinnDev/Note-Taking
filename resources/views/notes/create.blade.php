@extends('layouts.app')

@section('title', 'Notes')

@section('content')
<style>
    .notediv{
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .note-form {
      background: white;
      padding: 30px 40px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      max-width: 500px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .note-form h2 {
      margin-bottom: 24px;
      font-weight: 600;
      color: #333;
      text-align: center;
    }

    .form-group {
      margin-bottom: 5px;
    }

    label {
      display: block;
      font-weight: 500;
      margin-bottom: 8px;
      color: #444;
    }

    input[type="text"],
    input[type="date"],
    textarea {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s;
      outline: none;
    }

    input:focus,
    textarea:focus {
      border-color: #6c63ff;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    button {
      display: inline-block;
      width: 100%;
      background: linear-gradient(to right, #6c63ff, #4e54c8);
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      padding: 14px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: linear-gradient(to right, #574b90, #4e54c8);
    }
  </style>
  <div class="notediv">
    <form action="{{ route('notes.create') }}" method="POST" class="note-form">
        @csrf
        <h2>Create a New Note</h2>
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter note title" required />
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Write your note..." required></textarea>
        </div>

        <div class="form-group">
            <label for="date">Remind Date</label>
            <input type="date" id="date" name="date" required />
        </div>

        <button type="submit">Save Note</button>
    </form>

  </div>
    

@endsection