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

## Authorized local export snapshot

- The owner confirmed `C:\Users\HumbleKen\Downloads\vividfin_edtech_site.sql` belongs to the legacy EdTech site. Its header identifies MariaDB 10.6.28 and database `vividfin_edtech_site`.
- On 2026-10-23, the unchanged export (SHA-256 `539F5A58D70076AB33C0D77EA617C0FD449788964DCF0D32AFF2DEEF9E9E325F`) imported successfully into a fresh database, `edtech_backup_verify_20261023_retry1`, on the isolated MariaDB 10.6.28 instance bound to `127.0.0.1:3307`. One earlier isolated attempt in this session stopped on a packet-size error and is incomplete; it was not overwritten. No production database connection was made.
- Metadata inspection of the successful restore found 101 InnoDB base tables, 1,193 columns, 37 foreign-key constraints and 356 index-column entries. No application row contents or exact row counts were queried.
- In the export, `events.id` is `INT UNSIGNED`; `events` is InnoDB. It contains `reminder_24h`, `reminder_1h` and `reminder_sent`, but not the event-reminder fields in the SQL artifact above. The artifact's original signed `event_id INT` could not form a foreign key to the unsigned `events.id`. A local test confirmed the FK succeeds when `event_id` is `INT UNSIGNED`. The legacy SQL artifact was corrected and pushed separately (`edtech-site` commit `884d3e6`).
- The isolated MariaDB server was stopped after inspection. The successful and failed test databases remain in the private temporary instance data directory; they have not been dropped. This successful SQL-only restore does not prove a complete recoverable backup: expected row/file counts were not reconciled, and no uploads backup or encryption-key custody evidence was verified. Do not treat any partial test database as a valid restore.

## Domain candidates (not confirmed schema)

Code surfaces suggest candidate domains: users/staff/roles/permissions; ventures/teams/cohorts; milestones/evidence/visits; sessions/availability/assignments/reports/deliverables; events/registrations/reminders; surveys/responses; interviews; resources/files; referrals/messages; newsletters; investors/matches; grants/tranches/meal data; settings; Google tokens. Exact table names and relationships are unknown unless explicitly listed above.

## Required next step

Obtain expected table/row/file counts from the authorized operator and verify the uploads restore and encryption-key custody separately. Reconcile source-to-schema differences, including reminder SQL applied state, only in an authorized restored copy. Keep backup, credentials and confidential data outside this repository. Do not connect to production.
