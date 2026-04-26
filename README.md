# 🏥 Application de Gestion de Rendez-vous Médicaux

Une application web développée avec **Laravel** permettant de gérer les rendez-vous entre patients et médecins.

---

## 🚀 Fonctionnalités

* 🔐 Authentification (Login / Register)
* 👥 Gestion des rôles (Patient / Médecin)
* 📅 CRUD complet des rendez-vous
* 🔍 Recherche dynamique avec Axios (sans rechargement)
* 📬 Envoi d'email de confirmation
* 🌍 Interface multilingue (FR / EN)
* 🧩 Interface moderne avec modales (Bootstrap)
* 🌐 API REST (JSON)

---

## 🧱 Technologies utilisées

* Laravel 10+
* PHP 8+
* MySQL
* Blade
* Bootstrap 5
* Axios
* Vite

---

## ⚙️ Installation du projet

### 1️⃣ Cloner le projet

```bash
git clone https://github.com/abdehassko/AbderrahimElHasskouriCC2
cd AbderrahimElHasskouriCC2
```

---

### 2️⃣ Installer les dépendances

```bash
composer install
npm install
```

---

### 3️⃣ Configuration de l’environnement

```bash
cp .env.example .env
php artisan key:generate
```

👉 Modifier le fichier `.env` pour configurer la base de données :

```env
DB_DATABASE=nom_de_la_base
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4️⃣ Migration + Seeders (IMPORTANT)

```bash
php artisan migrate --seed
```

👉 Cette commande crée :

* les tables
* des utilisateurs de test
* des rendez-vous (données prêtes pour démo)

---

### 5️⃣ Lancer le projet

```bash
npm run dev
php artisan serve
```

👉 Accéder à l’application :

```
http://127.0.0.1:8000
```

---

## 🔑 Comptes de test

| Rôle    | Email                                     | Mot de passe |
| ------- | ----------------------------------------- | ------------ |
| Patient | [patient@test.com](mailto:test@test.com)  | password     |
| Médecin | [doctor@test.com](mailto:doctor@test.com) | password     |

---

## 🌐 API REST

### 📌 Lister les rendez-vous

```
GET /api/appointments
```

---

### 📌 Créer un rendez-vous

```
POST /api/appointments
```

Body JSON :

```json
{
  "patient_id": 1,
  "doctor_id": 2,
  "service_id": 1,
  "appointment_date": "2026-05-01 10:00:00",
  "status": "pending"
}
```

---

👉 Si problème de cache :

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

## 📁 Structure du projet (simplifiée)

* `app/Models` → Modèles (User, Appointment, Service)
* `app/Http/Controllers` → Logique métier
* `resources/views` → Interfaces Blade
* `routes/web.php` → Routes web
* `routes/api.php` → API REST

---

## ⚠️ Remarques

* Dans cette version de l’application, la gestion des **patients, médecins et services** (ajout, modification, suppression) n’est pas disponible via l’interface utilisateur.
* Ces données sont **pré-remplies automatiquement** grâce aux seeders pour faciliter les tests et la démonstration.
* L’utilisateur peut uniquement gérer les **rendez-vous** (création, modification, consultation, suppression).
* Les emails sont configurés en mode `log`, ce qui signifie qu’ils ne sont pas réellement envoyés mais enregistrés dans les logs du système.
* L’application peut être améliorée en ajoutant :

  * un module complet de gestion des utilisateurs (patients/médecins)
  * une interface d’administration pour les services
  * des notifications en temps réel

---

## 👨‍💻 Auteur

Projet réalisé par **Abderrahim El Hasskouri**
Formation Développement Digital - OFPPT

---
