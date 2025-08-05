<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Utility classes replacement */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: sans-serif;
            background-color: #f8f9fa;
        }

        main.fullscreen-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            position:relative;
        }
        .alert{
            position:absolute;
            top:10px;
            z-index:1000;
            color:red;
        }

        .rounded-12 {
            border-radius: 5px;
        }

        /* Add more custom styles as needed */
    </style>
</head>
<body>
    <main class="fullscreen-center">
        {{-- Session Status --}}
    @if (session('status'))
        <div class="alert success">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @yield('content')
    </main>
    <script src="/jquerycase/jquery.js"></script>
    @push('scripts')

        <script>
            $(document).ready(function(){
            document.addEventListener('DOMContentLoaded', function() {
            // Select the success alert
                var alert = document.querySelector('.alert');
                
                // Show the alert
                if (alert) {
                    alert.style.display = 'block';
                    
                    // Hide the alert after 3 seconds
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 3000); // 3000 milliseconds = 3 seconds
                }
            });
            })
        </script>
    @endpush
</body>
</html>
