// Theme Toggle
const themeToggle = document.getElementById('theme-toggle');
const sunIcon = document.getElementById('sun-icon');
const moonIcon = document.getElementById('moon-icon');

function setTheme(isDark) {
    if (isDark) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        sunIcon?.classList.remove('hidden');
        moonIcon?.classList.add('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        sunIcon?.classList.add('hidden');
        moonIcon?.classList.remove('hidden');
    }
}

if (themeToggle) {
    const isDark = localStorage.getItem('theme') === 'dark' ||
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
    setTheme(isDark);

    themeToggle.addEventListener('click', () => {
        setTheme(!document.documentElement.classList.contains('dark'));
    });
}

// Navbar blur on scroll
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            navbar.classList.add('bg-white/80', 'dark:bg-dark-bg/80', 'backdrop-blur-lg', 'border-b', 'border-border/50');
            navbar.classList.remove('bg-transparent');
        } else {
            navbar.classList.remove('bg-white/80', 'dark:bg-dark-bg/80', 'backdrop-blur-lg', 'border-b', 'border-border/50');
            navbar.classList.add('bg-transparent');
        }
    });
}

// Mobile Menu Toggle
const mobileToggle = document.getElementById('mobile-menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');
const menuIcon = document.getElementById('menu-icon');
const closeIcon = document.getElementById('close-icon');

if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');
        menuIcon?.classList.toggle('hidden');
        closeIcon?.classList.toggle('hidden');
    });
}

// User Dropdown Toggle
const userMenuBtn = document.getElementById('user-menu-btn');
const userMenu = document.getElementById('user-dropdown-menu');

if (userMenuBtn && userMenu) {
    userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', () => {
        userMenu.classList.add('hidden');
    });

    userMenu.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') userMenu.classList.add('hidden');
    });
}

