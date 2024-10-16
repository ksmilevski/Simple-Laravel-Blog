<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{env('APP_NAME')}}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 text-slate-900">
<header class="bg-slate-800 shadow-lg">
    <nav>
        <a href="{{ route('posts.index') }}" class="nav-link">Home</a>
        @auth
            <div class="relative grid place-items-center"
            x-data="{ open: false }">
                <button @click="open=!open" type="button" class="">
                    <img src="https://picsum.photos/id/1/200/300" alt="" class="w-20 h-20 rounded-full ring-2 ring-offset-2 ring-blue-400 shadow-md">
                </button>

                <div @click.outside="open=false" x-show="open" class="bg-white shadow-xl border border-gray-200 absolute top-24 right-0 rounded-lg overflow-hidden font-light w-48">
                    <p class="username px-4 py-2 text-lg font-medium text-slate-800 border-b border-gray-200">
                        {{ auth()->user()->username }}
                    </p>
                    <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 px-4 py-2 text-gray-700 transition">
                        Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="block px-4 py-2">Logout</button>
                    </form>
                </div>
            </div>

        @endauth
        @guest
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            </div>
        @endguest

    </nav>
</header>
<main class="py-8 px-4 mx-auto max-w-sm">
    {{ $slot }}
</main>

<script>
    // Set form: x-data="formSubmit" @submit.prevent="submit" and button: x-ref="btn"
    document.addEventListener('alpine:init', () => {
        Alpine.data('formSubmit', () => ({
            submit() {
                this.$refs.btn.disabled = true;
                this.$refs.btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                this.$refs.btn.classList.add('bg-indigo-400');
                this.$refs.btn.innerHTML =
                    `<span class="absolute left-2 top-1/2 -translate-y-1/2 transform">
                        <i class="fa-solid fa-spinner animate-spin"></i>
                        </span>Please wait...`;

                this.$el.submit()
            }
        }))
    })
</script>
</body>
</html>
