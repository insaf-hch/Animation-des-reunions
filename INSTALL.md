# SmartMeeting — Guide d'installation

## Prérequis
- PHP 8.0+
- Composer
- Node.js
- MySQL
- Laravel installé

## Installation

### 1. Copier les fichiers dans votre projet
Copiez le contenu de ce dossier dans `C:\Users\pc\demo\`

### 2. Installer Laravel Breeze (si pas déjà fait)
```bash
cd C:\Users\pc\demo
composer require laravel/breeze:^1.29
php artisan breeze:install blade
```

### 3. Configurer la base de données
Dans `.env` :
```
DB_DATABASE=smartmeeting
DB_USERNAME=root
DB_PASSWORD=
```
Créez la base de données `smartmeeting` dans phpMyAdmin.

### 4. Générer la clé et migrer
```bash
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
```

### 5. Lancer le serveur
```bash
php artisan serve
```

## Accès
- URL : http://127.0.0.1:8000
- Email : ahmed@smartmeeting.ma
- Mot de passe : password

## Autres comptes
| Email | Rôle |
|-------|------|
| sara@smartmeeting.ma | Membre d'équipe |
| yassine@smartmeeting.ma | Membre d'équipe |
| lina@smartmeeting.ma | Consultant |
| omar@smartmeeting.ma | Directeur |

## Raccourcis clavier (salle de réunion)
- `M` → Mute/unmute micro
- `V` → Activer/désactiver caméra
- `S` → Partage d'écran
