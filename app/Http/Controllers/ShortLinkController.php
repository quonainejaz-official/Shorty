<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'destination_url' => 'required|url|max:2048',
            'custom_id' => 'nullable|alpha_dash|max:10|unique:short_links,short_code',
        ]);

        if ($validator->fails()) {
            return $this->validationError($request, $validator);
        }

        $validated = $validator->validated();

        $shortCode = $validated['custom_id'] ?? Str::random(6);

        if (ShortLink::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }

        $shortLink = ShortLink::create([
            'user_id' => auth()->id(),
            'destination_url' => $validated['destination_url'],
            'short_code' => $shortCode,
        ]);

        $data = [
            'short_link' => $shortLink,
            'short_url' => url('/'.$shortCode),
        ];

        if ($this->wantsJson($request)) {
            return $this->jsonResponse(true, 'Short link created successfully.', $data, 201);
        }

        return redirect()->route('dashboard')->with('success', 'Short link created successfully!');
    }

    public function redirect(string $shortCode)
    {
        $shortLink = ShortLink::where('short_code', $shortCode)->firstOrFail();

        $shortLink->increment('clicks');

        return redirect($shortLink->destination_url, 302);
    }
}
