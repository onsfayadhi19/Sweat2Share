<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord du citoyen.
     */
    public function index()
    {
        // Vous pouvez passer des données ici si nécessaire
        // Ex: événements à venir, statistiques, etc.
        return view('dashboards.citizen.dashboard');
    }
}