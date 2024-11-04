<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalledRequest;
use Illuminate\Http\Request;
use App\Models\location;

class StudentcalledController extends Controller
{
    public function index()
    {
        $andares = location::all()->unique('roof');

        $locais = $this->retornalocais();

        return view('Student-called', ['andares' => $andares], compact('locais'));
    }

    public function retornalocais()
    {
        // Obtem todas as localizações
        $locations = Location::all();

        $groupedLocations = $locations->groupBy('roof')->map(function ($group) {
            return $group->pluck('environment')->toArray();
        });

        return $groupedLocations;
    }

    public function enviarchamado(CalledRequest $request)
    {
        dd($request);
    }
}
