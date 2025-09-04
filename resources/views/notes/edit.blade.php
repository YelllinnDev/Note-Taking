@extends('layouts.app')
@section('content')
<div class="coverBlk" id="noteEdit">
    <div class="formBlk">
        <!-- <img src="{{ asset('img/x-button.png') }}" alt="" class="canCls"> -->
        <p class="titleCls">Edit Note</p>
        <form method="post" action="{{ route('notes.update', $note->id) }}"  class="formCls">
            @csrf
            @method('PUT')
            <div class="inputBlk">
                <label for="edtitleId" class="labCls">Title</label>
                <input type="text" name="title" id="edtitleId" class="inputCls" placeholder="Type here" value="{{ $note->title }}">
            </div>
            <div class="inputBlk">
                <label for="eddescId" class="labCls">Description</label>
                <textarea name="description" id="eddescId" class="textarCls" placeholder="Type here">{{ $note->description??'-' }}</textarea>
            </div>
            <div class="formBtn">
                <button type="submit" class="comfirmCls">Update</button>
                <a href="{{route('notes.index')}}">
                    <button type="button" class=" comfirmCls cancleBtn">Cancel</button>
                </a>
            </div>
            
        </form>
        
    </div>
</div>
<!-- end note edit -->
@endsection