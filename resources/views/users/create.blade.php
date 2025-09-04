@extends('layouts.app')
@section('content')
<!-- user create -->
<div class="coverBlk" id="userCreate">
    <div class="formBlk">
        <p class="titleCls">Create User</p>
        <form action="{{ route('users.create') }}" method="post" class="formCls">
            @csrf
            <div class="inputBlk">
                <label for="nameId" class="labCls">Name</label>
                <input type="text" name="name" id="nameId" class="inputCls" placeholder="Type here">
            </div>
            <div class="inputBlk">
                <label for="emailId" class="labCls">Email</label>
                <input type="email" name="email" id="emailId" class="inputCls" placeholder="Type here">
            </div>
            <div class="inputBlk">
                <label for="passwordId" class="labCls">Password</label>
                <div class="passBlk">
                    <input type="password" name="password" id="passwordId" class="inputCls passCls" placeholder="Type here">
                    <img src="{{ asset('img/visual.png') }}" alt="eye" class="eyeCls">
                </div>
                
            </div>
            <div class="inputBlk">
                <label for="comId" class="labCls">Comfirm password</label>
                <div class="passBlk">
                    <input type="password" name="comfirm_password" id="comId" class="inputCls passCls" placeholder="Type here">
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
<!-- user create end -->
@endsection