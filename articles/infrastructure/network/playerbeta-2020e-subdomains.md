# 2020E RobloxPlayerBeta Subdomains

*Description: Subdomains found in the 2020E RobloxPlayerBeta.exe (VMProtect-packed), as found via strings analysis*
*Credits: daniel176 (strings analysis)*

The following was extracted from `/Middleware/2020E/RobloxPlayerBeta.exe` (≈33.7 MB) using `strings`. Unlike the 2016 build, this binary is **VMProtect-protected** (`VMProtect Client ipn80481`), which obfuscates most embedded strings. Only a single plain-text domain reference remains visible.

## Subdomains

| Domain | Notes |
|--------|-------|
| `www.roblox.com` | Only visible plain-text roblox.com string in the binary |
| `clientsettings.api.roblox.com` | Client settings / FFlags delivery (known endpoint, not visible in strings due to VMProtect) |

## Build Info

| Attribute | Value |
|-----------|-------|
| Build System | TeamCity |
| Build Path | `C:\teamcity-agent\work\trunk_deploy_nbsninja_client-x86\build.ninja\client\vs2017\x86\release\WindowsClient\RobloxPlayerBeta.pdb` |
| Compiler Toolchain | VS2017, Ninja build |
| Protection | VMProtect (Client ipn80481) |
| Size | ≈33.7 MB |

## Notes

- The binary is VMProtect-packed, indicating Roblox began applying code virtualization/obfuscation to the PlayerBeta by 2020.
- Most domain strings (API, asset, CDN endpoints) are likely constructed at runtime or stored in protected/encrypted sections, making them invisible to a basic `strings` scan.
- The single visible `www.roblox.com` string is likely used as a fallback/reference URL (e.g. in dialog text or error messages).
- This contrasts sharply with the 2016 PlayerBeta, which had many plain-text subdomain strings. By 2020 Roblox had moved to building URLs at runtime.
