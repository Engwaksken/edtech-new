# IMS integration evidence and migration boundary

## Verified behavior

`apply.php` embeds the following URL in an iframe:

`https://ims.hivecolab.com/opportunity-embed.php?id=1`

The page sets iframe width to 100%, height to 900 pixels, border to zero, and lazy loading. This establishes an embedded application opportunity form only.

## Not evidenced / unknown

Repository review did not establish server-to-server API calls, API credentials, webhooks, shared database, synchronization direction, data mapping, ownership, availability, embed authorization, message protocol, or current production operation. The IMS contract/owner and origin/content-security requirements are unknown. Do not infer them from the iframe URL.

## Migration guardrail and discovery

Keep the embed URL and behavior unchanged unless an IMS owner separately approves a change. Before any redesign, confirm service owner, integration contract/version, allowed origins and framing headers, data ownership/retention, error/support path, and isolated test opportunity. Validate in a non-production environment without submitting real applications or invoking production side effects. Record owner approval and a test plan before changing this boundary.
