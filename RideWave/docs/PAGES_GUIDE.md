# RideWave Page Guide

## Active web pages

| Area | Route name | URL |
|------|------------|-----|
| Landing page | `home` | `/` |
| Login | `login` | `/login` |
| Register | `register` | `/register` |
| Passenger home | `passenger.home` | `/passenger/home` |
| Passenger find rides | `passenger.find-rides` | `/passenger/find-rides` |
| Passenger history | `passenger.history` | `/passenger/history` |
| Passenger profile | `passenger.profile.edit` | `/passenger/profile` |
| Driver dashboard | `driver.dashboard` | `/driver/dashboard` |
| Driver find rides | `driver.find-rides` | `/driver/find-rides` |
| Driver offer ride | `driver.offer-ride.create` | `/driver/offer-ride` |
| Driver fleet | `driver.fleet` | `/driver/fleet` |
| Driver history | `driver.history` | `/driver/history` |
| Driver profile | `driver.profile.edit` | `/driver/profile` |
| Admin dashboard | `admin.dashboard` | `/admin/dashboard` |

## Active view structure

- `resources/views/index.blade.php`: public landing page
- `resources/views/auth/`: login and register screens
- `resources/views/passenger/`: passenger-facing pages and partials
- `resources/views/driver/`: driver-facing pages and partials
- `resources/views/admin/`: admin dashboard pages
- `resources/views/layouts/public.blade.php`: public shell
- `resources/views/layouts/portal.blade.php`: shared authenticated shell
- `resources/views/partials/`: theme helpers used by current pages

## Cleanup note

Legacy brochure pages and old HTML template exports were removed so the project matches the current role-based Laravel app more closely.
