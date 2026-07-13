<div align="center">

# 💊 Smart Pharmacy Management System

**A multi-tenant pharmacy platform built with Laravel 12 — inventory, point-of-sale, purchasing, reporting, and an AI advisor that reads your pharmacy's own data.**

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-06B6D4?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![AI](https://img.shields.io/badge/AI-Groq%20·%20Llama%203.3%2070B-6D2E46)](https://groq.com)

</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Architecture](#-architecture)
- [Multi-Tenancy](#-multi-tenancy-how-data-stays-private)
- [The AI Layer](#-the-ai-layer)
- [Database Schema](#-database-schema)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
- [Demo Accounts](#-demo-accounts)
- [Roles & Permissions](#-roles--permissions)
- [Core Workflows](#-core-workflows)
- [Route Reference](#-route-reference)
- [Testing](#-testing)
- [License](#-license)

---

## 🔎 Overview

The Smart Pharmacy Management System is a complete web application for running a pharmacy end-to-end. Staff manage medicines, stock, suppliers, and daily counter sales from a single dashboard, while owners get live business insight and reports.

It is **multi-tenant**: many pharmacies can share one installation, and each pharmacy only ever sees its own data. On top of the standard management features, the system ships with an **AI advisor** — powered by Groq's Llama 3.3 70B model — that reads the pharmacy's real numbers (sales, stock, purchases, suppliers) and returns actionable, data-grounded advice, plus a bilingual (English/Arabic) chat assistant.

The codebase favors a clean, layered design: thin controllers, a dedicated **service layer** for business logic, policy-based authorization, and safe database transactions for anything that touches stock.

---

## ✨ Key Features

| Area | What it does |
|------|--------------|
| 🔐 **Authentication & Roles** | Register, login, password reset. Three roles — `admin`, `pharmacist`, `cashier` — with an active/inactive account status gate. |
| 🏥 **Pharmacy Setup** | First-time profile setup (name, license, logo, contact) and editable settings. Powers the multi-tenant boundary. |
| 📦 **Products & Inventory** | Full medicine records: SKU, barcode, scientific name, batches, pricing, expiry, min-stock thresholds, and soft deletes. |
| 🛒 **Point of Sale** | Build a sale as a draft, add/remove items, then complete or cancel. Totals recalculate automatically. |
| 🚚 **Purchases & Suppliers** | Create purchase orders, add line items, and **receive** stock into inventory. Manage supplier records. |
| 🗂️ **Categories** | Organize products into medical categories. |
| 📉 **Stock Movements** | Every stock change (`initial`, `purchase`, `sale`, `adjustment`, `damaged`, `expired`, `return`) is logged with user, quantity, and reason — a full audit trail. |
| ⚠️ **Smart Alerts** | Low-stock, out-of-stock, expiring-soon, and expired views out of the box. |
| 📊 **Dashboard** | KPIs (products, sales today, purchases, profit, low-stock/expired counts), top sellers, average order value, and a 7-day sales-trend chart. |
| 📑 **Reports** | Sales, purchases, profit, inventory, customers, and suppliers reports. |
| 📄 **PDF Export** | Preview and download reports as PDFs (Laravel DomPDF). |
| 🤖 **AI Advisor & Chat** | Per-module AI analysis and a conversational assistant grounded in live pharmacy data. |
| 🔍 **Global Search** | Search across entities with live suggestions. |

---

## 🧰 Tech Stack

| Layer | Technology | Why |
|-------|-----------|-----|
| **Backend** | Laravel 12 · PHP 8.2 | Clean structure, strong security, rich ecosystem |
| **Frontend** | Blade templates | Server-rendered pages tightly coupled with Laravel |
| **Styling** | Tailwind CSS + Vite | Modern UI with fast asset building |
| **JS sprinkles** | Alpine.js · Axios | Lightweight interactivity |
| **Database** | MySQL (SQLite for quick local) · Eloquent ORM | Reliable storage with expressive relationships |
| **AI Engine** | Groq API · `llama-3.3-70b-versatile` | Free, extremely fast inference for advice & chat |
| **Charts** | Chart.js | Dashboard sales-trend graphs |
| **PDF** | `barryvdh/laravel-dompdf` | HTML-to-PDF report generation |
| **Auth scaffolding** | Breeze-style controllers | Ready login / register / password reset |

---

## 🏗️ Architecture

A request flows top-to-bottom through five layers. Business logic lives in the **service layer**, not the controllers.

```
┌─────────────────────────────────────────────────────────┐
│  Browser  →  Blade views styled with Tailwind CSS        │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│  Routes & Controllers  →  14 route files, grouped        │
│  controllers (Sales, Products, Purchases, AI, …)         │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│  Service Layer  →  SalesService, StockService,           │
│  PurchaseService, ReportService, DashboardService,       │
│  SearchService, AI services                              │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│  Middleware & Policies  →  'active' + 'pharmacy' guards, │
│  role policies (Sale, Product, Purchase, User, …)        │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│  Eloquent Models + MySQL  →  12 models, relationships,   │
│  soft deletes, global pharmacy scope                     │
└─────────────────────────────────────────────────────────┘
```

**Design principles**

- **Thin controllers, fat services.** Controllers validate and delegate; services (`app/Services/`) hold the real logic.
- **Policy-based authorization.** Actions like completing a sale run through Laravel policies tied to the user's role.
- **Transactional integrity.** Anything that changes stock (`completeSale`, `receive`, `adjustStock`) runs inside `DB::transaction()` — all-or-nothing.
- **Auditability.** Stock is never mutated silently; a `StockMovement` row is written for every change.

---

## 🔒 Multi-Tenancy: How Data Stays Private

Each pharmacy's data is isolated using a reusable Eloquent trait, `App\Models\Traits\BelongsToPharmacy`, applied to tenant-owned models (Product, Category, Supplier, Sale, StockMovement, …). It does two things automatically:

```php
trait BelongsToPharmacy
{
    protected static function booted()
    {
        // 1. Every query is filtered to the current user's pharmacy
        static::addGlobalScope('pharmacy', function ($query) {
            if (auth()->check()) {
                $query->where('pharmacy_id', auth()->user()->pharmacy_id);
            }
        });

        // 2. New records are automatically stamped with the pharmacy_id
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->pharmacy_id = auth()->user()->pharmacy_id;
            }
        });
    }
}
```

This makes cross-tenant data leaks structurally hard: a developer can't "forget" to filter, because the global scope is always on. The `pharmacy` middleware ensures a user has completed pharmacy setup before accessing tenant features.

---

## 🤖 The AI Layer

The AI functionality is organized with a **Registry + Strategy** design so each module plugs in its own data context and prompt.

### Module analysis (`GET /ai/analyze?module=…`)

`AIManager` looks up the requested module in a `ModuleRegistry`, builds a data **context** for it, sends a tailored **prompt** to Groq, and returns structured JSON. Supported modules:

`dashboard` · `products` · `sales` · `purchases` · `suppliers` · `inventory` · `reports` · `stock`

Each module maps to a dedicated pair of classes:

```
ModuleRegistry
 ├── ContextBuilder  (app/Services/AI/Contexts/*)   → gathers the real data
 └── Prompt          (app/Services/AI/Prompts/*)    → frames the question
                                   ↓
                        AIService → Groq API (llama-3.3-70b-versatile)
                                   ↓
                    JSON cleaned & validated → returned to the UI
```

`AIService` also hardens the model output — stripping markdown code fences and wrapping quotes — so the response is always valid, parseable JSON.

### Conversational assistant (`/ai/chat`)

The chat assistant (`AIChatManager`) runs a small pipeline per message:

1. **Persist** the user message to `ai_messages`.
2. **Detect intent** (`IntentDetector`) — recognizes English **and Arabic** keywords (e.g. products, sales, `مبيعات`, `مخزون`) to pick the relevant module(s).
3. **Resolve context** (`ContextResolver`) — pulls the matching live data.
4. **Build prompt** (`ChatPromptBuilder`) — includes the last 10 messages of history for continuity.
5. **Call Groq**, save the assistant reply, and return it.

Conversations and messages are stored in `ai_conversations` and `ai_messages` (with role, content, module, and token metadata).

> **Configuration:** the AI layer reads `config('services.groq.key')`, backed by the `GROQ_API_KEY` environment variable. Get a free key at [console.groq.com](https://console.groq.com).

---

## 🗄️ Database Schema

Twelve core tables, related as follows.

```
pharmacies ──┬─< users (role, status, pharmacy_id)
             ├─< categories ──< products >── suppliers >──< purchase_orders ──< purchase_items
             │                    │  │
             │                    │  └──< stock_movements >── users
             │                    └──< sale_items >── sales >── users
             └─ (tenant scope on all of the above)

users ──< ai_conversations ──< ai_messages
```

**Key tables**

| Table | Notable columns |
|-------|-----------------|
| `users` | `role` (admin/pharmacist/cashier), `status` (active/inactive), `pharmacy_id` |
| `pharmacies` | `owner_id`, `name`, `license_number`, `logo`, `status`, soft deletes |
| `products` | `sku` (unique), `barcode` (unique), `scientific_name`, `purchase_price`, `selling_price`, `stock_quantity`, `minimum_stock`, `expiration_date`, `batch_number`, soft deletes |
| `categories` | `name`, `status`, soft deletes |
| `suppliers` | `contact_person`, `phone`, `email`, `status`, soft deletes |
| `stock_movements` | `type` (initial/purchase/sale/adjustment/damaged/expired/return), `quantity`, `reason` |
| `purchase_orders` / `purchase_items` | `status` (pending/received), `total_cost` / `quantity`, `cost` |
| `sales` / `sale_items` | `status` (draft/completed/cancelled), `subtotal`, `discount`, `total` / `unit_price`, `quantity` |
| `ai_conversations` / `ai_messages` | `title` / `role` (user/assistant), `content`, `module`, `tokens` |

---

## 📁 Project Structure

```
Smart-Pharmacy-Management-System/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Feature-grouped controllers
│   │   │   ├── AI/              # AIController, ChatController
│   │   │   ├── Sales/  Products/  Purchases/  Suppliers/
│   │   │   ├── Categories/  StockMovement/  Inventory/
│   │   │   ├── Reports/  Dashboard/  Admin/  Search/
│   │   │   └── PharmacyController, PdfPreviewController, ProfileController
│   │   ├── Middleware/          # EnsureUserIsActive, SetPharmacyContext
│   │   └── Requests/            # Form request validation
│   ├── Models/                  # 12 Eloquent models + Traits/BelongsToPharmacy
│   ├── Policies/                # Role-based authorization (Sale, Product, …)
│   └── Services/                # Business logic
│       ├── AI/                  # AIManager, ModuleRegistry, Contexts, Prompts, Chat
│       ├── Pdf/                 # PdfPreviewService
│       └── SalesService, StockService, PurchaseService,
│           ReportService, DashboardService, SearchService, …
├── routes/                      # 14 modular route files (web, auth, ai, sales, …)
├── database/
│   ├── migrations/              # Schema
│   └── seeders/                 # Demo data (admin, users, products, sales, …)
├── resources/views/             # Blade screens (dashboard, sales, ai, reports, …)
├── config/                      # App configuration (services.php holds Groq key)
├── public/                      # Web root & compiled assets
└── tests/                       # PHPUnit tests
```

---

## 🚀 Getting Started

### Prerequisites

- **PHP 8.2+** with Composer
- **Node.js** and npm
- **MySQL** (recommended) — or use SQLite for a zero-config local run
- A **Groq API key** for AI features ([free](https://console.groq.com))

### Installation

```bash
# 1. Clone
git clone https://github.com/Razanbalata/Smart-Pharmacy-Management-System.git
cd Smart-Pharmacy-Management-System

# 2. Install dependencies
composer install
npm install

# 3. Environment
cp .env.example .env
php artisan key:generate
```

### Configure the database

**Option A — MySQL (recommended).** Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_pharmacy
DB_USERNAME=root
DB_PASSWORD=
```

**Option B — SQLite (quick local).** The shipped `.env.example` already defaults to `DB_CONNECTION=sqlite`; just create the file:

```bash
touch database/database.sqlite
```

### Add your Groq key (for AI features)

```env
GROQ_API_KEY=your_groq_api_key_here
```

### Migrate, seed, and run

```bash
# Create tables and load demo data
php artisan migrate --seed

# Start everything (server + queue + logs + Vite) in one command
composer run dev
```

Then open **http://localhost:8000**.

> `composer run dev` runs the app server, queue listener, log viewer (Pail), and the Vite dev server together. Prefer to run them separately? Use `php artisan serve` and `npm run dev` in two terminals.

---

## 👤 Demo Accounts

The seeders create ready-to-use accounts. **All demo passwords are `password`.**

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@pharmacy.com` | `password` |
| Pharmacist | `pharmacist@pharmacy.com` | `password` |
| Cashier | `cashier1@pharmacy.com` | `password` |

> ⚠️ These are seeded credentials for local development only. Never deploy them to production.

---

## 🛡️ Roles & Permissions

| Capability | Admin | Pharmacist | Cashier |
|------------|:-----:|:----------:|:-------:|
| Dashboard, inventory & reports | ✅ | ✅ | ✅ |
| Products, categories, suppliers | ✅ | ✅ | ✅ |
| Purchases (order & receive stock) | ✅ | ✅ | ✅ |
| Point-of-sale (create & complete sales) | ✅ | ✅ | ✅ |
| AI advisor & chat | ✅ | ✅ | ✅ |
| **User management** (`/users`) | ✅ | ❌ | ❌ |

Access is enforced by the `auth`, `active`, and `pharmacy` middleware plus per-model **policies**. User management is additionally gated behind an `isAdmin` check.

---

## 🔄 Core Workflows

### Completing a Sale (Point of Sale)

The POS flow showcases the system's transactional design:

1. **Create** — cashier starts a `draft` sale.
2. **Add items** — pick a product + quantity; `SalesService` checks stock and recalculates totals.
3. **Authorize** — the `SalePolicy` confirms the user may complete the sale.
4. **Complete** — inside a `DB::transaction()`, `StockService::removeStock()` reduces stock for each item and writes a `sale` **stock movement**; the sale is marked `completed`.
5. **Result** — stock stays accurate and every change is fully traceable. If any step fails, the transaction rolls back and nothing is half-saved.

### Receiving a Purchase Order

1. Create a `pending` purchase order for a supplier and add line items.
2. **Receive** the order — stock is added via `StockService` (logged as a `purchase` movement) and the order becomes `received`.

### Stock Adjustment

Manually correct stock with `StockService::adjustStock()` — the difference is recorded as an `adjustment` movement with a reason, never negative.

---

## 🗺️ Route Reference

Routes are split across 14 files in `routes/` and included from `web.php`.

| File | Prefix / Purpose |
|------|------------------|
| `auth.php` | Login, register, password reset, email verification |
| `dashboard.php` | `/dashboard`, `/dashboard/sales-trend` |
| `products.php` | `/products` resource + `/products/low-stock` |
| `categories.php` | `/categories` resource |
| `suppliers.php` | `/suppliers` resource |
| `stock.php` | `/stock/history`, `/stock/adjust` |
| `purchases.php` | `/purchases` — create, add item, receive |
| `sales.php` | `/sales` — create, add/remove items, complete, cancel |
| `inventory.php` | `/inventory` — stock, low-stock, out-of-stock, expiring, expired, movements |
| `reports.php` | `/reports` — sales, purchases, profit, inventory, customers, suppliers |
| `users.php` | `/users` resource (admin only) |
| `ai.php` | `/ai/analyze`, `/ai/chat`, `/ai/chat/message` |
| `pdf.php` | `/pdf/preview/{type}`, `/pdf/download/{type}` |
| `web.php` | Home, profile, pharmacy setup/settings, global search |

---

## 🧪 Testing

```bash
composer test
# or
php artisan test
```

Tests run on PHPUnit (see `phpunit.xml`).

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

<div align="center">

Built with ❤️ using Laravel · Report issues on the [issue tracker](https://github.com/Razanbalata/Smart-Pharmacy-Management-System/issues)

</div>
