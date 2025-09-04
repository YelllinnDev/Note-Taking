<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Note</title>
    <link rel="stylesheet" href="{{ asset('css/native.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
    @if(session('success'))
    <div class="coverBlk" id="alertBox">
        <div class="delalertBlk">
            <img src="img/check.png" alt="" class="delalertImg successImg">
            <p class="warningText successText">Note successfully inserted!</p>
            <div class="detBtnBlk">
                <button type="button" class="delcomCls alertOk">Ok</button>
            </div>
        </div>
    </div>
    @endif
    @if(session('error'))
    @endif
    <div class="mainblock">
        <!-- deleteComfirmation -->
        <div class="coverBlk alertcase" id="deleteComfirm">
            <div class="delalertBlk">
                <img src="{{ asset('img/exclamation.png') }}" alt="" class="delalertImg">
                <p class="warningText">Are you sure!</p>
                <div class="detBtnBlk">
                    <input type="hidden" name="" id="delvalId" data-idcase="" data-roucase="">
                    <button type="button" class="delcomCls delbth">Yes</button>
                    <button type="button" class="delcomCls delcanCls">Cancel</button>
                </div>
            </div>
        </div>
        <!-- end Delete -->
        <!-- alertBox -->
        <div class="coverBlk alertcase" id="alertBox">
            <div class="delalertBlk deleteBlk">
                <img src="{{ asset('img/check.png') }}" alt="" class="delalertImg successImg">
                <p class="warningText successText">Successfully!</p>
            </div>
        </div>
        <!-- end aler box -->
        <div class="topvar">
            <img src="{{ asset('img/favicon.png') }}" alt="" class="logoCls">
            <p class="logoText">Welcome, Note Taking!</p>
            <div class="topActionBlk">
                <div class="setBlk">
                    <img src="{{ asset('img/setting.png') }}" alt="" class="settingCls" id="setId">
                    <div class="proLoBlk" id="prolog">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('img/user.png') }}" alt="" class="setImg">
                                    <button type="button">Profile</button> 
                                </a>
                                
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a href="#">
                                        <img src="{{ asset('img/switch.png') }}" alt="" class="setImg">
                                        <button type="submit">Logout</button>
                                    </a>
                                    
                                    
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bodyBlock">
            @yield('content')
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        $(document).on("click","#setId",function(){
            $("#prolog").toggleClass("show");
        })
        $(document).on("click",".canCls, .cancleBtn",function(){
            $("#noteCreate, #noteEdit, #deleteComfirm, #userCreate, #userEdit").removeClass("show");
        })
        $(document).on("click",".delcanCls",function(){
            $("#delvalId").attr("data-idcase","");
            $("#delvalId").attr("data-roucase","");
            $("#deleteComfirm").removeClass("show");
        })
        $(document).on("click",".alertOk",function(){
            $("#alertBox").removeClass("show");
        });
        $(document).on("click",".logoCls",function(){
            $("#alertBox").addClass("show");
        });
        $(document).on("click",".userEditCls",function(){
            $("#userEdit").addClass("show");
        });
        $(document).on("click","#newUser",function(){
            $("#userCreate").addClass("show");
        });
       
        $('.eyeCls').on('click', function() {
            const passwordField = $(this).siblings(".inputCls"); // Removed space from class selector
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);

            // Change text or icon based on type
            $(this).text(type === 'password' ? 'Show' : 'Hide');
        });
        $(document).on("click",".noteDeleteCls, .userDeleteCls",function(){
            const idcase=$(this).data("id");
            const roucase=$(this).data("roucase");

            $("#delvalId").attr("data-idcase",idcase);
            $("#delvalId").attr("data-roucase",roucase);
            $("#deleteComfirm").addClass("show");
        });
        $(document).on("click", ".delbth", function() {
            $("#deleteComfirm").removeClass("show");
            const id = $(this).siblings().data("idcase");
            const roucase = $(this).siblings().data("roucase");
            console.log(id);
            console.log(roucase);
            const routercase=`/${roucase}/${id}`;
            deletecase(id, routercase, roucase, ".successText");
        });

        function deletecase(id, routercase,rouname, uiID) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(routercase, {
                method: 'POST', // using method spoofing
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ _method: 'DELETE' }) // 👈 spoof delete
            })
            .then(res => res.text()) // you'll get the redirected HTML
            .then(html => {
                // replace page content or just reload
                if(rouname ==`users`){
                    window.location.href = '/users';
                    $("#alertBox").addClass("show");
                }else{
                    window.location.href = '/notes';
                    $("#alertBox").addClass("show");
                }
                  // force redirect like normal
            });
        }

        
    })
</script>