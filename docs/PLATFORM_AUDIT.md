# Legacy platform audit

## Scope and confidence

Read-only static review of the checked-out `D:\projects\edtech-site` repository. No live site, database, production configuration, or external service was accessed. File presence establishes a code surface only—not deployment, usage, or successful runtime behavior. Destination repository docs were empty at review time.

## Runtime and architecture

- Legacy is procedural PHP page/handler scripts, not Laravel. Root files serve public and venture portal pages; `admin/` provides staff pages and handlers; `includes/` provides shared bootstrap, security, auth, storage, mail and integrations.
- README lists PHP 8.2+, MySQL/MariaDB, Apache 2.4 rewrite/headers or equivalent, HTTPS, Composer, and OpenSSL/GD/MySQLi/DOM/mbstring/ZIP. `composer.json` requires PHPMailer `^7.0`, Dompdf `^3.1.6`, PhpSpreadsheet `^5.9`, PhpWord `^1.4`, PhpPresentation `^0.9.0`, dotenv `^5.6`, and ext-openssl. Actual deployed runtime and dependencies are unknown.
- MySQLi configured from environment variables in `includes/config.php`, utf8mb4, Africa/Kampala timezone; non-local DB requires CA TLS. Web DB initialization failure returns 503. No live connection was attempted.
- README says full schema/data and customer uploads are excluded from repository. One incremental SQL file is present: `admin/database/2026_08_04_event_reminders.sql`; no full schema dump observed.

## PHP surfaces / CRUD domains

Public/content files include home, cohorts, FAQs, events, blogs, newsletters, mentors, investors, team and application. Venture surfaces include dashboard, profile, venture, documents/resources, surveys, referrals, messages, meal data, sessions/calendar, assignments, deliverables, tranches and event registration. Admin pages/handlers include users/staff/roles and permissions; ventures/startups/cohorts/program stages; milestones/evidence/field visits; mentors/sessions; resources; surveys/interviews; referrals; investors/matches; grants; events/attendees; newsletters/bulk mail; FAQs/blogs/partners/benefits; settings and reports/exports. These represent code areas, not a complete CRUD/action inventory. Exact HTTP verbs, input contracts, invariants, authorization for every action, and production usage remain unknown.

## Authentication, roles, sessions

- Separate venture and admin login/OTP flows and password reset/change/logout paths are present. Venture login uses `password_verify`, creates a random six-digit OTP and stores its password hash in session; OTP resend logic is present. Password updates use PHP `password_hash`/`password_verify`.
- `includes/security.php` configures strict cookie-only sessions, session cookie HttpOnly, SameSite=Lax, secure based on HTTPS/port; CSRF token checks and request-origin checks are implemented. OAuth state is random, one-use, bound to admin/mentor and expires in 600 seconds.
- Venture authorization uses session venture ID and role; `includes/auth.php` loads `ventures`/`cohorts` and rejects missing/inactive venture accounts. Admin auth reloads `admin_users`, checks active status, role permissions/page keys and mentor/session ownership helpers. No exhaustive role/action matrix was established.
- OTP expiry, attempt limits, account enumeration behavior, login throttling, password hash parameters, session ID rotation and invalidation behavior require full flow review/tests; behavior in deployed configuration is unknown.

## Database and storage

- Explicit table/column references in reviewed artifacts include `site_settings(setting_key,setting_value)`, `ventures` (id/status/cohort_id and `v.*`), `cohorts(id,name,start_date,end_date)`, `mentor_google_tokens`, and event reminder SQL. This is not a complete schema.
- `includes/config.php` image helper accepts JPEG/PNG/GIF/WebP up to 5 MiB, checks MIME, randomizes names and writes under `uploads/`. Other workflows upload documents/evidence/templates; README states `uploads/.htaccess` protects confidential uploads and private-file routes/helpers exist. Upload inventory, deployed access behavior, data volumes and permissions are unknown.
- Source encryption helpers cover SMTP credentials, Google tokens, and backup files according to README; they do not establish encryption for all DB/upload data. Hosting-level storage encryption is separate.

## Email, logs, cron, tests

- PHPMailer helper supports transactional and bulk sending; email settings are loaded from application settings. OTP, password recovery, notifications, contact, newsletters/bulk email and event reminders reference email paths. SMTP values, delivery success, consent rules and live sender state are unknown.
- `error_log` calls exist in DB, mail, integration and workflow helpers; error pages and local `error_log` files are present in source tree. Log contents, retention and production access were not inspected.
- Scheduled/CLI surfaces include root `send_session_reminders.php`, `admin/cron/process-event-reminders.php`, and `bin/secure-storage.php`. No scheduler configuration or cadence is established.
- Tests/tools present: `tests/security-check.php`, `environment-check.php`, `audit-check.php`, `staging-check.php`, `staging-router.php`, `browser-check.js`, Apache staging/audit configs. README says staging checks expect isolated MariaDB at 127.0.0.1:13317 and synthetic data. They were not run; no database was connected.

## Integrations and unknowns

- `apply.php` embeds `https://ims.hivecolab.com/opportunity-embed.php?id=1`. Reviewed evidence establishes only this iframe; server-to-server sync, API credentials, webhooks, shared database, owner/contract and live availability are unknown.
- Google Calendar OAuth/connect/callback/disconnect and service code handle calendar events and mentor tokens. Google project/scopes/consent, deployed token state and operation are unknown. External fonts/CDN assets are referenced; availability is not asserted.
- Needed before implementation: owner-authorized schema/catalog plus masked isolated data, role/action and workflow inventory, cron schedule, upload inventory/access tests, target PHP/framework support validation, integration owner contracts, and staging baseline. No credentials or production access were used.
