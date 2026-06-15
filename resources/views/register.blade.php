<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Register')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="font-inter min-h-screen overflow-hidden relative">

<!-- Background -->
<div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2070&auto=format&fit=crop"
        class="w-full h-full object-cover" />
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950/85 via-slate-900/80 to-blue-950/85"></div>
</div>

<!-- Blurs -->
<div class="absolute -top-28 -left-20 w-64 h-64 bg-cyan-500/20 rounded-full blur-3xl"></div>
<div class="absolute -bottom-28 -right-20 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl"></div>

<!-- MAIN -->
<div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-4">

    <!-- WIDTH REDUCED -->
    <div class="w-full max-w-4xl overflow-hidden rounded-[26px]
        border border-white/10 bg-white/10 backdrop-blur-2xl
        shadow-[0_20px_60px_rgba(0,0,0,0.5)]">

        <div class="grid lg:grid-cols-2">

            <!-- LEFT SIDE (IMPROVED UX CONTENT) -->
            <div class="hidden lg:flex flex-col justify-between border-r border-white/10 p-6">

                <div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl
                        bg-gradient-to-br from-blue-500 to-cyan-400 shadow-lg shadow-blue-500/30">
                        <i class="fas fa-link text-white"></i>
                    </div>

                    <h1 class="mt-4 text-3xl font-extrabold text-white leading-tight">
                        Build & Track<br>Your Smart Links
                    </h1>

                    <p class="mt-3 text-sm text-gray-300 leading-relaxed">
                        Join a powerful URL platform to shorten links, track analytics
                        and grow your digital reach with real-time insights.
                    </p>

                    <!-- Stats -->
                    <div class="mt-6 space-y-3">

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5">
                            <i class="fas fa-chart-line text-cyan-300"></i>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Live Analytics</h3>
                                <p class="text-xs text-gray-400">Real-time click tracking</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5">
                            <i class="fas fa-bolt text-blue-300"></i>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Fast Redirects</h3>
                                <p class="text-xs text-gray-400">Optimized routing system</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5">
                            <i class="fas fa-shield-alt text-emerald-300"></i>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Secure System</h3>
                                <p class="text-xs text-gray-400">Encrypted user data</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Bottom badge -->
                <div class="text-xs text-gray-400">
                    🚀 Trusted by modern SaaS users
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="p-6 lg:p-6 text-white flex flex-col justify-center">

                <!-- HEADER -->
                <div class="mb-4 text-center lg:text-left">
                    <h2 class="text-3xl font-bold">Create Account</h2>
                    <p class="text-sm text-gray-300 mt-1">
                        Start your journey in seconds
                    </p>
                </div>

                <!-- FORM -->
                <form method="POST" action="{{ route('register-submit') }}" class="space-y-3">
                    @csrf

                    <!-- NAME -->
                    <div>
                        <label class="text-sm text-gray-300">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full mt-1 rounded-2xl bg-white/5 border border-white/10 px-4 py-2.5 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/20"
                            placeholder="John Doe">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full mt-1 rounded-2xl bg-white/5 border border-white/10 px-4 py-2.5 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/20"
                            placeholder="name@example.com">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm text-gray-300">Password</label>
                        <div class="relative mt-1">
                            <input id="password" type="password" name="password" required
                                class="w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2.5 pr-10 text-sm"
                                placeholder="••••••••">

                            <button type="button" onclick="togglePassword('password','icon1')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-cyan-300">
                                <i id="icon1" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- CONFIRM -->
                    <div>
                        <label class="text-sm text-gray-300">Confirm Password</label>
                        <div class="relative mt-1">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2.5 pr-10 text-sm"
                                placeholder="••••••••">

                            <button type="button" onclick="togglePassword('password_confirmation','icon2')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-cyan-300">
                                <i id="icon2" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full mt-2 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 py-3 font-semibold
                        hover:scale-[1.02] transition">
                        Create Account
                    </button>
                </form>

                <!-- LOGIN -->
                <p class="text-center text-sm text-gray-300 mt-4">
                    Already have account?
                    <a href="{{ route('Login-page') }}" class="text-cyan-300 font-semibold hover:text-cyan-200">
                        Login
                    </a>
                </p>

            </div>

        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

<x-toast />
</body>
</html>