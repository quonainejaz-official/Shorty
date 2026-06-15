<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = auth()->user();

        $links = $user
            ? ShortLink::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
            : collect();

        $stats = [
            'total_links' => $links->count(),
            'total_clicks' => $links->sum('clicks'),
            'most_active_link' => $links->sortByDesc('clicks')->first()?->short_code,
        ];

        $dashboardData = [
            'user' => $user ? ['id' => $user->id, 'name' => $user->name, 'email' => $user->email] : null,
            'stats' => $stats,
            'links' => $links,
        ];

        if ($this->wantsJson($request)) {
            return $this->jsonResponse(true, 'Dashboard data fetched successfully.', $dashboardData);
        }

        return view('dashboard', $dashboardData);
    }
}
