<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .header-actions {
            display: flex;
            gap: 20px;
        }

        .add-btn {
            background: var(--sidebar-bg);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        /* --- Calendar Section --- */
        .calendar-section {
            width: 315px;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .calendar-title {
            background: var(--sidebar-bg);
            color: white;
            padding: 10px 10px;
            padding-top: 12px;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-width: 250px;
            transition: background 0.3s;
        }

        .calendar-nav-container {
            display: flex;
            align-items: center;
            gap: 5px;
            flex: 1; 
            justify-content: center; 
        }

        .calendar-nav-container button {
            background: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .calendar-current-date {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            line-height: 1.2;
          
        }

        .calendar-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .calendar-nav button {
            background: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
        }

        .calendar-day {
            padding: 10px;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #555;
        }

        .calendar-day:hover {
            background: #f0f0f0;
        }

        .calendar-day.today {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        .calendar-day.outside-month {
            color: #bbb;
        }

        .calendar-day.selected {
            background: #2c3e50;
            color: white;
            font-weight: bold;
        }

        /* --- Events List --- */
        .events-container {
            flex: 1;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .events-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .events-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

   

        .filter-label {
            font-size: 12px;
            color: #666;
        }

        .filter-label i {
            font-size: 10px;
        }

        .events-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .event-card,
        .event-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }

        .event-item:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Nom de l'événement en premier */
        .event-title {
            flex: 1;
            font-weight: 600;
            color: #333;
            margin-right: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Conteneur pour les informations date/heure/lieu */
        .event-info {
            display: flex;
            gap: 20px;
            align-items: center;
            padding-right: 200px;
        }

        .event-date,
        .event-time,
        .event-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #495E6F;
            font-size: 14px;
        }

        .event-date i,
        .event-time i,
        .event-location i {
            background: #e2e8f0;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #495E6F;
        }

        /* Actions à droite */
        .event-actions {
            display: flex;
            gap: 10px;
        
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #fff8e1;
            color: #efc24f;
        }

        .btn-delete {
            background: #ffebee;
            color: #dc3545;
        }

        .btn-edit:hover {
            background: #ffecb3;
            color: #d9a52d;
        }

        .btn-delete:hover {
            background: #ffcdd2;
            color: #c62828;
        }

        /* --- Popup Styles --- */
        .popup-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Un peu plus foncé pour meilleur focus */
            z-index: 999;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .popup-backdrop.show {
            display: block;
        }

        .event-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.95);
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            width: 600px; /* Plus large */
            max-width: 95vw; /* Responsive sur mobile */
            padding: 24px;
            display: none;
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .event-popup.show {
            display: block;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #eaeaea;
        }

        .popup-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--sidebar-bg);
            line-height: 1.3;
        }

        .btn-close-popup {
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #888;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s, color 0.2s;
        }

        .btn-close-popup:hover {
            background: #f5f5f5;
            color: #333;
        }

        .popup-body {
            padding: 0 0 24px;
        }

        .popup-footer {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 30px;
            border-top: 1px solid #eaeaea;
        }
        .date-row {
            display: flex;
            gap: 16px; 
            margin-bottom: 24px;
        }

        .date-row > div {
            flex: 1; 
        }

        /* --- Labels uniformes --- */
        .popup-body label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        /* --- Champs de formulaire (input & select) --- */
        .form-control,
        .form-select {
            width: 100%;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #fff;
            color: #495e6f;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--accent-orange);
            box-shadow: 0 0 0 3px rgba(245, 126, 48, 0.1);
        }

        /* Style spécifique pour les selects */
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236c757d' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px;
            padding-right: 40px;
        }

        /* --- File input (si ajouté plus tard) --- */
        .form-control[type="file"] {
            padding: 6px 12px;
        }

        /* --- Boutons du footer --- */
        .btn-secondary {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-primary {
            background: var(--accent-orange);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #e66c20;
        }

        /* Animation optionnelle */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
            <h1>Events</h1>
            <button class="add-btn" onclick="toggleEventPopup()">+ Add New</button>
        </header>

        <div style="display: flex; gap: 20px;">

            <!-- Calendar Section -->
            <div class="calendar-section">
                <div class="calendar-header">
                    <button class="calendar-title" >Calendar</button>
                </div>
                <div class="calendar-nav-container">
                    <button id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                    <div class="calendar-current-date" id="currentDate">Loading...</div>
                    <button id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                </div>
                

                <div class="calendar-grid" id="calendarGrid">
                    <!-- Headers will be inserted by JS -->
                </div>
            </div>

            <!-- Events List -->
            <div class="events-container">
                <div class="events-header">
                    <div class="events-title">Events</div>
                </div>

                <div class="events-list" id="eventsList">
                    @foreach ($events as $event)
                    <div class="event-item" data-event-date="{{ $event->date->format('Y-m-d') }}">
                        <div class="event-title">{{ $event->title }}</div>
                        <div class="event-info">
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i> {{ $event->formatted_date }}
                            </div>
                            <div class="event-time">
                                <i class="far fa-clock"></i> {{ $event->formatted_time }}
                            </div>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-action btn-edit" onclick="openEditEvent(
                                {{ $event->id }},
                                `{{ addslashes($event->title) }}`,
                                `{{ addslashes($event->location) }}`,
                                `{{ $event->date->format('Y-m-d') }}`,
                                `{{ $event->time->format('H:i') }}`
                            )">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.events.destroy', $event->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Delete this event?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- Popup Backdrop (pour création) -->
    <div class="popup-backdrop" id="popupBackdrop"></div>

    <!-- Create Event Popup -->
    <div class="event-popup" id="eventPopup">
        <div class="popup-header">
            <h5 class="popup-title">Create an Event</h5>
            <button type="button" class="btn-close-popup" onclick="toggleEventPopup()">&times;</button>
        </div>
        <div class="popup-body">
            <form id="createEventForm" action="{{ route('admin.events.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title">Event Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Add title" required>
                </div>

                <div class="mb-3">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Add location" required>
                </div>

                <!-- Date Row: Month, Day, Year sur une seule ligne -->
                <div class="date-row">
                    <div>
                        <label for="month">Month</label>
                        <select class="form-select" id="month" name="date_month" required>
                            <option value="">Select</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option> 
                            <option value="06">June</option>
                            <option value="07">July</option>    
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div>
                        <label for="day">Day</label>
                        <select class="form-select" id="day" name="date_day" required>
                            <option value="">Select</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="year">Year</label>
                        <select class="form-select" id="year" name="date_year" required>
                            <option value="">Select</option>
                            @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="time">Time</label>
                    <select class="form-select" id="time" name="time" required>
                        <option value="">Select</option>
                        @for ($h = 0; $h < 24; $h++)
                            @for ($m = 0; $m < 60; $m += 30)
                                <option value="{{ sprintf('%02d:%02d', $h, $m) }}">
                                    {{ sprintf('%d:%02d %s', ($h % 12 ?: 12), $m, $h < 12 ? 'AM' : 'PM') }}
                                </option>
                            @endfor
                        @endfor
                    </select>
                </div>

                <div class="popup-footer">
                    <button type="button" class="btn-secondary" onclick="toggleEventPopup()">Close</button>
                    <button type="submit" class="btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup Backdrop (pour édition) -->
    <div class="popup-backdrop" id="editPopupBackdrop"></div>

    <!-- Edit Event Popup -->
    <div class="event-popup" id="editEventPopup">
        <div class="popup-header">
            <h5 class="popup-title">Edit Event: <span id="edit-event-title-preview">...</span></h5>
            <button type="button" class="btn-close-popup" onclick="toggleEditEventPopup()">&times;</button>
        </div>
        <div class="popup-body">
            <form id="editEventForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-event-id" name="id">

                <div class="mb-3">
                    <label for="edit-title">Event Title</label>
                    <input type="text" class="form-control" id="edit-title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="edit-location">Location</label>
                    <input type="text" class="form-control" id="edit-location" name="location" required>
                </div>

                <div class="date-row">
                    <div>
                        <label for="edit-month">Month</label>
                        <select class="form-select" id="edit-month" name="date_month" required>
                            <option value="">Select</option>
                            @foreach ([
                                '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                            ] as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="edit-day">Day</label>
                        <select class="form-select" id="edit-day" name="date_day" required>
                            <option value="">Select</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="edit-year">Year</label>
                        <select class="form-select" id="edit-year" name="date_year" required>
                            <option value="">Select</option>
                            @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit-time">Time</label>
                    <select class="form-select" id="edit-time" name="time" required>
                        <option value="">Select</option>
                        @for ($h = 0; $h < 24; $h++)
                            @for ($m = 0; $m < 60; $m += 30)
                                <option value="{{ sprintf('%02d:%02d', $h, $m) }}">
                                    {{ sprintf('%d:%02d %s', ($h % 12 ?: 12), $m, $h < 12 ? 'AM' : 'PM') }}
                                </option>
                            @endfor
                        @endfor
                    </select>
                </div>

                <div class="popup-footer">
                    <button type="button" class="btn-secondary" onclick="toggleEditEventPopup()">Close</button>
                    <button type="submit" class="btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- CALENDRIER DYNAMIQUE ---
            const calendarGrid = document.getElementById('calendarGrid');
            const currentDateElement = document.getElementById('currentDate');
            const prevBtn = document.getElementById('prevMonth');
            const nextBtn = document.getElementById('nextMonth');

            let currentDate = new Date();

            const daysOfWeek = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
            const monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"];

            function renderCalendar(date) {
                calendarGrid.innerHTML = '';

                // En-têtes des jours (S, M, T, ...)
                daysOfWeek.forEach(day => {
                    const header = document.createElement('div');
                    header.className = 'calendar-day';
                    header.textContent = day;
                    header.style.fontWeight = 'bold';
                    header.style.color = '#333';
                    calendarGrid.appendChild(header);
                });

                const year = date.getFullYear();
                const month = date.getMonth(); // 0 = Janvier
                const firstDay = new Date(year, month, 1).getDay(); // 0 = Dimanche
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const daysInPrevMonth = new Date(year, month, 0).getDate();

                const today = new Date();
                const todayISO = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

                // Jours du mois précédent (non cliquables)
                for (let i = 0; i < firstDay; i++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day outside-month';
                    dayCell.textContent = daysInPrevMonth - firstDay + i + 1;
                    // Pas de data-date ni d'écouteur ici → non filtrable
                    calendarGrid.appendChild(dayCell);
                }

                // Jours du mois courant (CLICABLES)
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day';
                    dayCell.textContent = day;

                    // Format ISO: YYYY-MM-DD
                    const fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    dayCell.setAttribute('data-date', fullDate);

                    // Mettre en évidence la date d'aujourd'hui
                    if (fullDate === todayISO) {
                        dayCell.classList.add('today');
                    }

                    // Ajouter le clic pour filtrer
                    dayCell.addEventListener('click', function () {
                        // Enlever la classe 'selected' de toutes les cellules
                        document.querySelectorAll('.calendar-day').forEach(cell => {
                            cell.classList.remove('selected');
                        });
                        // Ajouter la classe à la cellule cliquée
                        this.classList.add('selected');
                        // Filtrer les événements
                        filterEventsByDate(fullDate);
                    });

                    calendarGrid.appendChild(dayCell);
                }

                // Jours du mois suivant (non cliquables)
                const totalCells = 42;
                const remainingDays = totalCells - (firstDay + daysInMonth);
                for (let i = 1; i <= remainingDays; i++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day outside-month';
                    dayCell.textContent = i;
                    calendarGrid.appendChild(dayCell);
                }

                // Mise à jour du titre du calendrier
                currentDateElement.textContent = `${monthNames[month]} ${year}`;
            }

            renderCalendar(currentDate);
            prevBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate);
            });

            nextBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate);
            });

            // --- POPUP ---
            const popup = document.getElementById('eventPopup');
            const backdrop = document.getElementById('popupBackdrop');

            window.toggleEventPopup = function () {
                popup.classList.toggle('show');
                backdrop.classList.toggle('show');
            };

            backdrop.addEventListener('click', toggleEventPopup);

            const form = document.getElementById('createEventForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Optionnel : gestion AJAX ou reset ici
                });
            }

            // Pré-remplir popup
            const monthSelect = document.getElementById('month');
            const daySelect = document.getElementById('day');
            const yearSelect = document.getElementById('year');
            const timeSelect = document.getElementById('time');

            popup.addEventListener('transitionend', function () {
                if (popup.classList.contains('show')) {
                    const now = new Date();
                    monthSelect.value = String(now.getMonth() + 1).padStart(2, '0');
                    daySelect.value = String(now.getDate()).padStart(2, '0');
                    yearSelect.value = now.getFullYear();
                    timeSelect.value = '08:00';
                }
            });
        });
        // --- Gestion du popup d'édition ---
        function toggleEditEventPopup() {
            const popup = document.getElementById('editEventPopup');
            const backdrop = document.getElementById('editPopupBackdrop');
            popup.classList.toggle('show');
            backdrop.classList.toggle('show');
        }

        // Fermer popup en cliquant sur le backdrop
        document.getElementById('editPopupBackdrop').addEventListener('click', toggleEditEventPopup);

        // Ouvrir le popup avec les données de l'événement
        window.openEditEvent = function(eventId, title, location, dateStr, timeStr) {
            // Remplir le titre dans l'en-tête
            document.getElementById('edit-event-title-preview').textContent = title;

            // Remplir le formulaire
            document.getElementById('edit-event-id').value = eventId;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-location').value = location;

            // Découper la date (format: "Y-m-d")
            const dateParts = dateStr.split('-');
            document.getElementById('edit-year').value = dateParts[0];
            document.getElementById('edit-month').value = dateParts[1];
            document.getElementById('edit-day').value = parseInt(dateParts[2], 10); // enlever le zéro devant

            // Heure
            document.getElementById('edit-time').value = timeStr;

            // Ouvrir le popup
            toggleEditEventPopup();
        };

        // Soumission du formulaire d'édition
        document.getElementById('editEventForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const eventId = formData.get('id');

            fetch(`{{ url('/admin/events') }}/${eventId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Fermer popup
                    toggleEditEventPopup();
                    // Recharger la page pour voir les changements
                    location.reload();
                } else {
                    alert('Update failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred.');
            });
        });
        // --- Filtrer les événements par date sélectionnée ---
        function filterEventsByDate(selectedDate) {
            // Mettre en évidence la date sélectionnée
            document.querySelectorAll('.calendar-day').forEach(cell => {
                cell.classList.remove('selected');
            });
            const selectedCell = document.querySelector(`[data-date="${selectedDate}"]`);
            if (selectedCell) {
                selectedCell.classList.add('selected');
            }

            // Filtrer les événements
            const eventsList = document.getElementById('eventsList');
            const allEvents = Array.from(eventsList.children); // Tous les éléments .event-item

            allEvents.forEach(eventItem => {
                const eventDate = eventItem.getAttribute('data-event-date'); // Doit être ajouté au HTML
                if (eventDate === selectedDate) {
                    eventItem.style.display = 'flex'; // ou 'block' selon votre CSS
                } else {
                    eventItem.style.display = 'none';
                }
            });
        }
       
    </script>
</body>
</html>