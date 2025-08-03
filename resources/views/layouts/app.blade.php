<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <title>@yield('title', 'Dashboard') | {{ config('app.name', 'Laravel') }}</title>

  <style>
    :root {
      --primary: #4F46E5;
      --secondary: #F1F5F9;
      --text: #1F2937;
      --background: #F9FAFB;
      --sidebar-bg: #ffffffcc;
      --card-bg: #ffffffb3;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--background);
      color: var(--text);
    }

    #wrapper {
      display: flex;
      min-height: 100vh;
      background: var(--background);
    }

    /* Sidebar */
    #sidebar-wrapper {
      width: 250px;
      background: var(--sidebar-bg);
      backdrop-filter: blur(10px);
      border-right: 1px solid #e2e8f0;
      transition: all 0.3s ease;
      z-index: 999;
    }

    .sidebar-heading {
      height:50px;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      border-bottom: 1px solid #e5e7eb;
      color: var(--primary);
      display:flex;
      justify-content: center;
      align-items: center;
    }
    .nav-links a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 20px;
      color: #374151;
      text-decoration: none;
      border-bottom: 1px solid #f1f1f1;
      transition: 0.3s;
    }

    .nav-links a:hover {
      background-color: var(--secondary);
      color: var(--primary);
    }

    .nav-links a.active {
      background-color: var(--primary);
      color: white;
    }

    .nav-links i {
      font-size: 18px;
    }

    /* Page Content */
    #page-content-wrapper {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .topbar {
      background-color: #fff;
      height:50px;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      border-bottom: 1px solid #e5e7eb;
    }
    .menu{
      width:50px;
      height:50px;
    }
    .menu-toggle {
      font-size: 24px;
      cursor: pointer;
      /* display: none; */
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-right:15px;
    }

    .user-info img {
      border-radius: 50%;
      width: 36px;
      height: 36px;
    }

    .user-info span {
      font-weight: 500;
      font-size: 14px;
    }

    button.logout-btn {
      background: none;
      border: none;
      color: var(--primary);
      cursor: pointer;
      font-size: 14px;
    }

    .main-content {
      padding: 30px;
      flex-grow: 1;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      #sidebar-wrapper {
        position: absolute;
        left: -260px;
        top: 0;
        height: 100%;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      }

      #wrapper.toggled #sidebar-wrapper {
        left: 0;
      }
    }
    .alert{
      position:fixed;
      bottom:20px;
      right:10px;
      z-index:1000;
      height:40px;
      border-radius:8px;
      display:flex;
      justify-content: center;
      align-items: center;
      color:#f1f1f1;
      padding:5px;
    }
    .success{
      background-color: green;
    }
    .danger{
      background-color:red;
    }
    
    nav{
        width:100% !important;
        display:flex !important;
        justify-content: space-between !important;
    }

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;  /* Align to the right */
        gap: 10px; /* Adds space between pagination links */
    }

    /* Pagination Links Styling */
    .pagination .page-link {
        padding: 8px 14px;
        background: white;
        border: 1px solid #ddd;
        color: #333;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.2s ease;
    }

    /* Pagination Links Hover Effect */
    .pagination .page-link:hover {
        background-color: #f0f0f0;
        color: #333;
    }

    /* Active Pagination Link Styling */
    .pagination .active .page-link {
        background-color: #4f46e5;  /* Blue color */
        color: white;
        border-color: #4f46e5;
    }

    /* Disabled Link (Previous/Next) Styling */
    .pagination .disabled .page-link {
        background-color: #f9f9f9;
        color: #ddd;
        cursor: not-allowed;
    }
    ul li::marker, ol li::marker {
        all: unset; /* Reset all inherited styles */
    }
    .small{
      display: none !important;
    }
    .page-item{
      list-style: none;
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <!-- Display success message -->
        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display error message -->
        @if(session('error'))
            <div class="alert danger">
                {{ session('error') }}
            </div>
        @endif
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <div class="sidebar-heading">
        {{ config('app.name', 'Laravel') }}
      </div>
      <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
          <i>&#127968;</i> Dashboard
        </a>
        @auth
          @if (auth()->check() && auth()->user()->role_id === 1)
                <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}">
                  <i>&#128101;</i> Users
                </a>
          @endif
        @endauth
        
        <a href="{{ route('notes.index') }}" class="{{ request()->is('notes*') ? 'active' : '' }}">
          <i>&#9881;</i> Notes
        </a>
      </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <!-- Top Bar -->
      <div class="topbar">
        <div class="user-info">
          <img src="https://i.pravatar.cc/40" alt="User Avatar">
          <span>{{ Auth::user()->name ?? 'Guest' }}</span>
          @auth
          <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
          </form>
          @endauth
        </div>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $(function () {
        $('.menu-toggle').on('click', function () {
          $('#wrapper').toggleClass('toggled');
        });

        $('.nav-links a').on('click', function () {
          $('.nav-links a').removeClass('active');
          $(this).addClass('active');
        });
      });
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
</body>
</html>
