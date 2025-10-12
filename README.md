# 🏭 Gestion de Stock

> Application web de gestion de stock développée avec Laravel

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql)

## ✨ Fonctionnalités

| Module | Description |
|--------|-------------|
| 📦 **Produits** | Gestion complète des produits et inventaire |
| 🗂️ **Catégories** | Organisation des produits par catégories |
| 📥 **Entrées** | Suivi des approvisionnements en stock |
| 📤 **Sorties** | Gestion des sorties et ventes |
| 👥 **Utilisateurs** | Système d'authentification sécurisé |
| 📊 **Dashboard** | Vue d'ensemble des stocks |

## 🛠️ Stack Technique


Backend:    Laravel 10.x | PHP 8.x
Frontend:   Blade | SCSS | JavaScript
Database:   MySQL
Auth:       Laravel Sanctum
🚀 Installation Rapide
bash
# 1. Cloner le projet
git clone https://github.com/votre-repo/gestion-stock.git
cd gestion-stock

# 2. Installer les dépendances
composer install
npm install

# 3. Configuration
cp .env.example .env
php artisan key:generate

# 4. Base de données
# 📝 Configurer .env avec vos accès DB
php artisan migrate

# 5. Lancer l'application
php artisan serve
npm run dev
📍 Accès: http://localhost:8000

📁 Structure des Migrations
Fichier	Description
users_table	Gestion des utilisateurs
categories_table	Catégories de produits
produits_table	Table principale des produits
entrees_table	Historique des entrées stock
sorties_table	Historique des sorties stock
products_table	Structure étendue produits
🎯 Utilisation
🔐 Connexion à l'application

🗂️ Créer des catégories

📦 Ajouter des produits

📥 Enregistrer les entrées

📤 Gérer les sorties

📊 Consulter les stocks

📊 Statistiques Code
https://img.shields.io/badge/SCSS-43.9%2525-CC6699?style=flat-square
https://img.shields.io/badge/CSS-24.7%2525-1572B6?style=flat-square
https://img.shields.io/badge/Blade-15.6%2525-FF2D20?style=flat-square
https://img.shields.io/badge/PHP-15.4%2525-777BB4?style=flat-square
https://img.shields.io/badge/JavaScript-0.4%2525-F7DF1E?style=flat-square

🤝 Contribution
Les contributions sont les bienvenues ! N'hésitez pas à fork et proposer des PR.

📄 License
MIT License - Voir le fichier LICENSE pour plus de détails.

<div align="center">
Développé avec ❤️ en Laravel

Dernière mise à jour: 2024

</div> ```
