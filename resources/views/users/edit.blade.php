@extends('layouts.app')
@section('content')
<!-- user edit -->
<div class="coverBlk" id="userEdit">
    <div class="formBlk">
        <p class="titleCls">Edit User</p>
        <form action="{{ route('users.update', $user->id) }}" method="post" class="formCls">
            @csrf
            @method('PUT')
            <div class="inputBlk">
                <label for="ednameId" class="labCls">Name</label>
                <input type="text" name="name" id="ednameId" class="inputCls" placeholder="Type here" value="{{ $user->name }}">
            </div>
            <div class="inputBlk">
                <label for="edemailId" class="labCls">Email</label>
                <input type="email" name="email" id="edemailId" class="inputCls" placeholder="Type here" value="{{ $user->email }}">
            </div>
            <div class="inputBlk">
                <label for="edpasswordId" class="labCls">Password</label>
                <div class="passBlk">
                    <input type="password" name="password" id="edpasswordId" class="inputCls passCls" placeholder="Type here">
                    <img src="{{ asset('img/visual.png') }}" alt="eye" class="eyeCls">
                </div>
                
            </div>
            <div class="inputBlk">
                <label for="edcomId" class="labCls">Comfirm password</label>
                <div class="passBlk">
                    <input type="password" name="comfirm_password" id="edcomId" class="inputCls passCls" placeholder="Type here">
                    <img src="{{ asset('img/visual.png') }}" alt="eye" class="eyeCls">
                </div>
            </div>
            <div class="formBtn">
                <button type="submit" class="comfirmCls">Save</button>
                <a href="{{route('users.index')}}">
                    <button type="button" class=" comfirmCls cancleBtn">Cancel</button>
                </a>
            </div>
            
        </form>
        
    </div>
</div>
<!-- user edit end -->
@endsection