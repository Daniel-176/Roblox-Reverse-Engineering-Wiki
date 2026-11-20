# RCCService: Not Expiring Jobs

*Credits: Reddit user (original), meditation/meditext (documentation)*

## Infinite Job Lifetime

Patch RCC like the client. Then in HxD:

Search: `00 00 00 00 00 c0 82 40`
Replace: `00 00 f8 1f 5f a0 02 42`

This prevents the RCC from shutting down randomly.

> Do not use this in production. It causes memory leakage.

## Closing JobItem Patch

1. String search "Closing JobItem"
2. Double-click "Closing JobItem %s"
3. Apply JMP patches (see image references in original guide)

## RCC Timeout

Same hex change: `00 00 00 00 00 c0 82 40` to `00 00 f8 1f 5f a0 02 42`
