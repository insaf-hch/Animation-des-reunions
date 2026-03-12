# 🚀 SmartMeeting — Guide d'installation complet

## Prérequis
- PHP 8.2+
- Composer
- XAMPP (MySQL + Apache)
- Node.js (optionnel)

---

## ✅ ÉTAPE 1 — Créer le projet Laravel

```bash
cd C:\Users\pc
composer create-project laravel/laravel smartmeeting
cd smartmeeting
```

---

## ✅ ÉTAPE 2 — Installer Laravel Breeze (authentification)

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
```

---

## ✅ ÉTAPE 3 — Copier tous les fichiers du projet

Copiez les fichiers dans les dossiers correspondants :

| Fichier source               | Destination dans C:\Users\pc\smartmeeting\ |
|------------------------------|--------------------------------------------|
| .env                         | .env                                       |
| routes/web.php               | routes/web.php                             |
| app/Models/*.php             | app/Models/                                |
| app/Http/Controllers/*.php   | app/Http/Controllers/                      |
| database/migrations/*.php    | database/migrations/                       |
| database/seeders/*.php       | database/seeders/                          |
| resources/views/**           | resources/views/                           |

---

## ✅ ÉTAPE 4 — Configurer la base de données

### 4a. Ouvrir phpMyAdmin
Allez sur : http://localhost/phpmyadmin

### 4b. Créer la base de données
```sql
CREATE DATABASE smartmeeting2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4c. Vérifier le fichier .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smartmeeting
DB_USERNAME=root
DB_PASSWORD=
```
> Si votre MySQL a un mot de passe, modifiez DB_PASSWORD=votre_mot_de_passe

---

## ✅ ÉTAPE 5 — Générer la clé de l'application

```bash
php artisan key:generate
```

---

## ✅ ÉTAPE 6 — IMPORTANT : Supprimer les anciennes migrations

Laravel Breeze crée ses propres migrations. Il faut supprimer les doublons :

```bash
# Supprimez ces fichiers si ils existent dans database/migrations/ :
# - 2014_10_12_000000_create_users_table.php  ← GARDER (Laravel de base)
# - 2014_10_12_100000_create_password_reset_tokens_table.php ← GARDER
# - 2019_08_19_000000_create_failed_jobs_table.php ← GARDER
# - 2019_12_14_000001_create_personal_access_tokens_table.php ← GARDER
# - 2024_01_02_000001_create_meetings_table.php ← SUPPRIMER (doublon)
# - 2024_01_02_000002_create_participants_table.php ← SUPPRIMER (doublon)
# - 2024_01_02_000003_create_smartmeeting_tables.php ← SUPPRIMER (doublon)
# GARDER UNIQUEMENT : 2024_01_01_000001_create_smartmeeting_schema.php
```

Sur Windows (PowerShell) :
```powershell
Remove-Item "database\migrations\2024_01_02_000001_create_meetings_table.php" -ErrorAction SilentlyContinue
Remove-Item "database\migrations\2024_01_02_000002_create_participants_table.php" -ErrorAction SilentlyContinue
Remove-Item "database\migrations\2024_01_02_000003_create_smartmeeting_tables.php" -ErrorAction SilentlyContinue
```

---

## ✅ ÉTAPE 7 — Lancer les migrations

```bash
php artisan migrate
```

Si erreur "table already exists" :
```bash
php artisan migrate:fresh
```

---

## ✅ ÉTAPE 8 — Remplir la base de données (données de test)

```bash
php artisan db:seed
```

---

## ✅ ÉTAPE 9 — Démarrer le serveur

```bash
php artisan serve
```

Ouvrez : **http://127.0.0.1:8000**

---

## 🔑 Comptes de test

| Email                     | Mot de passe | Rôle           |
|---------------------------|--------------|----------------|
| ahmed@smartmeeting.ma     | password     | Chef de projet |
| sara@smartmeeting.ma      | password     | Développeuse   |
| yassine@smartmeeting.ma   | password     | Designer       |
| lina@smartmeeting.ma      | password     | Analyste       |
| nadia@smartmeeting.ma     | password     | Directrice     |
| omar@smartmeeting.ma      | password     | Consultant     |

---

## 🗂️ Structure des fichiers à copier

```
smartmeeting/
├── .env                                          ← Configuration DB
├── routes/
│   └── web.php                                   ← Routes
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Meeting.php
│   │   ├── Participant.php
│   │   ├── Agenda.php
│   │   ├── Decision.php
│   │   ├── Task.php
│   │   └── Note.php
│   └── Http/
│       └── Controllers/
│           ├── DashboardController.php
│           ├── MeetingController.php
│           ├── TaskController.php
│           ├── ReportController.php
│           ├── StatsController.php
│           └── ParticipantController.php
├── database/
│   ├── migrations/
│   │   └── 2024_01_01_000001_create_smartmeeting_schema.php
│   └── seeders/
│       └── DatabaseSeeder.php
└── resources/
    └── views/
        ├── welcome.blade.php                     ← Landing page
        ├── dashboard.blade.php
        ├── layouts/
        │   └── app.blade.php
        ├── auth/
        │   ├── login.blade.php
        │   └── register.blade.php
        ├── meetings/
        │   ├── index.blade.php
        │   ├── edit.blade.php
        │   └── room.blade.php
        ├── tasks/
        │   └── index.blade.php
        ├── report/
        │   └── show.blade.php
        ├── stats/
        │   └── index.blade.php
        └── participants/
            └── index.blade.php
```

---

## 🛠️ Commandes récapitulatif (tout en une fois)

```bash
cd C:\Users\pc\smartmeeting
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
php artisan serve
```

---

## ❓ Résolution de problèmes courants

### Erreur : "SQLSTATE: Base table already exists"
```bash
php artisan migrate:fresh --seed
```

### Erreur : "Class not found"
```bash
composer dump-autoload
```

### Erreur : "View not found"
Vérifiez que tous les fichiers .blade.php sont dans le bon dossier.

### Erreur : "Route not found"
```bash
php artisan route:clear
php artisan cache:clear
```

### Erreur sur la colonne 'role' (users)
Si la table users existe déjà sans la colonne role :
```bash
php artisan migrate:fresh --seed
```

---

## 🎯 Pages disponibles

| URL                          | Description              |
|------------------------------|--------------------------|
| /                            | Landing page             |
| /login                       | Connexion                |
| /register                    | Inscription              |
| /dashboard                   | Tableau de bord          |
| /meetings                    | Liste des réunions       |
| /meetings/{id}/room          | Salle d'animation        |
| /meetings/{id}/edit          | Modifier réunion         |
| /tasks                       | Gestion des tâches       |
| /report/{id}                 | Compte rendu             |
| /stats                       | Statistiques             |
| /participants                | Équipe                   |
