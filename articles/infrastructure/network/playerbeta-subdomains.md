# 2016 RobloxPlayerBeta Subdomains

*Description: Subdomains referenced in the 2016 RobloxPlayerBeta.exe (Trunk2012 build), as found via strings analysis*
*Credits: daniel176 (strings analysis)*

The following subdomains were extracted from `/Middleware/2016/Player/RobloxPlayerBeta.exe` (≈20 MB) using `strings`. The binary is a Trunk2012 build modified to use a custom domain; the original Roblox subdomains are listed below.

## Subdomains

| Domain | Purpose |
|--------|---------|
| `www.roblox.com` | Main website, game pages, user profiles |
| `assetgame.roblox.com` | Asset delivery, game server hosting |
| `api.roblox.com` | REST API (format string included `apiKey` parameter) |
| `clientsettings.api.roblox.com` | Client settings / FFlags delivery |
| `test.public.ecs.roblox.com` | Test Elastic Compute Service endpoint |

## Referenced Paths

| Path | Full URL |
|------|----------|
| `/item.aspx?id=%d&rbx_source=youtube&rbx_medium=uservideo` | `www.roblox.com/item.aspx?id=...` |
| `/drivers` | `www.roblox.com/drivers` |
| `/roblox.xsd` | `www.roblox.com/roblox.xsd` |
| `/robloxStartedEvent` | `www.roblox.com/robloxStartedEvent` |

## Notes

- The `apiKey` query parameter in the API format string suggests early key-based authentication for REST endpoints.
- The `test.public.ecs` subdomain indicates a staging/test environment for Roblox's custom compute platform.
- Build path in PDB-like strings: `D:\BuildAgent\work\Trunk2012\Client\App\`. This shows it is based on the 2012 trunk and was distributed as a "2016 PlayerBeta".
- The binary was fully domain-patched; no original Roblox domain strings remain unmodified.
