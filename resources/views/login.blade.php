<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Login')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
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
            class="w-full h-full object-cover"
            alt="">

        <div
            class="absolute inset-0 bg-gradient-to-br from-slate-950/80 via-slate-900/75 to-blue-950/80">
        </div>
    </div>

    <!-- Gradient Blurs -->
    <div
        class="absolute -top-32 -left-24 w-72 h-72 bg-cyan-500/20 rounded-full blur-3xl">
    </div>

    <div
        class="absolute -bottom-32 -right-24 w-72 h-72 bg-blue-600/20 rounded-full blur-3xl">
    </div>

    <!-- Main -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-5">

        <!-- Card -->
        <div
            class="w-full max-w-3xl overflow-hidden rounded-[28px] border border-white/10 ring-1 ring-white/10 bg-white/10 backdrop-blur-2xl shadow-[0_20px_60px_rgba(0,0,0,0.45)] max-h-[88vh]">

            <div class="grid lg:grid-cols-2">

                <!-- LEFT -->
                <div
                    class="hidden lg:flex flex-col justify-between border-r border-white/10 p-6">

                    <!-- Top -->
                    <div>

                        <!-- Logo -->
                        <div
                            class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 shadow-lg shadow-blue-500/30">

                            <i class="fas fa-link text-lg text-white"></i>
                        </div>

                        <!-- Heading -->
                        <h1
                            class="text-3xl font-extrabold leading-tight text-white">

                            Smart Links.<br>
                            Better Reach.
                        </h1>

                        <p
                            class="mt-3 max-w-sm text-sm leading-relaxed text-gray-300">

                            Create branded short URLs, monitor clicks
                            and manage your traffic analytics in one place.
                        </p>
                    </div>

                    <!-- Features -->
                    <div class="space-y-3 mt-6">

                        <div
                            class="flex items-center gap-3 rounded-2xl border border-white/5 bg-white/5 p-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-500/10 text-cyan-300">

                                <i class="fas fa-chart-line text-sm"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-white">
                                    Live Analytics
                                </h3>

                                <p class="text-xs text-gray-400">
                                    Track clicks in real-time
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-center gap-3 rounded-2xl border border-white/5 bg-white/5 p-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-300">

                                <i class="fas fa-bolt text-sm"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-white">
                                    Fast Redirects
                                </h3>

                                <p class="text-xs text-gray-400">
                                    Optimized high-speed routing
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-center gap-3 rounded-2xl border border-white/5 bg-white/5 p-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-300">

                                <i class="fas fa-shield-alt text-sm"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-white">
                                    Secure Platform
                                </h3>

                                <p class="text-xs text-gray-400">
                                    Reliable & protected access
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT -->
                <div class="p-5 sm:p-6 lg:p-7 text-white flex flex-col justify-center">

                    <!-- Mobile Logo -->
                    <div class="flex justify-center lg:hidden mb-4">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 shadow-lg shadow-blue-500/30">

                            <i class="fas fa-link text-lg text-white"></i>
                        </div>
                    </div>

                    <!-- Header -->
                    <div class="mb-5 text-center lg:text-left">

                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-xs font-medium text-cyan-300">

                            <span class="h-2 w-2 rounded-full bg-cyan-400"></span>

                            Secure Login
                        </div>

                        <h2
                            class="mt-3 text-3xl font-bold tracking-tight text-white">

                            Welcome Back
                        </h2>

                        <p class="mt-2 text-sm text-gray-300">
                            Login to continue managing your short links.
                        </p>
                    </div>

                    <!-- Form -->
                    <form
                        method="POST"
                        action="{{ route('login-submit') }}"
                        class="space-y-3">

                        @csrf

                        <!-- Email -->
                        <div>

                            <label
                                class="mb-2 block text-sm font-medium text-gray-300">

                                Email Address
                            </label>

                            <div class="relative">

                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">

                                    <i class="fas fa-envelope text-sm"></i>
                                </div>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    placeholder="name@example.com"
                                    class="w-full rounded-2xl border border-white/10 bg-white/5 py-3 pl-11 pr-4 text-sm text-white placeholder:text-gray-500 outline-none transition-all duration-300 focus:border-cyan-400 focus:bg-white/10 focus:ring-4 focus:ring-cyan-500/10">

                            </div>

                            @error('email')
                                <span class="mt-2 block text-xs text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>

                            <div class="mb-2 flex items-center justify-between">

                                <label class="text-sm font-medium text-gray-300">
                                    Password
                                </label>

                                <a
                                    href="{{ route('forgot-password') }}"
                                    class="text-xs font-medium text-cyan-300 transition hover:text-cyan-200">

                                    Forgot Password?
                                </a>
                            </div>

                            <div class="relative">

                                <!-- Lock Icon -->
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">

                                    <i class="fas fa-lock text-sm"></i>
                                </div>

                                <!-- Input -->
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    placeholder="Enter your password"
                                    class="w-full rounded-2xl border border-white/10 bg-white/5 py-3 pl-11 pr-12 text-sm text-white placeholder:text-gray-500 outline-none transition-all duration-300 focus:border-cyan-400 focus:bg-white/10 focus:ring-4 focus:ring-cyan-500/10">

                                <!-- Eye Toggle -->
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 transition hover:text-cyan-300">

                                    <i id="passwordIcon" class="fa-solid fa-eye"></i>
                                </button>

                            </div>

                            @error('password')
                                <span class="mt-2 block text-xs text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Remember -->
                        <div class="flex items-center justify-between pt-1">

                            <label
                                class="flex cursor-pointer items-center gap-2 text-sm text-gray-300">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="h-4 w-4 rounded border-white/20 bg-transparent text-blue-500 focus:ring-blue-500">

                                Remember me
                            </label>

                        </div>

                        <!-- Submit -->
                        <button
                            type="submit"
                            class="group mt-1 flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-cyan-500/40 active:scale-[0.98]">

                            Sign In

                            <i
                                class="fas fa-arrow-right text-xs transition group-hover:translate-x-1">
                            </i>
                        </button>

                    </form>

                    <!-- Divider -->
                    <div class="my-4 flex items-center gap-3">

                        <div class="h-px flex-1 bg-white/10"></div>

                        <span class="text-xs text-gray-400">
                            Continue Your Journey
                        </span>

                        <div class="h-px flex-1 bg-white/10"></div>
                    </div>

                    <!-- Register -->
                    <div class="text-center">

                        <p class="text-sm text-gray-300">

                            Don’t have an account?

                            <a
                                href="{{ route('Register-page') }}"
                                class="font-semibold text-cyan-300 transition hover:text-cyan-200">

                                Create Account
                            </a>
                        </p>

                    </div>

                    <!-- Footer -->
                    <div
                        class="mt-5 flex flex-col items-center justify-between gap-3 border-t border-white/10 pt-4 text-xs text-gray-400 sm:flex-row">

                        <span>
                            © {{ date('Y') }} URL Shortener
                        </span>

                        <div class="flex items-center gap-4">

                            <a href="#" class="transition hover:text-white">
                                Privacy
                            </a>

                            <a href="#" class="transition hover:text-white">
                                Terms
                            </a>

                            <a href="#" class="transition hover:text-white">
                                Support
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {

            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');

            } else {

                passwordInput.type = 'password';

                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>
    
    <x-toast />
</body>

</html>