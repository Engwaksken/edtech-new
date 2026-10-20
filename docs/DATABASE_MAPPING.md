# Database mapping (repository evidence only)

## Scope

Static review of the legacy repository only. No database was contacted. README states complete schema/data are not in the repository; therefore this is a partial reference inventory, not a migration schema specification.

## Connection evidence

`includes/config.php` uses MySQLi with `DB_HOST` (default localhost), `DB_PORT` (3306), `DB_USER`, `DB_PASS`, `DB_NAME`, optional `DB_SSL_CA`; remote hosts require CA TLS verification. Charset is utf8mb4 and timezone is Africa/Kampala. No server version, engine, collation, data volume or deployed configuration was verified.

## Verified references

| Table | Evidence | What remains unknown |
|---|---|---|
| `site_settings` | `includes/config.php:get_setting()` selects `setting_value` by `setting_key` | Types, keys, indexes, all other columns and current existence |
| `ventures` | `includes/auth.php` selects `v.*`, filters `id`, reads `status` and joins by `cohort_id` | Full columns, constraints, lifecycle and schema |
| `cohorts` | `includes/auth.php` joins on `id`; reads `name`, `start_date`, `end_date` | Full schema and whether FK exists |
| `events` | `admin/database/2026_08_04_event_reminders.sql` alters it and references `id` | Existing schema and migration applied state |
| `event_reminder_logs` | Same SQL creates table | Whether table exists in any deployed DB |
| `mentor_google_tokens` | Google Calendar service reads/writes token, expiry, scope, calendar and email fields; secure-storage references access/refresh token | Full schema, FK/encryption state and deployed records |

## SQL artifact observed

Only `admin/database/2026_08_04_event_reminders.sql` was found. It adds `reminder_enabled`, `reminder_value`, `reminder_unit`, `reminder_time`, `reminder_method`, `reminder_at`, `reminder_status`, `reminder_sent_at`, `reminder_last_error`, `reminder_attempts` to `events`; creates `event_reminder_logs` with `id`, `event_id`, nullable `registration_id`, recipient, delivery method, status, error, attempted timestamp; indexes `(event_id, attempted_at)` and `recipient`; FK to `events(id)` with `ON DELETE CASCADE`. SQL is migration intent only, not proof it was applied. Do not apply/reverse it as part of this audit.

## Domain candidates (not confirmed schema)

Code surfaces suggest candidate domains: users/staff/roles/permissions; ventures/teams/cohorts; milestones/evidence/visits; sessions/availability/assignments/reports/deliverables; events/registrations/reminders; surveys/responses; interviews; resources/files; referrals/messages; newsletters; investors/matches; grants/tranches/meal data; settings; Google tokens. Exact table names and relationships are unknown unless explicitly listed above.

## Required next step

Request an owner-authorized schema-only export/catalog and masked representative relationships. In a disposable restored copy, document version, engines/collations, tables/views/triggers/routines, columns/defaults/nullability, keys/indexes/FKs/enums and row counts; verify reminder migration state. Keep backup, credentials and confidential data outside this repository. Do not connect to production.
