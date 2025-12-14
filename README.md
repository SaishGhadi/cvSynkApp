<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>




## 📌 Project Overview

**CV SYNK** is a role-based job portal web application built using **Laravel** that allows:

* **Companies** to post jobs and manage applications
* **Candidates** to apply for jobs and track application status

The project follows clean architecture principles with proper separation of:

* Web controllers (Blade views)
* API controllers (JSON responses)
* Role-based access control
* Ownership validation

---

## 🛠 Tech Stack

* **Backend:** Laravel 12
* **Frontend:** Blade + Tailwind CSS
* **Database:** MySQL
* **Authentication:** Laravel Auth (Session) + Sanctum (API)
* **ORM:** Eloquent
* **Architecture:** MVC + REST APIs

---

## 👥 User Roles

### 1️⃣ Company

* Create, edit, delete jobs
* View applications per job
* Select or reject candidates

### 2️⃣ Candidate

* View available jobs
* Apply for jobs
* Revoke applications
* Track application status

---

## 🧩 Module-wise Features

---

### ✅ Module 1 — Authentication & Roles

* Company & Candidate registration
* Login / Logout
* Role-based dashboards
* Middleware protection (`company`, `candidate`)

---

### ✅ Module 2 — Job Management (Company)

* Create new jobs
* View job list (optimized: id + title)
* Edit job details
* Delete job
* Ownership enforced (company can manage only its own jobs)

---

### ✅ Module 3 — Job Applications (Candidate)

* View active jobs
* Apply to a job
* Prevent duplicate applications
* Revoke application
* View applied jobs list

---

### ✅ Module 4 — Application Review (Company)

* View all active jobs with application count
* View applications per job
* Candidate cards showing:

  * Name
  * Skills
  * Application status
* Select or reject candidates

---

### ✅ Module 5 — Security & Access Control

* Role-based route protection using middleware
* Ownership validation at query level
* Secure UUID-based resource access
* Database enum enforced for application status:

  ```
  applied | selected | rejected
  ```

---

### 🟡 Module 6 — Enhancements & Documentation

* UI status badges
* Clean error handling
* Flash messages
* Project documentation (this README)

---

## 🗂 Database Design (Core Tables)

### `users`

* id
* uuid
* name
* email
* role (company / candidate)
* skills (JSON, candidate only)
* address (company only)

### `jobs`

* id
* uuid
* title
* description
* company_uuid
* salary_from
* salary_to
* status

### `applications`

* id
* uuid
* job_uuid
* candidate_uuid
* status (`applied`, `selected`, `rejected`)

---

## 🔐 Middleware & Security

### Role Middleware

* `CompanyMiddleware` → company-only routes
* `CandidateMiddleware` → candidate-only routes

### Ownership Enforcement

* Companies can edit/delete **only their own jobs**
* Candidates can manage **only their own applications**

---

## 🔄 Web vs API Architecture

| Layer           | Purpose                | Auth Type |
| --------------- | ---------------------- | --------- |
| Web Controllers | Blade views, redirects | Session   |
| API Controllers | JSON responses         | Sanctum   |

This separation ensures:

* Clean architecture
* Scalability
* API reusability

---

## 🚀 Setup Instructions

### 1️⃣ Clone Repository

```bash
git clone <repository-url>
cd cv-synk
```

### 2️⃣ Install Dependencies

```bash
composer install
npm install
```

### 3️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with database credentials.

### 4️⃣ Migrate Database

```bash
php artisan migrate
```

### 5️⃣ Run Server

```bash
php artisan serve
```

---

## 🧠 Key Design Decisions

* Used UUIDs instead of IDs for public access
* Used ENUMs to strictly control application states
* Enforced security at **both middleware and database query level**
* Avoided frontend frameworks for simplicity and assignment scope

---

## 📌 Future Enhancements (Optional)

* Email notifications on selection/rejection
* Prevent selecting multiple candidates per job
* Candidate profile view
* Search & filters

---

##  Author

**Saish Ghadi**
Goa Engineering College
Bachelor’s in Information Technology
