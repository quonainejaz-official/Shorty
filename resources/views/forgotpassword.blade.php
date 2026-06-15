<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>

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

<body class="h-full font-inter bg-slate-950">

    <!-- FULL BACKGROUND FIX -->
    <div class="fixed inset-0 -z-10">
        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-br from-slate-950/90 via-slate-900/85 to-blue-950/90"></div>
    </div>

    <!-- BLURS -->
    <div class="fixed -top-32 -left-24 w-80 h-80 bg-cyan-500/20 rounded-full blur-3xl"></div>
    <div class="fixed -bottom-32 -right-24 w-80 h-80 bg-blue-600/20 rounded-full blur-3xl"></div>

    <!-- CENTER WRAPPER -->
    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <!-- CARD (bigger + better UX) -->
        <div class="w-full max-w-md rounded-3xl border border-white/10
        bg-white/10 backdrop-blur-3xl
        shadow-[0_25px_80px_rgba(0,0,0,0.6)]
        p-8">

            <!-- ICON -->
            <div class="flex justify-center mb-5">
                <div class="h-16 w-16 flex items-center justify-center rounded-2xl
                bg-gradient-to-br from-blue-500 to-cyan-400 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-key text-white text-xl"></i>
                </div>
            </div>

            <!-- TITLE -->
            <h2 class="text-center text-3xl font-bold text-white">
                Forgot Password
            </h2>

            <p class="text-center text-sm text-gray-300 mt-2">
                Enter your email and we’ll send you a password reset link
            </p>

            <!-- FORM -->
            <form method="POST" action="{{ route('forgot-password-submit') }}" class="mt-6 space-y-5">
                @csrf

                @if ($errors->any())
                <div class="mb-4 text-sm text-red-400 bg-red-500/10 border border-red-500/20 p-3 rounded-xl">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-300">Email Address</label>

                    <div class="relative mt-2">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fas fa-envelope text-sm"></i>
                        </div>

                        <input type="email" name="email" required
                            class="w-full rounded-2xl bg-white/5 border border-white/10
                        px-4 py-3 pl-11 text-sm text-white placeholder:text-gray-500
                        outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/30
                        transition"
                            placeholder="name@example.com">
                    </div>

                    @error('email')
                    <span class="text-xs text-red-400 mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500
                py-3.5 font-semibold text-white
                hover:scale-[1.02] active:scale-[0.99]
                transition-all duration-200 shadow-lg shadow-blue-500/20">
                    Send Reset Link
                </button>
            </form>

            <!-- BACK -->
            <p class="text-center text-sm text-gray-300 mt-6">
                Remember password?
                <a href="{{ route('Login-page') }}"
                    class="text-cyan-300 font-semibold hover:text-cyan-200 transition">
                    Login
                </a>
            </p>

        </div>
    </div>

    <x-toast />
</body>

</html>