<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class Controller
{
    protected function wantsJson(Request $request): bool
    {
        return $request->expectsJson() || $request->is('api/*');
    }

    protected function jsonResponse(
        bool $success,
        string $message,
        mixed $data = null,
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function validationError(Request $request, $validator)
    {
        if ($this->wantsJson($request)) {
            return $this->jsonResponse(
                false,
                'Validation failed.',
                ['errors' => $validator->errors()],
                422
            );
        }

        return back()
            ->withErrors($validator)
            ->withInput($request->except('password', 'password_confirmation'));
    }

    // ✅ ADD THIS (missing but needed)
    protected function successResponse(
        Request $request,
        string $message,
        ?string $route = null,
        mixed $data = null,
        int $status = 200
    ) {
        if ($this->wantsJson($request)) {
            return $this->jsonResponse(true, $message, $data, $status);
        }

        $redirect = $route ? redirect()->route($route) : redirect()->back();

        return $redirect->with('success', $message);
    }

    // ✅ ADD THIS TOO (for login errors etc.)
    protected function errorResponse(
        Request $request,
        string $message,
        ?string $field = null,
        int $status = 401
    ) {
        if ($this->wantsJson($request)) {
            return $this->jsonResponse(false, $message, null, $status);
        }

        // 👇 if field is given → field error
        if ($field) {
            return back()
                ->withErrors([$field => $message])
                ->withInput($request->except('password'));
        }

        // 👇 otherwise → general error
        return back()
            ->with('error', $message)
            ->withInput($request->except('password'));
    }
}
