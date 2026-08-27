<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Registration System')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Fraunces"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        rose: {
                            50:  '#FDF2F6',
                            100: '#FCE4EC',
                            200: '#F9C6D9',
                            300: '#F3A0BF',
                            400: '#E96FA0',
                            500: '#D6336C',
                            600: '#B02358',
                            700: '#8C1A46',
                            800: '#6B1436',
                            900: '#4A0D26',
                        },
                        ink: {
                            50:  '#F8F4F6',
                            100: '#EFE4E9',
                            200: '#DCC7D0',
                            400: '#8C7480',
                            500: '#6B5560',
                            600: '#54424C',
                            700: '#3B2530',
                            800: '#2B1A22',
                            900: '#1D1116',
                        },
                    },
                    boxShadow: {
                        soft: '0 1px 2px rgba(74,13,38,0.04), 0 8px 24px -8px rgba(74,13,38,0.12)',
                    },
                    keyframes: {
                        'toast-in': {
                            '0%':   { transform: 'translateY(-24px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        'pop-in': {
                            '0%':   { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                    },
                    animation: {
                        'toast-in': 'toast-in 0.35s cubic-bezier(0.16, 1, 0.3, 1)',
                        'pop-in': 'pop-in 0.3s cubic-bezier(0.16, 1, 0.3, 1)',
                    },
                },
            },
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Fraunces', serif; font-feature-settings: 'ss01'; }
    </style>
</head>
<body class="bg-rose-50 text-ink-800 min-h-screen antialiased">

    <nav class="border-b border-rose-100 bg-white/80 backdrop-blur sticky top-0 z-10">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-ink-800 text-rose-100 font-display font-semibold text-sm group-hover:bg-rose-600 transition-colors">SR</span>
                <span class="font-display font-semibold text-lg tracking-tight text-ink-800">College of Information Technology</span>
            </a>
            <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}"
               class="hidden sm:inline-flex items-center gap-2 rounded-full text-ink-600 text-sm font-semibold px-4 py-2.5 hover:bg-rose-50 transition-colors">
                Dashboard
            </a>
            <a href="{{ route('students.create') }}"
               class="inline-flex items-center gap-2 rounded-full bg-rose-600 text-white text-sm font-semibold px-5 py-2.5 shadow-soft hover:bg-rose-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 4a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V5a1 1 0 011-1z" />
                </svg>
                Register Student
            </a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">
        @yield('content')
    </main>

    @if (session('success'))
        <div id="toast-success"
             class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-ink-900/40 backdrop-blur-sm">
            <div class="animate-pop-in w-full max-w-sm rounded-3xl bg-white shadow-soft px-8 py-9 text-center">
                <span class="relative mx-auto flex items-center justify-center w-16 h-16 rounded-full bg-rose-600 text-white mb-5">
                    <span class="absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75 animate-ping"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="relative w-8 h-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.415l-7.5 7.5a1 1 0 01-1.415 0l-3.5-3.5a1 1 0 111.415-1.415L8.5 12.086l6.79-6.795a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <h2 class="font-display text-xl font-semibold text-ink-800 mb-1.5">Success!</h2>
                <p class="text-sm text-ink-500 mb-6">{{ session('success') }}</p>
                <button type="button" onclick="document.getElementById('toast-success').remove()"
                        class="w-full rounded-full bg-rose-600 text-white font-semibold text-sm py-3 shadow-soft hover:bg-rose-700 transition-colors">
                    Continue
                </button>
            </div>
        </div>

        <script>
            setTimeout(function () {
                var toast = document.getElementById('toast-success');
                if (!toast) return;
                toast.style.transition = 'opacity 0.3s ease';
                toast.style.opacity = '0';
                setTimeout(function () { toast.remove(); }, 300);
            }, 4000);
        </script>
    @endif


</body>
</html>
