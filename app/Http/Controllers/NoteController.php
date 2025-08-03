<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Note; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class NoteController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $role_id= $user->role_id;
        $validated = $request->validate([
                'title' => 'sometimes|string',
                'description' => 'sometimes|text',
                'date' => 'sometimes|date',
            ], [
                'date.date' => 'Date must be a valid date.YYYY-MM-DD',
        ]);
        $perPage = 10;
        $page = $request->input('page', 1);
        $query = Note::select('id','title', 'description', 'user_id', 'date', 'created_at')
                        ->with("user");
         if (isset($validated['title'])) {
            $query->where('title', $validated['title']);
        }
        if (isset($validated['description'])) {
            $query->where('description', $validated['description']);
        }

        if (isset($validated['date'])) {
            $query->where('date', $validated['date']);
        }

        $note = $query->orderBy('id', 'DESC')->paginate($perPage);
        return view('notes.index', ['notes' => $note]);
    }
    public function store(Request $request)
    {
        try{
            $usercase = Auth::user();
            $user=$usercase->id;
            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string|max:255',
                'date' => 'required|date_format:Y-m-d',
            ], [
                'title.required' => 'Title is required.',
                'title.string' => 'Title must be a string.',
                'description.required' => 'description is required.',
                'date.required' => 'Date is required.',
            ]);
            $note = Note::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'user_id' => $user,
                'date' => $validated['date'],
            ]);
           
            session()->flash('success', 'Note created successfully.');
            return redirect()->route('notes.index');

        } catch (\Exception $e) {
            // Flash error message if something fails
            session()->flash('error', 'Note creation failed. Please try again.');
            return redirect()->back(); // Go back to the previous page
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $validated = $request->validate([
                'title' => 'sometimes|string',
                'description' => 'sometimes|string|nullable',
                'date' => 'required|date_format:Y-m-d',
            ], [
                'title.string' => 'Title must be a string.',
                'date.date' => 'Date must be a valid date.(YYYY-MM-DD)',
            ]);

            // Find the user by ID
            $note = Note::findOrFail($id);

            // If password is provided, hash and update it
            if ($request->filled('password')) {
                $note->password = Hash::make($request->password);
            }

            // Update the user's information (except password if not provided)
            $note->update($validated);

            // Redirect to the list page with a success message and paginated results
            return redirect()->route('notes.index', ['page' => $request->input('page', 1)])
                            ->with('success', 'Note updated successfully!');

        } catch (\Exception $e) {
            // Flash error message if something fails
            session()->flash('error', 'Updating failed. Please try again.');
            return redirect()->back(); // Go back to the previous page
        }
    }
    public function edit(Request $request, $id)
    {
            // Find the user by ID or fail if not found
        $note = Note::findOrFail($id);
        
        // Return the edit view and pass the user data to it
        return view('notes.edit', compact('note'));
    }
    public function destroy($id)
    {
        $note = Note::find($id);
        if (!$note) {
            return redirect()->route('notes.index')->with('error', 'Note not found');
        }

        try {
            $note->delete();
            return redirect()->route('notes.index')->with('success', 'Note deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('notes.index')->with('error', 'Failed to delete note. Please try again.');
        }
    }
}
