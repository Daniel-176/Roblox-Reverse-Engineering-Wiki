# Security Notes for Roblox Revivals

*Credits: watrabi*

## Site and server security

- Put a reverse proxy in front of the site to avoid exposing the origin server's IP address.
- Store passwords with a password-hashing algorithm. Do not store plaintext passwords.
- Keep private signing keys out of public web directories. Exposed keys can let others forge signatures or tickets.
- Disable public display of PHP errors and warnings on the live site.
- Review code for SQL injection and cross-site scripting. Use rate limits and CSRF protection for relevant endpoints.
- Review known [historical vulnerabilities](/article.php?path=knowledge%2Fvulnerabilities) and patch affected clients or services where possible.

These are general precautions from the source notes. They are not a security review of any particular revival.

## SystemStats codes

The following code-to-reason mapping is reproduced from watrabi's notes. The list may be incomplete and has not been independently verified.

| Code | Reason |
|---|---|
| `tochigi` | Scorn Replication (11:0) |
| `baseball` | MD5 hash mismatch |
| `impala` | Impossible Error (31) or Scorn Impossible Error (31:12) |
| `robert` | WriteCopy changed (30) |
| `moded` | Stealth Edit Revival (29) |
| `booing` | Tried to modify hash function (28) |
| `bobby` | Function return check failed (27) |
| `vera` | Tried to get build tools (26) |
| `vegah` | VEH used (25) |
| `fisher` | `HumanoidState::computeEvent` changed (24) |
| `dallas` | DLL injection (23) |
| `tomy` | Sandbox or VM detected (22) |
| `usain` | Speedhack (21) |
| `carol` | Lua VM hooked (20) |
| `steven` | OSX hash changed (19) |
| `larry` | VEH hook removed (18) |
| `mal` | New Cheat Engine method (17) |
| `ebx` | `HumanoidState::computeEvent` EBX changed (16) |
| `terrance` | Early null weak pointer (15) |
| `ursula` | Lua hash changed (14) |
| `bruger` | Speculative Call Check (13) |
| `seth` | SEH chain into DLL (12) |
| `curly` | Hooked API function (11) |
| `olivia` | Debugger found (10) |
| `norman` | Lua script hash changed (9) |
| `mallory` | Executable access violation (8) |
| `lance` | Constant changed (7) |
| `jack` | Invalid bytecode (6) |
| `imogen` | Memory hash changed (5) |
| `ivan` | Illegal scripts (4) |
| `omar` | Bad signature (3) |
| `moe` | Hardware breakpoint detected (2) |
| `lafayette` | xxHash error (1) |
| `murdle` | Cheat Engine stable methods (0) |

SystemStats reports can be sent to a URL with `Players:SetSysStatsUrl`. A complete working example is not included in the notes.

## Source

[Watrabi's security notes](https://github.com/Daniel-176/Roblox-Reverse-Engineering-Wiki/commit/6bad0434f7343453e1117b3892536ad0dd1b8c3f).
