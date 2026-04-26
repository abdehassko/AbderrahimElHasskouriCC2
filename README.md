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

👉 Modifier le fichier `.env` pour configurer la base de données et le serveur mail :

```env
DB_DATABASE=nom_de_la_base
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_USERNAME=your_email
MAIL_PASSWORD=your_email_app_password
```

---

### 4️⃣ Installer api

```bash
php artisan install:api
```

### 5️⃣ Migration + Seeders

```bash
php artisan migrate --seed
```

👉 Cette commande crée :

* les tables
* des utilisateurs de test
* des rendez-vous (données prêtes pour démo)

---

### 6️⃣ Lancer le projet

```bash
npm run dev
php artisan serve
```

👉 Accéder à l’application :

```
http://127.0.0.1:8000
```

---

## 🔑 Compte de test

 Email                                                      | Mot de passe |
 ---------------------------------------------------------- | ------------ |
 [admin@cliniquemaroc.com](mailto:admin@cliniquemaroc.com)  | 123456789    |

---

## 🌐 Documentation de l’API REST

L’application expose des endpoints API permettant d’interagir avec les rendez-vous au format JSON.

---

### 📌 1. Lister tous les rendez-vous

**Endpoint :**

```http
GET /api/appointments
```

**Description :**
Retourne la liste de tous les rendez-vous enregistrés dans la base de données avec le patient/doctor/service.

**Exemple de réponse :**

```json
[
  {
    "id": 1,
    "patient_id": 3,
    "doctor_id": 2,
    "service_id": 1,
    "appointment_date": "2026-05-01 10:00:00",
    "status": "confirmed"
  }
]
```

---

### 📌 2. Créer un nouveau rendez-vous

**Endpoint :**

```http
POST /api/appointments
```

**Description :**
Permet de créer un nouveau rendez-vous via une requête externe (Postman, frontend, etc.).

**Body (JSON) :**

```json
{
  "patient_id": 1,
  "doctor_id": 2,
  "service_id": 1,
  "appointment_date": "2026-05-10 14:30:00",
  "status": "pending"
}
```

**Exemple de réponse :**

```json
**Exemple de réponse :**

```json
[
  {
    "id": 1,
    "appointment_date": "2026-05-10 14:30:00",
    "status": "confirmed",

    "patient": {
      "id": 1,
      "first_name": "Paul",
      "last_name": "Arelan",
      "email": "patient@test.com"
    },

    "doctor": {
      "id": 2,
      "name": "Dr. Ahmed",
      "email": "doctor@test.com"
    },

    "service": {
      "id": 1,
      "name": "Consultation"
    },

    "created_at": "2026-04-25T10:00:00.000000Z",
    "updated_at": "2026-04-25T10:00:00.000000Z"
  }
]
```

```

---

### ⚠️ Remarques API

* Test recommandé avec **Postman** ou **Thunder Client**.

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
