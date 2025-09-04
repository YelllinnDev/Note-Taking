@extends('layouts.app')
@section('content')
<!-- new note -->
<div class="coverBlk" id="noteCreate">
    <div class="formBlk">
        <p class="titleCls">Create Note</p>
        <form action="{{ route('notes.create') }}" method="post" class="formCls">
            @csrf
            <div class="inputBlk">
                <label for="titleId" class="labCls">Title</label>
                <input type="text" name="title" id="titleId" class="inputCls" placeholder="Type here">
            </div>
            <div class="inputBlk">
                <label for="descId" class="labCls">Description</label>
                <textarea name="description" id="descId" class="textarCls" placeholder="Type here"></textarea>
            </div>
            <div class="formBtn">
                <button type="submit" class="comfirmCls">Save</button>
                <a href="{{route('notes.index')}}">
                    <button type="button" class=" comfirmCls cancleBtn">Cancel</button>
                </a>
            </div>
            
        </form>
        
    </div>
</div>
<!-- end note create -->
@endsection