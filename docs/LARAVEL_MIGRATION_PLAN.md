# Laravel migration plan (discovery-based)

## Guardrails

This is planning documentation only. No production access, DB operation, backup, package installation, source change, schema change, deployment, credential use, storage modification or external side effect is authorized here. Keep migration implementation separately reviewed and approved.

## Phase 0 — establish safe recovery

1. Have the owner identify the authorized backup/restore procedure; do not run it during documentation work.
2. In an access-controlled isolated environment, validate restoration of database and uploads to disposable targets. Document evidence without placing private data/secrets in this repository.
3. Do not proceed until restore and encryption-key custody are validated. Preserve originals.
4. Set up isolated staging with synthetic or masked data, separate credentials, mail sink, non-production Google OAuth/calendar, and external side effects disabled by default.

## Phase 1 — discovery and compatibility

- Confirm target PHP/extensions and select Laravel version only after checking its authoritative PHP support matrix; legacy README states PHP 8.2+ and does not prove Laravel compatibility.
- Obtain an authorized schema-only catalog/snapshot; inventory tables, columns, keys, constraints, routines, enums, collations, SQL modes, volumes and relationships. Reconcile the single observed incremental SQL file's applied state only in a restored disposable copy.
- Inventory endpoint methods/inputs, CRUD invariants, role/action access, OTP/password/session behavior, upload paths, all scheduled jobs, SMTP, Google Calendar, Apache rewrites and IMS contract.
- Establish isolated staging baseline with security/environment checks and representative role-specific workflows. Evaluate lockfile/runtime compatibility without changing dependencies.

## Phase 2 — design and separately approved implementation

- Map legacy flows to explicit Laravel routes, middleware, controllers/form requests/resources, Eloquent models, policies, services, storage disks, jobs/notifications and scheduled commands.
- Start with compatibility-first DB and URL behavior; do not redesign schema, auth, permissions, storage, dependencies or integrations without separate approval.
- Preserve IMS iframe and Google Calendar/email semantics until owners approve contracts and staging validation. Restrict private files and test access boundaries.
- Add workflow, authorization-denial, security, idempotency/retry and import/reconciliation tests before cutover.

## Phase 3 — rehearsal and cutover readiness

- Rehearse restore, deployment, data reconciliation, upload serving, queue/scheduler behavior and rollback in isolated staging with non-sensitive production-like volume.
- Specify objective acceptance gates, operators, monitoring, communications, maintenance window, write freeze and go/no-go authority. Preserve the legacy application and avoid dual writes unless explicitly designed and tested.
- Define write reconciliation, key availability, DNS/web server reversal and the rollback window; test the exact rollback procedure.

## Exit criteria

Restore is proven; target runtime/framework compatibility demonstrated; schema, endpoints and workflows mapped; auth/role and confidential-file tests pass; integration owners approve; staging regression and rollback rehearsals pass; and a human-approved operational plan exists. Unknowns and owner decisions are tracked rather than inferred.
