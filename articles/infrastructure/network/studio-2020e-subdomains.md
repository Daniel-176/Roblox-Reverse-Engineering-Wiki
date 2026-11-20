# 2020E RobloxStudioBeta Subdomains

*Description: Subdomains found in the 2020E RobloxStudioBeta.exe via strings analysis*
*Credits: daniel176 (strings analysis)*

The following subdomains were extracted from `/Middleware/2020E/RobloxStudioBeta.exe` (≈51.5 MB) using `strings`. Unlike the PlayerBeta from the same year, the Studio binary is **not VMProtect-packed** and contains many plain-text URL strings.

## Subdomains

| Domain | Purpose |
|--------|---------|
| `www.roblox.com` | Main website |
| `assetgame.roblox.com` | Legacy asset/game server |
| `assetdelivery.roblox.com` | Asset delivery API v1 |
| `developer.roblox.com` | Developer Hub / API reference |
| `devforum.roblox.com` | Developer Forum |
| `en.help.roblox.com` | Help center / support articles |
| `chat.roblox.com` | Chat service |
| `clientsettings.api.roblox.com` | Client settings / FFlags delivery |
| `presence.roblox.com` | Presence service |
| `test.public.ecs.roblox.com` | Test Elastic Compute Service |
| `upload.crashes.rbxinfra.com` | Crash report upload (minidump) |

### CDN Endpoints

| Domain | Notes |
|--------|-------|
| `c0ak.rbxcdn.com` | CDN edge (test-50kb.png) |
| `c0cfly.rbxcdn.com` | CDN edge |
| `c0hw.rbxcdn.com` | CDN edge |
| `c0ll.rbxcdn.com` | CDN edge |

### Tencent QQ Domains

| Domain | Purpose |
|--------|---------|
| `roblox.qq.com` | Tencent QQ partner domain |
| `www.roblox.qq.com` | QQ website |
| `assetdelivery.roblox.qq.com` | QQ asset delivery |
| `assetgame.roblox.qq.com` | QQ asset/game server |
| `rbxcdn.qq.com` | QQ CDN |

### Runtime-Constructed (partial strings)

| Pattern | Likely Full Domain |
|---------|-------------------|
| `https://auth` | `auth.roblox.com` |
| `https://data.%1/Data/Upload.ashx?assetid=%2` | `data.roblox.com` |

## Build Info

| Attribute | Value |
|-----------|-------|
| Build System | TeamCity |
| Build Path | `C:\teamcity-agent\work\trunk_ninja_studio-x64\...` |
| Compiler Toolchain | VS2017, Ninja build, x64 |
| Protection | None (unlike PlayerBeta 2020E which is VMProtect-packed) |
| Size | ≈51.5 MB |
