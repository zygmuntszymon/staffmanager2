<?php

namespace App\Http\Controllers;

use App\Models\Redemption;
use Illuminate\Http\Request;

class RedemptionController extends Controller
{
    public function index()
    {
        $redemptions = auth()->user()->redemptions;
        return view('redemptions.index', compact('redemptions'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'benefit_type' => 'required|in:vacation_day,cash_bonus',
        ]);

        $user = auth()->user();

        $costs = [
            'vacation_day' => 2000,
            'cash_bonus'   => 4000,
        ];

        $pointsNeeded = $costs[$data['benefit_type']];

        if ($user->points < $pointsNeeded) {
            return redirect()->back()
                ->withErrors(['points' => 'Masz za mało punktów (potrzebujesz '.$pointsNeeded.' pkt).']);
        }

        $user->decrement('points', $pointsNeeded);
        $user->redemptions()->create([
            'benefit_type'  => $data['benefit_type'],
            'points_spent'  => $pointsNeeded,
        ]);

        return redirect()->back()->with('status', 'Benefit został zrealizowany.');
    }
}
