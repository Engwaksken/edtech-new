# Feature mapping (evidence-based)

## Scope and evidence rules

This mapping consolidates the checked-in discovery notes for the legacy application. Local implementation references are source-code surfaces reported in `PLATFORM_AUDIT.md` and `AUTHENTICATION_MIGRATION.md`; they establish that code paths exist, not that they work in production or are deployed. The reviewed notes do not record reproducible live-public-site observations for the features below. Accordingly, live behavior is marked **not verified** rather than inferred from source. No authenticated area, form submission, or database was accessed for this mapping.

The existing `DATABASE_MAPPING.md` remains the source of truth for partial database evidence. Domain names below are feature labels, not asserted table names or schema.

## Public-facing features

| Feature | Local implementation evidence | Live public-site observation | Limits / unknowns |
|---|---|---|---|
| Public content and information | Legacy source has home, cohort, FAQ, event, blog, newsletter, mentor, investor, team, and application surfaces (`PLATFORM_AUDIT.md`). | Public GET observations on 2026-10-23: homepage has About, programme stages, eligibility, benefits, cohort highlights and contact; `/cohorts` shows Cohort 1 (2026), 12 ventures, search/category/level filters; `/faqs` lists fellowship/application questions; `/blogs` shows dated venture stories; `/newsletter` shows subscription prompts and dated archive editions. | Point-in-time public rendering only. Forms were not submitted; events, login, private areas and CMS behavior were not tested. Some rendered links point to legacy `.php` paths while primary navigation uses extensionless paths. |
| Application entry point | `apply.php` embeds `https://ims.hivecolab.com/opportunity-embed.php?id=1` in an iframe; source sets width 100%, height 900px, no border, lazy loading (`IMS_INTEGRATION.md`). | `/apply` route responded on 2026-10-23, but the text fetch exposed no application form or embed content. | A route response does not establish that the iframe loaded or that applications submit successfully. IMS iframe content and internal workflows are not evidenced. API, credentials, webhooks, data exchange, shared DB, authorization, messaging protocol, owner, and current availability are unknown. |
| Contact/newsletter/email-related paths | Source references contact, newsletters/bulk email, notifications, OTP/recovery email, and event reminders (`PLATFORM_AUDIT.md`). | Homepage displays contact email/phone/location and a contact form; `/newsletter` displays subscription calls to action and archived editions. No form was submitted. | Delivery, consent, sender configuration, list behavior, and successful submission are unknown. |

## Venture / authenticated features

| Feature | Local implementation evidence | Live observation | Limits / unknowns |
|---|---|---|---|
| Venture account access | Separate venture login, OTP verification/resend, password recovery/change, and logout paths; source uses password verification and session-based venture authorization (`AUTHENTICATION_MIGRATION.md`, `PLATFORM_AUDIT.md`). | Not verified; authenticated areas were not accessed. | Full OTP expiry/attempt/invalidation behavior, deployed settings, and user-visible flows are not established. |
| Venture workspace | Source surfaces include dashboard, profile, venture, documents/resources, surveys, referrals, messages, meal data, sessions/calendar, assignments, deliverables, tranches, and event registration (`PLATFORM_AUDIT.md`). | Not verified; private portal workflows were not accessed. | Exact actions, validations, lifecycle, authorization, data relationships, and whether these features are active are unknown. |

## Staff / administrative features

| Feature | Local implementation evidence | Live observation | Limits / unknowns |
|---|---|---|---|
| Admin authentication and access control | Separate admin authentication; source reloads admin user and checks active state, role/page permissions; role/permission and mentor/session ownership helpers are noted (`PLATFORM_AUDIT.md`, `AUTHENTICATION_MIGRATION.md`). | Not verified; no authenticated admin area was accessed. | Exhaustive role-to-action matrix, deployed configuration, and exact authorization outcomes are unknown. |
| Program and content administration | Source surfaces include users/staff/roles/permissions; ventures/startups/cohorts/program stages; milestones/evidence/field visits; mentors/sessions; resources; surveys/interviews; referrals; investors/matches; grants; events/attendees; newsletters/bulk mail; FAQs/blogs/partners/benefits; settings; reports/exports (`PLATFORM_AUDIT.md`). | Not verified; admin workflows were not accessed. | This is a code-area inventory, not a complete CRUD/action contract. Verbs, invariants, permissions, operational usage, and deployment status remain unknown. |

## Cross-cutting capabilities and integrations

| Capability | Local implementation evidence | Live observation | Limits / unknowns |
|---|---|---|---|
| File upload and private-file handling | Source has an image helper with JPEG/PNG/GIF/WebP, 5 MiB limit, MIME check and randomized names under `uploads/`; other document/evidence/template upload paths and private-file helpers are reported (`PLATFORM_AUDIT.md`). | `/resources` publicly lists 16 items and marks access as login-gated, linking requests through `login.php` to `venture_resources`; no file was downloaded. | Complete upload inventory, storage permissions, confidentiality/access behavior, and deployed serving configuration are unknown. |
| Email and event reminders | PHPMailer helper and email-related paths are reported. One incremental SQL artifact for event reminder fields/logs exists (`PLATFORM_AUDIT.md`, `DATABASE_MAPPING.md`). | Not verified. | SQL intent does not prove deployment or runtime; SMTP state, delivery, schedule, and reminder behavior are unknown. Refer to `DATABASE_MAPPING.md` for exact bounded SQL evidence. |
| Google Calendar | OAuth/connect/callback/disconnect and calendar service paths handle events and mentor tokens; OAuth state protections are described in `AUTHENTICATION_MIGRATION.md`. | Not verified. | Google project/scopes/consent, deployed tokens, and operational behavior are unknown. |

## Explicit gaps and next evidence

- Extend the dated public observations to the remaining unauthenticated routes and compare each live URL/redirect with source rewrites; do not infer behavior from source.
- Ask the IMS owner for the embed contract and a safe test environment. Do not inspect or assume iframe internals, submit applications, or represent the embed as an integrated workflow without evidence.
- Map private venture and admin workflows only through owner-authorized staging accounts and synthetic data; document actions, permissions, and denial behavior without using production credentials.
- Resolve schemas only from actual authorized SQL/schema/catalog evidence. `DATABASE_MAPPING.md` intentionally leaves unverified schema details unknown; this feature map does not add inferred tables or columns.
