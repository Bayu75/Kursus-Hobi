<aside class="w-full shrink-0 lg:w-64">
    <nav class="space-y-1 rounded-2xl border border-border bg-surface-alt p-4 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-start/10 text-primary-start' : 'text-text-secondary hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-dark-bg' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary-start/10 text-primary-start' : 'text-text-secondary hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-dark-bg' }}">
            Peserta
        </a>
        <a href="{{ route('admin.categories.index') }}"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-primary-start/10 text-primary-start' : 'text-text-secondary hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-dark-bg' }}">
            Kategori
        </a>
        <a href="{{ route('admin.instructors.index') }}"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.instructors.*') ? 'bg-primary-start/10 text-primary-start' : 'text-text-secondary hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-dark-bg' }}">
            Instruktur
        </a>
        <a href="{{ route('admin.courses.index') }}"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.courses.*') ? 'bg-primary-start/10 text-primary-start' : 'text-text-secondary hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-dark-bg' }}">
            Kursus
        </a>
    </nav>
</aside>
