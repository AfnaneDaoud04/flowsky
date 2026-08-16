<x-guest-layout>
    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">
        Créez votre compte
    </h1>
    <p class="text-slate-500 dark:text-slate-400 mb-8">
        Rejoignez Flowsky pour gérer vos projets
    </p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Nom complet
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full bg-slate-100 dark:bg-slate-800 border-0 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-2 focus:ring-brand focus:bg-white dark:focus:bg-slate-700">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Adresse email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full bg-slate-100 dark:bg-slate-800 border-0 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-2 focus:ring-brand focus:bg-white dark:focus:bg-slate-700">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Mot de passe
            </label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full bg-slate-100 dark:bg-slate-800 border-0 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-2 focus:ring-brand focus:bg-white dark:focus:bg-slate-700">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Confirmer le mot de passe
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full bg-slate-100 dark:bg-slate-800 border-0 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-2 focus:ring-brand focus:bg-white dark:focus:bg-slate-700">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <button type="submit"
                class="w-full bg-brand-dark hover:bg-brand text-white rounded-xl py-3 text-sm font-semibold transition">
            Créer mon compte
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-8">
        Déjà un compte ?
        <a href="{{ route('login') }}" class="text-brand-dark font-semibold hover:underline">Se connecter</a>
    </p>
</x-guest-layout>