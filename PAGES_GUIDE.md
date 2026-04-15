# 🚗 CarRent - Routes disponibles

## Pages principales

| Page | Route | URL |
|------|-------|-----|
| Accueil | / | http://127.0.0.1:8000/ |
| Services | /services | http://127.0.0.1:8000/services |
| Cars (Flotte) | /cars | http://127.0.0.1:8000/cars |
| À propos | /about | http://127.0.0.1:8000/about |
| Blog | /blog | http://127.0.0.1:8000/blog |
| Contact | /contact | http://127.0.0.1:8000/contact |

## Fichiers créés

### Contrôleurs
- `app/Http/Controllers/PageController.php` - Contrôleur pour les pages statiques

### Vues (Blade Templates)
- `resources/views/index.blade.php` - Page d'accueil
- `resources/views/pages/services.blade.php` - Page Services
- `resources/views/pages/cars.blade.php` - Page Cars
- `resources/views/pages/about.blade.php` - Page À propos
- `resources/views/pages/blog.blade.php` - Page Blog
- `resources/views/pages/contact.blade.php` - Page Contact

### CSS & Assets
- `public/css/custom.css` - Styles personnalisés pour les nouvelles pages

### Routes
Fichier `routes/web.php` contient toutes les routes

## Démarrage

```bash
# Si le serveur n'est pas démarré
php artisan serve
```

La page sera accessible sur **http://127.0.0.1:8000**

## Fonctionnalités

✅ Navigation complète avec menu
✅ Header/Footer identique sur toutes les pages
✅ Styles CSS personnalisés et cohérents
✅ Pages responsives (mobile-friendly)
✅ Liens internes correctement pointés vers les routes Laravel

## Notes

- Toutes les pages utilisent un layout cohérent
- Les images utilisent des assets du dossier `public/images/`
- Le formulaire de contact utilise `@csrf` pour la sécurité
- Les liens de navigation utilisent `/` pour les routes absolues
