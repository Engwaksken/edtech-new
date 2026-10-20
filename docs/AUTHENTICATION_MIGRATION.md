# Authentication and authorization migration notes

## Evidence reviewed

Legacy paths reviewed include `includes/security.php`, `includes/auth.php`, venture login/OTP/password handlers, `admin/includes/auth.php`, and admin role/permission surfaces. Findings describe source code only; runtime and production policy are unverified.

## Existing behavior evidenced

- Separate venture and admin login flows, OTP verification/resend, password recovery/reset/change, and logout handlers exist.
- Venture login verifies a stored password with `password_verify`, generates a random six-digit OTP, hashes it using `password_hash`, and keeps pending login details in session. OTP resend code enforces a wait interval. OTP expiry, attempt cap and complete invalidation semantics need end-to-end review.
- Password changes/reset use PHP `password_hash`/`password_verify` in reviewed handlers. Hash algorithm/cost values, reset enumeration/rate limits and token lifecycle are not asserted here.
- `includes/security.php` sets strict mode, cookie-only sessions, session cookies HttpOnly and SameSite=Lax, and Secure based on HTTPS/server port. CSRF token is 32 random bytes hex and checked using `hash_equals`; origin/fetch-site checks reject cross-site unsafe requests while permitting missing Origin/Referer for compatibility.
- Venture access derives ID/role from session and loads venture/cohort; missing/inactive venture sessions are redirected or destroyed. Admin auth requires `admin_id`, reloads `admin_users`, checks active state, normalizes role and resolves page permission via `roles`/`role_permissions`; super roles bypass the page check. Mentor helpers scope session access through `session_mentors`/organizer role.
- Calendar OAuth state is one-use, random, expires after 600 seconds and binds admin and mentor IDs.

## Migration requirements (not implementation)

1. Document separate principal types and all authenticated routes/actions before designing guards. Build an explicit role-to-action matrix from observed behavior and owner confirmation; do not infer privilege from page names.
2. Verify legacy password hashes using compatibility verification; only rehash after successful authentication and approved cutover strategy. Do not bulk-reset or weaken passwords.
3. Preserve OTP delivery, expiry, resend throttling, attempt limits, one-time consumption, generic responses and session binding only after behavior is established. Review limits and enumeration exposure separately with owner/security approval.
4. Define session fixation prevention, ID rotation, timeout, invalidation on password/status change, cookie/proxy TLS behavior and cross-subdomain behavior. Source evidence does not establish every detail.
5. Reproduce CSRF protections for state-changing requests and narrowly define trusted origins. Test denial behavior, including direct handler access and object ownership, not only UI hiding.
6. Use explicit Laravel policies/gates for venture ownership, admin page/action rights, mentor/session ownership and sensitive downloads. Verify every mutation and export.
7. Test login success/failure, OTP expiry/replay/resend/attempt limits, reset lifecycle, inactive users, logout/session invalidation, privilege boundaries, CSRF and cross-tenant object access with synthetic accounts.

## Unknowns / blockers

No exhaustive session lifecycle, OTP expiry/attempt rules, password policy, login throttle, recovery enumeration behavior, admin OTP details, or full role matrix was confirmed. Resolve from complete source flow review plus owner-approved staging tests; do not use production accounts or secrets.
