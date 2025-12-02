<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sweat2Share - Citizen Dashboard</title>

    <!-- Figtree Font -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #233D4D;
            --bg-color: #F8F9FB;
            --accent-orange: #F57E30;
            --text-light: #495E6F;
            --border-color: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Figtree', sans-serif;
        }

        body {
            display: flex;
            background-color: var(--bg-color);
            height: 100vh;
            overflow: hidden;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: 260px; 
            background-color: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start; 
            padding: 30px;
            flex-shrink: 0;
        }

        .logo-area {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
            width: 100%;
            padding-left: 10px;
        }

        .sidebar-logo {
            height: 40px; 
            width: auto; 
            max-width: 100%; 
            object-fit: contain;
        }

        .nav-links {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: auto; 
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 16px;
            color: #8A9AB0;
            text-decoration: none; 
            padding: 12px 0;
            width: 100%;
            transition: 0.3s;
            position: relative;
        }

        .nav-item.active {
            color: #F57E30;
        }
                
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #F57E30;
            border-radius: 0 4px 4px 0;
            box-shadow: 4px 0 15px rgba(245, 126, 48, 0.4);
        }

        .nav-item:hover { color: white; }
                
        .user-bottom {
            display: flex;
            flex-direction: row; 
            align-items: center;
            width: 100%;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 20px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #555;
        }

        .user-info {
            flex: 1;
        }
                
        .user-name { font-size: 14px; font-weight: 700; color: white; display: block;}
        .user-role { font-size: 12px; color: #889bb2; display: block; margin-top: 2px;}

        .logout-icon { margin-left: auto; font-size: 16px; cursor: pointer; color: #718096;}
        .logout-icon:hover {
            color: white;
        }

        /* --- Main Content --- */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            font-size: 24px;
            color: var(--sidebar-bg);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .stat-title {
            font-size: 14px;
            color: #666;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--sidebar-bg);
        }

        .stat-trend {
            font-size: 12px;
            color: var(--accent-orange);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .upcoming-events {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .upcoming-events h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .event-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .event-item:last-child {
            border-bottom: none;
        }

        .event-icon {
            width: 36px;
            height: 36px;
            background: #e2e8f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--text-light);
        }

        .event-details h3 {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .event-details p {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="logo-area">
            <img src="{{ asset('Images/primary_logo.svg') }}" alt="Logo" class="sidebar-logo">
        </div>

        <div class="nav-links">
            <a href="{{ route('citizen.dashboard') }}" class="nav-item {{ request()->routeIs('citizen.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="#" class="nav-item {{ request()->routeIs('citizen.workouts') ? 'active' : '' }}">
                <i class="fa-solid fa-dumbbell"></i>
                <span class="nav-text">Workouts</span>
            </a>
            <a href="#" class="nav-item {{ request()->routeIs('citizen.rewards') ? 'active' : '' }}">
                <i class="fa-solid fa-gift"></i>
                <span class="nav-text">Rewards</span>
            </a>
            <a href="#" class="nav-item {{ request()->routeIs('citizen.events') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar"></i>
                <span class="nav-text">Events</span>
            </a>
        </div>

        <div class="user-bottom">
            <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('Images/profile.png') }}" class="avatar" alt="User">
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-role">Citizen</span>
            </div>
            <div class="logout-icon">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"        
                         style="color: #fafafb; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <header>
            <h1>Dashboard</h1>
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Workouts Completed</div>
                <div class="stat-value">18</div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i> +12% this month</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Points Earned</div>
                <div class="stat-value">2,450</div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i> +220 pts this week</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Upcoming Events</div>
                <div class="stat-value">3</div>
                <div class="stat-trend"><i class="fas fa-calendar"></i> Next: Jun 15</div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="upcoming-events">
            <h2>Upcoming Events</h2>
            <div class="event-item">
                <div class="event-icon">
                    <i class="fas fa-running"></i>
                </div>
                <div class="event-details">
                    <h3>City Marathon</h3>
                    <p>Saturday, June 15 • 8:00 AM</p>
                </div>
            </div>
            <div class="event-item">
                <div class="event-icon">
                    <i class="fas fa-bicycle"></i>
                </div>
                <div class="event-details">
                    <h3>Cycling Challenge</h3>
                    <p>Sunday, June 23 • 7:30 AM</p>
                </div>
            </div>
            <div class="event-item">
                <div class="event-icon">
                    <i class="fas fa-person-walking"></i>
                </div>
                <div class="event-details">
                    <h3>Community Walk</h3>
                    <p>Friday, June 28 • 6:00 PM</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Ajoutez ici des scripts spécifiques si nécessaire (ex: charts, notifications)
    </script>
</body>
</html>