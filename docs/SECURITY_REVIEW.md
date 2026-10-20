# Static security review — targeted PHP surfaces

## Scope and confidence

This is a static-review record only. No code was changed, no exploit tests were run, and no database, credentials, production system, or live endpoint was accessed. Findings below are not claims about deployment or runtime behavior.

The supplied audit notes identify SQL-injection candidates as mitigated by parameterized query handling, and flag the blog-PDF and eligibility surfaces for targeted review. However, those source files and the detailed targeted-review evidence were not present in this checkout, so exact source line references and independent verification are unavailable here. The corresponding paths are recorded below as reported targets; confirm against the source revision actually under review before treating these observations as verified.

## SQL injection candidates — reported mitigated; verify source evidence

- Existing audit evidence reports that reviewed SQL-injection candidates use parameterized queries, so these are treated as mitigated candidates, not confirmed vulnerabilities. The underlying candidate list, query call sites, and evidence paths/line numbers were not included in the materials available for this document. Do not infer that all queries in the application are safe from this limited statement.
- Safe follow-up: identify each reviewed query in the matching source revision and verify user-controlled values are bound parameters (including dynamically assembled filters, sort keys, and identifiers). For dynamic SQL structure, use explicit allowlists; keep values parameterized. Add ordinary isolated tests for query behavior if needed; do not test against production data.

## Remaining concerns — unconfirmed, static-review leads

### Blog PDF: possible unpublished blog access by ID

- **Reported target:** `blog-pdf.php` (no file/line evidence available in this checkout).
- **Concern:** A PDF route that resolves a blog using a caller-supplied ID may expose unpublished content if it does not enforce publication state and any applicable authorization. This is an access-control concern, not a confirmed issue; route behavior and source could not be independently checked.
- **Impact / uncertainty:** Potential disclosure of draft or otherwise non-public blog material. Actual reachability, identifier handling, publication filtering, and authorization are unknown.
- **Safe verification/remediation:** In the reviewed source revision, trace the ID from request to lookup and PDF response. Confirm the query enforces the intended published/visible state server-side, and authorization where drafts are staff-only. Verify with isolated tests using synthetic published and unpublished records and authorized/unauthorized identities. Return a non-revealing not-found/denial response where appropriate.

### Eligibility page: page-level permission check

- **Reported target:** `admin/eligibility.php` (no file/line evidence available in this checkout).
- **Concern:** The targeted review reportedly found no page-level permission check. Whether shared bootstrap/middleware or surrounding route protections enforce equivalent authorization is unverified; therefore this is a concern to validate, not a confirmed vulnerability.
- **Impact / uncertainty:** If no equivalent control exists, a signed-in staff member lacking the required role/page permission might view eligibility information or trigger page behavior. Exposure and actions available on the page are unknown.
- **Safe verification/remediation:** Trace the complete request path, including shared includes and server configuration, and compare the page with the established permission key/action policy. Confirm authorization is enforced server-side before sensitive reads or mutations. Test least-privileged and unauthorized identities using isolated synthetic data; add the appropriate page-level gate if no equivalent control exists.

### CSRF, rate limits, and ownership checks elsewhere

- **Concern:** CSRF protection, throttling, and object/tenant ownership enforcement across other routes and handlers have not been exhaustively verified. The available audit summary describes shared CSRF/origin mechanisms and ownership helpers, but does not establish coverage for every state-changing action or resource lookup.
- **Impact / uncertainty:** Depending on endpoint behavior and deployment, gaps could permit cross-site state changes, excessive authentication/action attempts, or access to another user's/venture's records. No specific affected endpoint is confirmed by this review.
- **Safe verification/remediation:** Inventory state-changing endpoints and confirm CSRF validation on each applicable browser flow; review rate limits for login, OTP, recovery, and sensitive actions; trace resource IDs through reads and writes to ensure ownership/tenant checks are applied server-side. Exercise checks only in an isolated test environment with synthetic accounts/data. Record exclusions and expected anonymous/API behavior explicitly.

## Evidence and next safe steps

- Repository audit context: `docs/PLATFORM_AUDIT.md` (especially lines 3–5, 18–23, and 36): records a read-only static audit and cautions that file presence does not establish runtime/deployment behavior; describes shared security mechanisms and their unverified coverage/flows.
- Target files requested for this targeted review, `blog-pdf.php` and `admin/eligibility.php`, were not found in this checkout, and the detailed source-audit evidence identifying the SQL candidates was not available. No line-level citations for those reported observations can therefore be supplied.
- Next safe step: obtain the exact source revision and existing targeted-review notes, then attach precise path/line references and verify the conditional findings statically. Any behavioral validation should use an isolated environment and synthetic data only.
