@extends('layouts.app')

@section('title', 'User Dashboard - Shorty')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Title -->
    <h1 class="text-2xl font-bold text-gray-900 mb-8">User Dashboard</h1>

    <!-- Dashboard Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Links Card -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Links</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_links'] }}</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Clicks Card -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Clicks</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_clicks'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Most Active Link Card -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Most Active Link</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['most_active_link'] ?? 'N/A' }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Shorten a New URL Section -->
    <div class="bg-white rounded-xl border border-gray-200 mb-8">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Shorten a New URL</h2>
            <form method="POST" action="{{ route('shorten.store') }}">
                @csrf
                <div class="space-y-4">
                    <!-- Destination URL -->
                    <div>
                        <label for="destination_url" class="block text-sm font-medium text-gray-700 mb-1">Destination URL</label>
                        <input 
                            type="url" 
                            id="destination_url" 
                            name="destination_url" 
                            placeholder="https://example.com/very-long-url"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            required
                        >
                    </div>

                    <!-- Custom ID (Optional) -->
                    <div>
                        <label for="custom_id" class="block text-sm font-medium text-gray-700 mb-1">Custom ID (Optional)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">@</span>
                            <input 
                                type="text" 
                                id="custom_id" 
                                name="custom_id" 
                                placeholder="my-cool-link"
                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            >
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors cursor-pointer"
                    >
                        Shorten Now
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Your Links Section -->
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Your Links</h2>
                <span class="text-sm text-gray-600">{{ $stats['total_links'] }} Total</span>
            </div>

            @if ($links->isEmpty())
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">No links yet. Get started by creating your first shortened URL above.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-gray-600 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 font-medium">Short URL</th>
                                <th class="px-4 py-3 font-medium">Destination</th>
                                <th class="px-4 py-3 font-medium">Clicks</th>
                                <th class="px-4 py-3 font-medium">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($links as $link)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <a href="{{ url('/' . $link->short_code) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                            {{ url('/' . $link->short_code) }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate">
                                        <a href="{{ $link->destination_url }}" target="_blank" class="hover:text-gray-900">
                                            {{ $link->destination_url }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">{{ $link->clicks }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $link->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
