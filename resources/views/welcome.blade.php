<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | {{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .navbar .brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 1rem;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .navbar ul li a,
        .navbar ul li button {
            padding: 0.5rem 1rem;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 1rem;
        }

        .navbar .btn-primary {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 5px;
        }

        /* Hero */
        .hero {
            background: linear-gradient(to right, #0d6efd, #6610f2);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .hero .btn {
            background-color: #fff;
            color: #0d6efd;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        /* Features */
        .features {
            padding: 4rem 2rem;
            background-color: #fff;
            text-align: center;
        }

        .features h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .feature-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }

        .card {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        h5{
            font-size: 1.2rem;
        }

        .card h5 {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        /* CTA Section */
        .cta {
            background-color: #f1f1f1;
            padding: 4rem 2rem;
            text-align: center;
        }

        .cta h2 {
            margin-bottom: 1rem;
        }

        .cta p {
            margin-bottom: 2rem;
        }

        .cta .btn-primary {
            background-color: #0d6efd;
            color: white;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
        .btn{
            border:1px solid #0d6efd !important;
            border-radius: 3px;
            transition:0.5s;
        }
        .btn:hover{
            background-color: #0d6efd;
            color:whitesmoke;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .feature-grid {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="brand">{{ config('app.name', 'Laravel') }}</div>
        <ul>
            <!-- <li><a href="#">Home</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">Pricing</a></li> -->
            <li><a class="btn" href="{{ route('login') }}">Login</a></li>
            <li><a class="btn" href="{{ route('register') }}">Register</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to {{ config('app.name', 'Laravel') }}</h1>
        <p>"We turn your ideas into modern web applications, quickly and effortlessly."</p>
        <a href="{{ route('register') }}" class="btn">Get Started</a>
    </section>

    <!-- Features -->
    <section class="features">
        <h2>Why Choose Us?</h2>
        <div class="feature-grid">
            <div class="card">
                <h5>Fast Development</h5>
                <p>We streamline the development process so you can launch your robust, high‑performance apps in record time.</p>
            </div>
            <div class="card">
                <h5>Modern Technology</h5>
                <p>Our stack uses the latest frameworks and best practices to keep your app secure, efficient, and ahead of the curve.</p>
            </div>
            <div class="card">
                <h5>Expert Support</h5>
                <p>From planning to deployment, our team is here to ensure every step of your journey is smooth and successful.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Ready to get started?</h2>
        <p>"Join the community — thousands building better notes together."</p>
        <a href="{{ route('register') }}" class="btn-primary">Create Your Account</a>
    </section>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
    </footer>

</body>
</html>
