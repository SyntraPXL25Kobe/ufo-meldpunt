# UFO Meldpunt

Een platform waarop burgers UFO-waarnemingen kunnen melden, volgen en beheren. Gebouwd met Laravel 13, Filament 5 en Tailwind CSS v4.

---

## Functionaliteiten

### Publiek
- **Melding indienen** — formulier met datum/tijd, locatie, categorie, beschrijving en optionele foto-upload
- **Bevestigingspagina** na het indienen van een melding
- **Homepagina** met live statistieken en recente meldingen
- **Over ons** pagina

### Ingelogde gebruikers (reporters)
- **Mijn meldingen** — gepagineerd overzicht van eigen ingediende meldingen met status-badges
- **E-mailbevestiging** na het indienen van een melding

### Admins
- **Filament admin dashboard** op `/admin`
- Meldingen beheren: status wijzigen (`Nieuw` → `In behandeling` → `Afgesloten`), details inzien
- Gebruikers beheren: rollen toewijzen (`admin` / `reporter`)
- **E-mailmelding** bij elke nieuwe inzending

---

## Technische stack

| Onderdeel     | Versie              |
|---------------|---------------------|
| PHP           | ^8.3                |
| Laravel       | ^13.8               |
| Filament      | ^5.0                |
| Tailwind CSS  | v4 (via `@tailwindcss/vite`) |
| Database      | SQLite (standaard)  |
| Testing       | Pest ^4             |

---

## Installatie

### Vereisten
- PHP 8.3+
- Composer
- Node.js 20+ & npm

### Stappen

```bash
# 1. Kloon de repository
git clone <repo-url>
cd ufo-meldpunt

# 2. Installeer PHP-afhankelijkheden
composer install

# 3. Installeer Node-afhankelijkheden en bouw assets
npm install && npm run build

# 4. Kopieer de omgevingsconfiguratie
cp .env.example .env

# 5. Genereer de applicatiesleutel
php artisan key:generate

# 6. Maak de database aan en voer migraties + seed uit
touch database/database.sqlite
php artisan migrate --seed

# 7. Maak de storage symlink aan
php artisan storage:link
```

Open de applicatie via je lokale server (bijv. Laravel Herd: `http://ufo-meldpunt.test`).

---

## Testaccounts (na seeding)

| E-mail                      | Wachtwoord | Rol      |
|-----------------------------|------------|----------|
| `admin@ufomeldpunt.nl`      | `password` | Admin    |
| `melder@ufomeldpunt.nl`     | `password` | Reporter |

Het admin dashboard is bereikbaar via `/admin`.

---

## Projectstructuur

```
app/
├── Filament/Resources/
│   ├── ReportResource.php      # Admin: meldingen beheren
│   └── UserResource.php        # Admin: gebruikers beheren
├── Http/Controllers/
│   ├── AuthController.php      # Registreren, inloggen, uitloggen
│   ├── ReportController.php    # Melding indienen (create/store/thank-you)
│   └── MyReportsController.php # Mijn meldingen (ingelogd)
├── Models/
│   ├── Report.php              # UFO-melding model
│   └── User.php                # Gebruiker met rolbeheer
└── Notifications/
    ├── NewReportUser.php       # E-mail naar melder
    └── NewReportAdmin.php      # E-mail naar admins

resources/views/
├── layouts/app.blade.php       # Gedeelde layout
├── home.blade.php
├── over-ons.blade.php
├── reports/                    # Melding indienen & bedankt
├── my-reports/                 # Mijn meldingen overzicht
└── auth/                       # Login & registratie
```

---

## Rollen

| Rol        | Toegang                                              |
|------------|------------------------------------------------------|
| `reporter` | Meldingen indienen, eigen meldingen bekijken         |
| `admin`    | Alles van reporter + Filament admin panel            |

Nieuwe gebruikers krijgen automatisch de rol `reporter` bij registratie.

---

## E-mailconfiguratie

Stel in `.env` een maildriver in voor het versturen van notificaties:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=noreply@ufomeldpunt.nl
MAIL_FROM_NAME="UFO Meldpunt"
```

Voor lokale ontwikkeling kun je `MAIL_MAILER=log` gebruiken — e-mails worden dan weggeschreven naar `storage/logs/laravel.log`.

---

## Lokale ontwikkeling

```bash
# Development server met Vite HMR
npm run dev

# Tests uitvoeren
php artisan test
```

---

## Licentie

MIT
