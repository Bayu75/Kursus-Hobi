# Task Checklist — Kursus Hobi

**Progress: 100% — 22 tests, 60 assertions, all passing**

## ✅ Completed

| # | Modul | Status |
|---|---|---|
| 1 | Project Setup (Laravel 13, MySQL, Tailwind v4, Vite) | ✅ |
| 2 | Database (9 migrations + seeders) | ✅ |
| 3 | Models (9 models with Eloquent relations) | ✅ |
| 4 | Auth (Register, Login, Logout, role redirect, admin guard) | ✅ |
| 5.1 | Dashboard User (stats + tabs) + Admin (stats + payment table) | ✅ |
| 5.2 | Katalog & Filter (CourseFilterService, search/type/category/price) | ✅ |
| 5.3 | Payment Upload (enrollment, bank info, MIME validation) | ✅ |
| 5.4 | Admin Verifikasi (approve/reject with reason) + Mark Complete | ✅ |
| 5.5 | Video Classroom (70/30 layout, Vanilla JS playlist) | ✅ |
| 5.6 | Rating & Review (star rating JS, modal with backdrop blur) | ✅ |
| 7.1 | Landing page (hero, categories link, featured courses with rating & thumbnails) | ✅ |
| 7.2 | Auth views (login, register with avatar upload) | ✅ |
| 7.3 | Course explorer + detail with rating + payment page | ✅ |
| 7.4 | User dashboard (modal review) + Admin dashboard + Verify page | ✅ |
| 7.5 | Learning room + Review modal | ✅ |
| — | **Admin CRUD** (categories, instructors, courses) | ✅ |
| — | **Schedule/Material management** (add/delete from edit page) | ✅ |
| — | **Admin manage users** (list + delete) | ✅ |
| — | **Profile page** (edit name, email, phone, avatar, password) | ✅ |
| — | **Pagination styling** (rounded-full, gradient active) | ✅ |
| — | **Form Request Validation** (10 request classes) | ✅ |
| — | **Responsiveness polish** (hamburger menu, overflow-x-auto) | ✅ |
| — | **Feature Tests** (22 tests covering all core flows) | ✅ |


## Key Additions (final sprint)

- Thumbnail images on course cards (fallback placeholder)
- Category cards on landing → filter katalog
- Course cards on landing → link to detail
- Logo SVG in navbar with dark mode invert
- Avatar upload during registration + profile page
- Add/delete schedules (offline) and materials (online) from admin course edit
- Admin user management (list + delete with guards)
- Feature tests: EnrollmentFlowTest (7), AdminVerificationTest (8), ReviewFlowTest (5)
