@extends('layouts.app')
@section('content')
    @auth
    @if (auth()->check() && auth()->user()->role_id === 1)
    <div class="mainContentBlk">
        <div class="actionBlk">
            <input type="text" class="searchCls" name="searchName" id="usersearchName" placeholder="Search..." value="{{$src}}">
            <a href="{{ route('users.index') }}">
                <div class="newBlk resetCls refresh" id="newNote">
                    <!-- <img src="img/refresh.png" alt="" class="addCls"> -->
                    <p class="newCls">Refresh</p>
                </div>
            </a>
            <a href="{{ url('/users/create') }}">
                <div class="newBlk" id="newNote">
                    <img src="img/add.png" alt="" class="addCls">
                    <p class="newCls">New</p>
                </div>
            </a>
        </div>
        <div class="usDataBlk" >
            <div class="totalBlk">
                <div class="counBlk">
                    <div class="imgBlk">
                        <img src="img/group.png" alt="" class="countsetImg">
                    </div>
                    <div class="totBlk">
                        <p class="totTi">Accounts</p>
                        <p class="totNum">{{ $account ?? '-' }}</p>
                    </div>
                </div>
                <div class="counBlk">
                    <div class="imgBlk">
                        <img src="img/admin.png" alt="" class="countsetImg">
                    </div>
                    <div class="totBlk">
                        <p class="totTi">Admins</p>
                        <p class="totNum">{{ $admin ?? '-' }}</p>
                    </div>
                </div>
                <div class="counBlk">
                    <div class="imgBlk">
                        <img src="img/normal.png" alt="" class="countsetImg">
                    </div>
                    <div class="totBlk">
                        <p class="totTi">Users</p>
                        <p class="totNum">{{ $user ?? '-' }}</p>
                    </div>
                </div>
                <div class="counBlk">
                    <div class="imgBlk">
                        <img src="img/notepad.png" alt="" class="countsetImg">
                    </div>
                    <div class="totBlk">
                        <p class="totTi">Notes</p>
                        <p class="totNum">{{ $note ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="usertableBlk">
                <table>
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btnCls">
                                        <a href="{{ route('users.edit', $user->id) }}">
                                            <img src="img/pen.png" alt="" class="noteActionCls userEditCls">
                                        </a> 
                                        <button type="button" class="noteDelCls">
                                            <img src="img/delete.png" data-id="{{$user->id}}" data-roucase="users" alt="Delete" class="noteActionCls noteDeleteCls">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No user found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="paginationBlk">
                {{ $users->links('pagination::default') }}
            </div>
        </div>
    </div>
    <script>
        $("#usersearchName").on("keydown", function(e) {
            if (e.key === "Enter") {
                const name = $(this).val();
                const url = `{{ route('users.index') }}?name=${encodeURIComponent(name)}`;
                window.location.href = url;
            }
        });
    </script>
    @endif
    @endauth
@endsection