<x-guest-layout>
    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">
        Bienvenue sur Flowsky
    </h1>
    <p class="text-slate-500 dark:text-slate-400 mb-8">
        Connectez-vous pour accéder à votre espace
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Adresse email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full bg-slate-100 dark:bg-slate-800 border-0 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-2 focus:ring-brand focus:bg-white dark:focus:bg-slate-700">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Mot de passe
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full bg-slate-100 dark:bg-slate-800 border-0 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-2 focus:ring-brand focus:bg-white dark:focus:bg-slate-700">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                <input type="checkbox" name="remember" class="rounded" style="accent-color:#53B0AE">
                Se souvenir de moi
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-brand-dark hover:underline font-medium">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <button type="submit"
                class="w-full bg-brand-dark hover:bg-brand text-white rounded-xl py-3 text-sm font-semibold transition">
            Se connecter
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-8">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="text-brand-dark font-semibold hover:underline">S'inscrire</a>
    </p>
</x-guest-layout>