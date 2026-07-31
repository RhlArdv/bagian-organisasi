<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class PublicAgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::query();

        // Optional filter if user wants to search or filter by month
        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('location', 'like', '%' . $request->q . '%');
        }

        $agendas = $query->orderBy('date', 'desc')->paginate(12);

        return view('public.agendas.index', compact('agendas'));
    }

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        
        // Fetch upcoming agendas for the sidebar
        $upcomingAgendas = Agenda::where('date', '>=', now()->toDateString())
                                 ->where('id', '!=', $agenda->id)
                                 ->orderBy('date', 'asc')
                                 ->limit(4)
                                 ->get();

        return view('public.agendas.show', compact('agenda', 'upcomingAgendas'));
    }
}
