<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweat2Share</title>

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

        /* --- Search & Add Button --- */
        .header-actions {
            display: flex;
            gap: 20px;
        }

        .search-box input {
            padding: 10px 20px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            width: 250px;
            outline: none;
            background-color: #fff;
        }
        
        /* --- User List Table --- */
        .table-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            color: #444;
        }

        th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: var(--text-light);
            border-bottom: 1px solid #eee;
        }

        td {
            padding: 15px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9rem;
            color: #555;
        }

        /* --- Avatar Column --- */
        .col-avatar {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #dcdcdc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            font-size: 14px;
        }

        /* --- Badge Role --- */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge.citizen {
            background: var(--success-green);
            color: var(--success-text);
        }

        .badge.coach {
            background: var(--pending-yellow);
            color: var(--pending-text);
        }

        .badge.partner {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .badge.association {
            background: #e8f5e9;
            color: #388e3c;
        }

        .badge.contentcreator {
            background: #ffe0b2;
            color: #fb8c00;
        }

        .badge.sponsor {
            background: #b3e5fc;
            color: #0288d1;
        }

        .badge.healthinstitution {
            background: #fce4ec;
            color: #c2185b;
        }

        .badge.admin {
            background: #ffeb3b;
            color: #f57f17;
        }

        /* --- Actions Column --- */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            cursor: pointer;
            border: none;
            font-weight: 600;
        }
        .btn-delete {
            background: #ffe0e0;
            color: #d32f2f;
            border: 1px solid #ffcdd2;
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

    <!-- Main Content -->
    <main class="main-content">
        <header>
            <h1>User List</h1>
            <div class="header-actions">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search" onkeyup="filterUsers()">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
        </header>

        <section class="table-container">
            <table id="userTable">
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
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ str_pad($user->id, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="col-avatar">
                            <div class="avatar-circle"><i class="fa-solid fa-user"></i></div>
                            {{ $user->name }}
                        </td>
                        <td><i class="fa-solid fa-envelope" style="color: #4caf50; margin-right: 5px;"></i> {{ $user->email }}</td>
                        <td>
                            <span class="badge {{ strtolower($user->role) }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="actions">
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display: inline;"
                                  onsubmit="return confirm('Delete {{ $user->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <script>
        function filterUsers() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('userTable');
            const trs = table.getElementsByTagName('tr');

            for (let i = 1; i < trs.length; i++) { // i=1 pour sauter l'en-tête
                const tdName = trs[i].querySelector('.col-avatar')?.textContent || '';
                const tdEmail = trs[i].querySelector('td:nth-child(3)')?.textContent || '';

                if (tdName.toLowerCase().indexOf(filter) > -1 || tdEmail.toLowerCase().indexOf(filter) > -1) {
                    trs[i].style.display = '';
                } else {
                    trs[i].style.display = 'none';
                }
            }
        }
    </script>

</body>
</html>