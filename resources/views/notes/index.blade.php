@extends('layouts.app')
@section('content')
<div class="mainContentBlk">
    <div class="actionBlk">
        <input type="text" name="searchName" class="searchCls" id="notesearchName" placeholder="Search..." value="{{$src}}">
        <a href="{{ route('notes.index') }}">
            <div class="newBlk resetCls refresh" id="newNote">
                <!-- <img src="img/refresh.png" alt="" class="addCls"> -->
                <p class="newCls">Refresh</p>
            </div>
        </a>
        <a href="{{ url('/notes/create') }}">
            <div class="newBlk" id="newNote">
                <img src="img/add.png" alt="" class="addCls">
                <p class="newCls">New</p>
            </div>
        </a>
    </div>
    <div class="dataBlk">
        <div class="totalBlk">
            <div class="counBlk">
                <div class="imgBlk">
                    <img src="img/notepad.png" alt="" class="countsetImg">
                </div>
                <div class="totBlk">
                    <p class="totTi">Total Notes</p>
                    <p class="totNum">30</p>
                </div>
            </div>
        </div>
    @forelse ($notes as $index => $note)
        <div class="noteBlk">
            <div class="titleBlk">
                <div class="titleTime">
                    <p class="noteTitleCls">{{ $note->title??'-' }}
                        <span>
                            (
                            <span>6-hours ago</span>
                            )
                        </span>
                    </p>
                    
                </div>
                
                <div class="noteActinBlk">
                    <a href="{{ route('notes.edit', $note->id??'-') }}">
                        <img src="img/pen.png" alt="Edit" class="noteActionCls noteEditCls">
                    </a>
                    <button type="button" class="noteDelCls">
                        <img src="img/delete.png" data-id="{{$note->id}}" data-roucase="notes" alt="Delete" class="noteActionCls noteDeleteCls">
                    </button>
                </div>
            </div>
            <div class="contentBlk">
                <p>{{ $note->description??'-' }}</p>
            </div>
        </div>
    @empty
    @endforelse
    </div>
</div>
<script>
    $("#notesearchName").on("keydown", function(e) {
        if (e.key === "Enter") {
            const name = $(this).val();
            const url = `{{ route('notes.index') }}?title=${encodeURIComponent(name)}`;
            window.location.href = url;
        }
    });
</script>
@endsection