<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --sidebar-bg: #233D4D;
            --dark-card: #233D4D;
            --bg-color: #F8F9FB;
            --accent-orange: #F57E30;
            --border-color: #e2e8f0;
            --text-main: #4a5568;
            --text-light: #495E6F;
            --success-green: #E6F8F0;
            --success-text: #3A974C;
            --pending-yellow: #FFF8E1;
            --pending-text: #EFC24F;
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
            margin: 0;
            padding: 0;
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
            background: transparent; /* 🔥 Supprime tout fond extérieur */
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            font-size: 24px;
            color: var(--sidebar-bg);
        }

        .header-actions {
            display: flex;
            gap: 20px;
        }

        /* Dropdown Wrapper */
        .custom-select-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            z-index: 20;
        }

        .custom-select-trigger {
            background: white;
            padding: 10px 20px;
            border-radius: 8px;
            color: #999; 
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            min-width: 160px;
            justify-content: space-between;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .custom-select-wrapper:hover .custom-select-trigger {
            background-color: #FAFAFB; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .custom-options {
            position: absolute;
            top: 110%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);  
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .custom-select-wrapper:hover .custom-options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .custom-select-wrapper:hover .custom-select-trigger i {
            transform: rotate(180deg);
            color: #F57E30;
            transition: transform 0.3s ease;
        }

        .custom-option {
            display: block;
            padding: 12px 20px;
            color: #555;
            font-size: 13px;
            transition: 0.2s;
        }

        .custom-option:hover {
            background-color: #FFF0E3;
            color: #F57E30;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 40px 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            width: 250px;
            outline: none;
            background-color: #fff;
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            border-bottom: 3px solid transparent; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: default;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08); 
            border-bottom: 3px solid #F57E30; 
        }

        .card:hover .icon-box {
            transform: scale(1.15) rotate(10deg); 
            transition: transform 0.4s ease;
        }

        .card:hover .card-info h3 {
            color: #F57E30; 
            transition: color 0.3s ease;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: transform 0.3s ease; 
        }

        .icon-box.grey { background: rgba(35, 61, 77, 0.1); color: #233D4D; }
        .icon-box.orange { background: #FFF0E3; color: var(--accent-orange); }

        .card-info h3 { font-size: 24px; color: var(--sidebar-bg); }
        .card-info p { font-size: 14px; color: var(--text-light); margin-top: 4px; }

        /* Charts Section */
        .charts-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .chart-container {
            background: rgba(35, 61, 77, 0.9);;
            padding: 25px;
            border-radius: 15px;
            color: white;
            position: relative;
            min-height: 350px;
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1px solid transparent;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .chart-container:hover {
            transform: translateY(-6px); 
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            border-color: rgba(245, 126, 48, 0.5);
        }

        .chart-container:hover .chart-header h3 {
            text-shadow: 0 0 10px rgba(255,255,255,0.3); 
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .chart-header h3 { font-weight: 500; }
        .dots { color: #8A9AB0; cursor: pointer; letter-spacing: 2px;}

        /* Donut Text Overlay */
        .donut-inner {
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .donut-inner h2 { font-size: 32px; color: white; }
        .donut-inner p { font-size: 12px; color: #aaa; }

        .legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
            font-size: 12px;
        }
        .legend-item { display: flex; align-items: center; gap: 8px; color: #ddd;}
        .dot { width: 10px; height: 10px; border-radius: 50%; }

        /* Table Section */
        .table-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02); /* ✅ Garde l’ombre légère */
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            color: var(--text-light);
            font-weight: 400;
            font-size: 13px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        td {
            padding: 15px 0;
            font-size: 14px;
            color: #555;
            border-bottom: 1px solid #f5f5f5;
        }

        /* --- Status Dropdown Styles --- */

        .status {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-header {
            position: relative;
            cursor: pointer;
            user-select: none;
            padding: 10px 0;
        }

        .status-trigger {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-header:hover .status-trigger i {
            transform: rotate(180deg);
            color: #F57E30;
            transition: transform 0.3s ease;
        }

        .status-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 120px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 5px 0;
            z-index: 50; 
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f0f0f0;
        }

        .status-header:hover .status-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .status-option {
            padding: 10px 15px;
            font-size: 13px;
            color: #555;
            transition: background 0.2s;
        }

        .status-option:hover {
            background-color: #FFF0E3; 
            color: #F57E30;
        }


        .status.active { background: var(--success-green); color: var(--success-text); }
        .status.pending { background: var(--pending-yellow); color: var(--pending-text); }


        .actions button {
            padding: 6px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 5px;
            font-weight: 500;
        }

        .btn-delete { 
            background: #FFF0E3; color: var(--accent-orange); 
        }

        tbody tr {
            transition: all 0.2s ease;
            border-left: 3px solid transparent; 
        }

        tbody tr:hover {
            background-color: #FAFAFB;
            transform: translateX(4px); 
            border-left: 3px solid #F57E30; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); 
        }

        th {
            cursor: pointer;
            transition: color 0.2s;
        }

        th:hover {
            color: #233D4D;
        }

        .actions button {
            padding: 6px 15px;
            border: 1px solid transparent; 
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 5px;
            font-weight: 600;
            transition: all 0.2s ease; 
        }

       

        .btn-delete:hover {
            background-color: #FAFAFB; 
            border-color: #F57E30;  
            color: #F57E30;     
            transform: translateY(-2px);
        }

        .actions button:active {
            transform: translateY(0);
            box-shadow: none;
        }
        .logout-icon a {
            color: white !important;
            text-decoration: none;
        }
        .logout-icon a:hover {
            color: #F57E30; 
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span class="nav-text"> Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fa-solid fa-user-group"></i>
                <span class="nav-text"> Users</span>
            </a>
            <a href="{{ route('admin.events') }}" class="nav-item {{ request()->routeIs('admin.events') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar"></i>
                <span class="nav-text"> Events</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-sack-dollar"></i>
                <span class="nav-text"> Donations</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="nav-text"> Reports</span>
            </a>
        </div>

        <div class="user-bottom">
            <img src="{{ asset('Images/admin.jpeg') }}" class="avatar" alt="User">
            <div class="logout-icon">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                style="color: #fafafb; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="nav-text">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <main class="main-content">
        
        <header>
            <h1>Dashboard</h1>
            <div class="header-actions">
                <div class="custom-select-wrapper">
                    <div class="custom-select-trigger">
                        <span>Monthly View</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="custom-options">
                        <span class="custom-option">Last 7 Days</span>
                        <span class="custom-option">Monthly View</span>
                        <span class="custom-option">Quarterly View</span>
                        <span class="custom-option">Custom Range</span>
                    </div>
                </div>
                <div class="search-box">
                    <input type="text" placeholder="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
        </header>

        <!-- Afficher les messages de succès ou d'erreur -->
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
     
        <section class="stats-grid">
            <div class="card">
                <div class="icon-box grey"><i class="fa-solid fa-user"></i></div>
                <div class="card-info">
                    <h3>{{ $totalUsers }}</h3>
                    <p>Total Users</p>
                </div>
            </div>
            <div class="card">
                <div class="icon-box orange"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="card-info">
                    <h3>20+</h3>
                    <p>Active Events</p>
                </div>
            </div>
            <div class="card">
                <div class="icon-box grey"><i class="fa-solid fa-sack-dollar"></i></div>
                <div class="card-info">
                    <h3>25k+</h3>
                    <p>Total Donations</p>
                </div>
            </div>
            <div class="card">
                <div class="icon-box orange"><i class="fa-solid fa-person-running"></i></div>
                <div class="card-info">
                    <h3>400+</h3>
                    <p>Participants</p>
                </div>
            </div>
        </section>

        <section class="charts-row">
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Funds Raised</h3>
                    <span class="dots">...</span>
                </div>
                <div style="height: 280px;">
                    <canvas id="fundsChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Fund Allocation</h3>
                    <span class="dots">...</span>
                </div>
                <div style="height: 220px; position: relative;">
                    <canvas id="allocationChart"></canvas>
                    <div class="donut-inner">
                        <h2>95%</h2>
                        <p>Impact Delivered</p>
                    </div>
                </div>
                <div class="legend">
                    <div class="legend-item"><span class="dot" style="background: #F48840;"></span> Donated</div>
                    <div class="legend-item"><span class="dot" style="background: #5D6D7E;"></span> Costs</div>
                    <div class="legend-item"><span class="dot" style="background: #D5C6A6;"></span> Hold</div>
                </div>
            </div>
        </section>

        <section class="table-container">
            <div class="table-header">
                <h3>Recent Users</h3>
                <a href="{{ route('admin.users') }}" style="font-size: 0.85rem; color: #F57E30; text-decoration: none;">View all</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentUsers as $user)
                        <tr>
                            <td>{{ str_pad($user->id, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="status {{ $user->role === 'Citizen' ? 'active' : 'pending' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="actions">
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px 12px; background: #ffe0e0; border: 1px solid #ffcdd2; border-radius: 6px; font-size: 0.75rem; color: #d32f2f; cursor: pointer;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==========================================
            // 1. LINE CHART CONFIG (Funds Raised)
            // ==========================================
            const ctxLine = document.getElementById('fundsChart').getContext('2d');

            // Gradients
            let gradientStroke = ctxLine.createLinearGradient(0, 0, 700, 0);
            gradientStroke.addColorStop(0, '#E8C8A5');
            gradientStroke.addColorStop(1, '#F57E30');

            let gradientFill = ctxLine.createLinearGradient(0, 0, 0, 400);
            gradientFill.addColorStop(0, 'rgba(250, 250, 251, 0.05)');
            gradientFill.addColorStop(1, 'rgba(232, 200, 165, 0.05)');

            // Custom Tooltip Plugin (Draws the permanent Orange Box)
            const alwaysShowTooltip = {
                id: 'alwaysShowTooltip',
                afterDraw: (chart) => {
                    const ctx = chart.ctx;
                    const xAxis = chart.scales['x'];
                    const yAxis = chart.scales['y'];

                    if (!xAxis || !yAxis) return;

                    // TARGET POINT: M4 (Index 3) with value 27.5
                    const index = 3; 
                    const value = 27.5;
                    
                    const x = xAxis.getPixelForValue(index);
                    const y = yAxis.getPixelForValue(value);

                    const text1 = "Revenue";
                    const text2 = "27.5 K";
                    const boxWidth = 90;
                    const boxHeight = 55;
                    const arrowHeight = 8;
                    const boxX = x - (boxWidth / 2);
                    const boxY = y - boxHeight - arrowHeight - 12;

                    ctx.save();

                    // Shadow
                    ctx.shadowColor = 'rgba(0, 0, 0, 0.2)';
                    ctx.shadowBlur = 10;
                    ctx.shadowOffsetY = 4;

                    // Draw Box Shape
                    const radius = 8;
                    ctx.beginPath();
                    ctx.moveTo(boxX + radius, boxY);
                    ctx.lineTo(boxX + boxWidth - radius, boxY);
                    ctx.quadraticCurveTo(boxX + boxWidth, boxY, boxX + boxWidth, boxY + radius);
                    ctx.lineTo(boxX + boxWidth, boxY + boxHeight - radius);
                    ctx.quadraticCurveTo(boxX + boxWidth, boxY + boxHeight, boxX + boxWidth - radius, boxY + boxHeight);
                    
                    // Arrow
                    ctx.lineTo(x + 6, boxY + boxHeight);
                    ctx.lineTo(x, boxY + boxHeight + arrowHeight);
                    ctx.lineTo(x - 6, boxY + boxHeight);
                    
                    ctx.lineTo(boxX + radius, boxY + boxHeight);
                    ctx.quadraticCurveTo(boxX, boxY + boxHeight, boxX, boxY + boxHeight - radius);
                    ctx.lineTo(boxX, boxY + radius);
                    ctx.quadraticCurveTo(boxX, boxY, boxX + radius, boxY);
                    ctx.closePath();

                    ctx.fillStyle = '#F57E30';
                    ctx.fill();
                    
                    // Draw Text
                    ctx.shadowColor = 'transparent';
                    ctx.font = "400 11px Figtree";
                    ctx.fillStyle = "rgba(35, 61, 77, 0.7)";
                    ctx.textAlign = "center";
                    ctx.fillText(text1, x, boxY + 20);

                    ctx.font = "700 18px Figtree";
                    ctx.fillStyle = "#233D4D";
                    ctx.fillText(text2, x, boxY + 42);

                    ctx.restore();
                }
            };

            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['M1', 'M2', 'M3', 'M4', 'M5', 'M6', 'M7'],
                    datasets: [{
                        label: 'Revenue',
                        data: [32, 24, 32, 27.5, 30, 18, 25], 
                        borderColor: gradientStroke,
                        borderWidth: 4,
                        backgroundColor: gradientFill,
                        tension: 0.5, 
                        fill: true,
                        pointBackgroundColor: '#233D4D',
                        pointBorderColor: '#F57E30',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    devicePixelRatio: window.devicePixelRatio || 2,
                    layout: { padding: { top: 50 } },
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }, 
                    },
                    scales: {
                        y: {
                            min: 5,
                            max: 45,
                            ticks: { 
                                stepSize: 10,
                                color: '#8A9AB0',
                                font: { family: 'Figtree', size: 11 },
                                callback: function(value) { return value + ' K'; } 
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                                borderDash: [0, 0],
                                drawBorder: false 
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { 
                                color: '#8A9AB0',
                                font: { family: 'Figtree', size: 12 },
                                padding: 10
                            }
                        }
                    }
                },
                plugins: [alwaysShowTooltip]
            });


            // ==========================================
            // 2. DONUT CHART CONFIG (Fund Allocation)
            // ==========================================
            const ctxDonut = document.getElementById('allocationChart').getContext('2d');

            new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: ['Donated', 'Costs', 'Hold'],
                    datasets: [{
                        data: [60, 25, 15],
                        backgroundColor: ['#F57E30', '#5D6D7E', '#E8C8A5'],
                        borderWidth: 0,
                        hoverOffset: 4,
                        borderRadius: 20,
                        borderAlign: 'center'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    devicePixelRatio: window.devicePixelRatio || 2,
                    cutout: '85%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false } 
                    }
                }
            });


            // ==========================================
            // 3. INTERACTIONS (Dropdowns & Table)
            // ==========================================

            // Monthly View Dropdown (Update Text on Click)
            const customOptions = document.querySelectorAll('.custom-option');
            if(customOptions) {
                customOptions.forEach(option => {
                    option.addEventListener('click', function(e) {
                        const triggerSpan = document.querySelector('.custom-select-trigger span');
                        if(triggerSpan) triggerSpan.textContent = this.textContent;
                    });
                });
            }

            // Status Dropdown (Logging selection)
            const statusOptions = document.querySelectorAll('.status-option');
            if(statusOptions) {
                statusOptions.forEach(option => {
                    option.addEventListener('click', function(e) {
                        e.stopPropagation(); 
                        console.log("Filtered by:", this.textContent);
                    });
                });
            }

           

            // Table Sorting (Visual Toggle)
            const tableHeaders = document.querySelectorAll('th');
            if(tableHeaders) {
                tableHeaders.forEach(header => {
                    header.addEventListener('click', () => {
                        if (header.classList.contains('status-header')) return; 

                        tableHeaders.forEach(h => {
                            if(h !== header) h.classList.remove('sorted-asc');
                        });
                        header.classList.toggle('sorted-asc');
                    });
                });
            }
        });
    </script>
</body>
</html>