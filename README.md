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

 Email                                                        | Mot de passe |
 ------------------------------------------------------------ | ------------ |
 [admin@cliniquemaroc.com](mailto:admin@cliniquemaroc.com)    | 12121212     |
 [patient@cliniquemaroc.com](mailto:admin@cliniquemaroc.com)  | 12121212     |
 [rrahimabde033@gmail.com](mailto:admin@cliniquemaroc.com)    | abdeabde     |

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
        "id": 3,
        "patient_id": 13,
        "doctor_id": 1,
        "service_id": 4,
        "appointment_date": "2026-05-22 09:35:00",
        "status": "cancelled",
        "created_at": "2026-04-27T16:20:53.000000Z",
        "updated_at": "2026-04-27T20:55:23.000000Z",
        "patient": {
            "id": 13,
            "first_name": "Manuel",
            "last_name": "Shields",
            "email": "vpowlowski@example.com",
            "role": "patient",
            "email_verified_at": "2026-04-27T16:20:51.000000Z",
            "is_active": 1,
            "created_at": "2026-04-27T16:20:51.000000Z",
            "updated_at": "2026-04-27T19:59:59.000000Z"
        },
        "doctor": {
            "id": 1,
            "first_name": "Myrtisa",
            "last_name": "Konopelskis",
            "email": "elyse.denesik@example.com",
            "role": "doctor",
            "email_verified_at": "2026-04-27T16:20:49.000000Z",
            "is_active": 1,
            "created_at": "2026-04-27T16:20:50.000000Z",
            "updated_at": "2026-04-27T19:48:02.000000Z"
        },
        "service": {
            "id": 4,
            "name": "MRI Scan",
            "price": "4684.19",
            "description": "Quisquam molestiae nesciunt est aut. Fuga exercitationem repellendus facere sed autem voluptas nisi molestias. Laborum dolorem unde est quaerat. Tempore qui mollitia tempore.",
            "category": "imaging",
            "created_at": "2026-04-27T16:20:53.000000Z",
            "updated_at": "2026-04-27T16:20:53.000000Z"
        }
    },
    {
        "id": 4,
        "patient_id": 14,
        "doctor_id": 2,
        "service_id": 6,
        "appointment_date": "2026-05-12 06:59:15",
        "status": "confirmed",
        "created_at": "2026-04-27T16:20:53.000000Z",
        "updated_at": "2026-04-27T16:20:53.000000Z",
        "patient": {
            "id": 14,
            "first_name": "Janiya",
            "last_name": "Renner",
            "email": "qbins@example.net",
            "role": "patient",
            "email_verified_at": "2026-04-27T16:20:51.000000Z",
            "is_active": 1,
            "created_at": "2026-04-27T16:20:51.000000Z",
            "updated_at": "2026-04-27T16:20:51.000000Z"
        },
        "doctor": {
            "id": 2,
            "first_name": "Margaretta",
            "last_name": "Lakin",
            "email": "ahmad.gulgowski@example.com",
            "role": "doctor",
            "email_verified_at": "2026-04-27T16:20:50.000000Z",
            "is_active": 1,
            "created_at": "2026-04-27T16:20:50.000000Z",
            "updated_at": "2026-04-27T16:20:50.000000Z"
        },
        "service": {
            "id": 6,
            "name": "General Consultation",
            "price": "3053.29",
            "description": "Consectetur vel inventore autem nesciunt maiores repellendus. Natus quia molestiae nesciunt iste sit deserunt. Nostrum veritatis laboriosam in exercitationem. Laborum veniam nam reiciendis.",
            "category": "imaging",
            "created_at": "2026-04-27T16:20:53.000000Z",
            "updated_at": "2026-04-27T16:20:53.000000Z"
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
    "patient_id": 27,
    "doctor_id": 36,
    "service_id": 9,
    "appointment_date": "2026-10-10 16:30:00",
    "status": "cancelled"
    }
```

**Exemple de réponse :**

```json
**Exemple de réponse :**

```json
    {
    "patient_id": 27,
    "doctor_id": 36,
    "service_id": 9,
    "appointment_date": "2026-10-10 16:30:00",
    "status": "cancelled"
    }
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
