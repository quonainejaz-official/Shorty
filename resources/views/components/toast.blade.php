@php
// Image ke hisaab se colors aur icons set kiye
$toastMap = [
    'success' => ['bar' => 'bg-emerald-500', 'icon' => '✔', 'title' => 'Success!'],
    'error'   => ['bar' => 'bg-rose-500',    'icon' => '✖', 'title' => 'Error!'],
    'warning' => ['bar' => 'bg-orange-500',  'icon' => '!',  'title' => 'Warning!'],
    'info'    => ['bar' => 'bg-blue-500',    'icon' => '?',  'title' => 'Help!'],
];

// Session se toasts nikaalna (Aapke logic ke hisaab se)
$toasts = collect(['success','error','warning','info'])
    ->map(fn($t) => session($t) ? ['type'=>$t,'message'=>session($t)] : null)
    ->filter();
@endphp

@if($toasts->isNotEmpty())

<div id="toast-container"
     class="fixed top-6 right-6 z-[9999] flex flex-col gap-4 w-[380px]">

@foreach($toasts as $i => $toast)
@php 
    $ui = $toastMap[$toast['type']] ?? $toastMap['info']; 
    // Default Message agar title map mein nahi hai
    $title = $ui['title'];
    $message = $toast['message'];
@endphp

<div
    id="toast-{{ $i }}"
    data-toast
    class="relative overflow-hidden rounded-xl bg-white shadow-xl ring-1 ring-black/5
    flex items-start gap-4 p-4 pl-0
    translate-x-[120%] opacity-0 scale-95
    transition-all duration-500 ease-out"
>

    {{-- Left Colored Bar (Image jaisa) --}}
    <div class="w-[6px] h-full min-h-[50px] rounded-r-full {{ $ui['bar'] }} shrink-0 ml-2"></div>

    {{-- Icon (Circle with light bg) --}}
    <div class="w-10 h-10 flex items-center justify-center rounded-full 
        {{ $ui['bar'] == 'bg-emerald-500' ? 'bg-emerald-100 text-emerald-600' : '' }}
        {{ $ui['bar'] == 'bg-rose-500' ? 'bg-rose-100 text-rose-600' : '' }}
        {{ $ui['bar'] == 'bg-orange-500' ? 'bg-orange-100 text-orange-600' : '' }}
        {{ $ui['bar'] == 'bg-blue-500' ? 'bg-blue-100 text-blue-600' : '' }}
        text-lg font-bold shrink-0">
        {{ $ui['icon'] }}
    </div>

    {{-- Content (Title + Message) --}}
    <div class="flex-1 flex flex-col">
        <span class="font-bold text-slate-800 text-base leading-tight">
            {{ $title }}
        </span>
        <span class="text-slate-500 text-sm leading-relaxed mt-0.5">
            {{ $message }}
        </span>
    </div>

    {{-- Close Button (X) --}}
    <button
        onclick="closeToast(this)"
        class="absolute top-3 right-3 w-6 h-6 flex items-center justify-center
        text-slate-400 hover:text-slate-600 transition hover:bg-slate-100 rounded-full"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>

</div>

@endforeach

</div>

<style>
/* Animation for the progress bar */
.toast-progress {
    animation: toastProgress 5s linear forwards;
}

@keyframes toastProgress {
    from { transform: scaleX(1); transform-origin: left; }
    to   { transform: scaleX(0); transform-origin: left; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const toasts = document.querySelectorAll("[data-toast]");

    toasts.forEach((toast, i) => {
        // Staggered animation entry
        const showDelay = i * 100;
        setTimeout(() => {
            toast.classList.remove("translate-x-[120%]", "opacity-0", "scale-95");
        }, showDelay);

        // Auto close timer (5 seconds)
        let timer = setTimeout(() => hideToast(toast), 5000);

        // Pause on hover
        toast.addEventListener("mouseenter", () => clearTimeout(timer));
        toast.addEventListener("mouseleave", () => {
            timer = setTimeout(() => hideToast(toast), 2000);
        });
    });
});

function closeToast(btn) {
    hideToast(btn.closest("[data-toast]"));
}

function hideToast(el) {
    if (!el) return;
    // Exit animation
    el.classList.add("translate-x-[120%]", "opacity-0", "scale-95");

    setTimeout(() => el.remove(), 350);

    const container = document.getElementById("toast-container");
    if (container && container.children.length === 0) {
        container.remove();
    }
}
</script>

@endif