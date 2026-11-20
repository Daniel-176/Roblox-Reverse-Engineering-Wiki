# Roblox Web API Subdomains Reference

*Description: Reference of documented Roblox web API subdomains and their v1/v2 endpoints (circa 2020)*
*Credits: juliaoverflow/roblox-web-apis, matthewdean/roblox-web-apis, daniel176 (compilation)*

Base URL pattern: `https://{subdomain}.roblox.com/docs` (Swagger UI)

## API Subdomains

| Subdomain | Versions | Description |
|-----------|----------|-------------|
| `abtesting` | v1 | A/B testing framework *(DEPRECATED)* |
| `accountinformation` | v1 | Account info access/modification |
| `accountsettings` | v1 | Account/user settings |
| `adconfiguration` | v1, v2 | Ad configuration |
| `ads` | v1 | Ads configuration |
| `assetdelivery` | v1, v2 | Serves asset content |
| `auth` | v1, v2, v3 | Authentication session management |
| `avatar` | v1, v2 | Avatar customization |
| `badges` | v1, v2 | Badge and badge award management |
| `billing` | v1 | Real-money transactions |
| `catalog` | v1, v2 | Catalog browsing and search |
| `cdnproviders` | v1 | CDN provider information |
| `chat` | v1.0, v2 | Chat and party endpoints |
| `chatmoderation` | v1 | Chat moderation |
| `clientsettings` | v1, v2 | Client configuration retrieval |
| `clientsettingscdn` | v1, v2 | Client configuration via CDN |
| `contacts` | v1 | Contacts and userTag management |
| `contentstore` | v1 | Temporary file store before S3 upload |
| `develop` | v1, v2 | Game development configuration |
| `economy` | v1, v2 | Transactions and currency |
| `economycreatorstats` | v1 | Creator economy stats |
| `engagementpayouts` | v1 | Engagement-based payout info |
| `followings` | v1, v2 | Follow relationships |
| `friends` | v1 | Friends and followers management |
| `gameinternationalization` | v1, v2 | Game i18n / localization |
| `gamejoin` | v1 | Game launch endpoints |
| `gamepersistence` | v0, v1, v2 | In-game datastore system |
| `games` | v1, v2 | Game discovery and details |
| `groups` | v0, v1, v2 | Group management |
| `groupsmoderation` | v1 | Group moderation |
| `inventory` | v1, v2 | Inventory viewing |
| `itemconfiguration` | v1 | Bundle/avatar asset configuration |
| `locale` | v1 | User locale management |
| `localizationtables` | v1 | Localization table management |
| `metrics` | v1 | Metrics recording |
| `notifications` | v2 | Notification streams |
| `points` | v1 | PointsService web API |
| `premiumfeatures` | v1 | Premium features / account add-ons |
| `presence` | v1 | Presence management |
| `privatemessages` | v1 | Private messages |
| `publish` | v1 | File uploads |
| `share` | v1 | Sharing endpoints |
| `textfilter` | v2 | High-volume text filtering |
| `thumbnails` | v1 | Thumbnail requests |
| `thumbnailsresizer` | v1 | Thumbnail resize/validation |
| `trades` | v1 | Collectible item trading |
| `translationroles` | v1 | Game translation role management |
| `translations` | v1 | Translation requests |
| `twostepverification` | v1 | Two-step verification |
| `usermoderation` | v1 | User moderation actions |
| `users` | v1 | User information |
| `voice` | v1, v2, v3 | Voice call APIs |

## Legacy Subdomains (Deprecated)

These subdomains hosted older endpoints predating the Swagger-documented API sites:

| Subdomain | Notes |
|-----------|-------|
| `www.roblox.com` | Legacy endpoints (`/places/api-get-details`, `/my/account/json`, etc.) |
| `assetgame.roblox.com` | Legacy asset/game serving (`/asset/?id=`) |
| `api.roblox.com` | Original REST API (see [api-docs](/article.php?path=infrastructure%2Fapi%2Fapi-docs) for legacy endpoints) |

## oAuth2 / Open Cloud APIs

Base URL: `https://apis.roblox.com`

| Endpoint | Description |
|----------|-------------|
| `/application-authorization/.well-known/openid-configuration` | OpenID discovery |
| `/application-authorization/v1/authorize` | oAuth2 authorization |
| `/application-authorization/v1/clients/{clientId}` | Client info |
| `/oauth/v1/authorize` | OAuth 2.0 authorization |
| `/oauth/v1/token` | OAuth 2.0 token endpoint |
| `/universes/v1/places/{placeId}/universe` | Place to universe mapping |
| `/content-aliases-api/v1/universes/get-aliases` | Content alias resolution |
| `/toolbox-service/v1/Models` | In-game toolbox models |
| `/games-autocomplete/v1/get-suggestion/{query}` | Game autocomplete |

### Known oAuth2 Client IDs

| Client ID | Application |
|-----------|-------------|
| `e3a58e71-5993-4070-a0e1-9c757f6b8748` | Creator Dashboard |
| `b03b1542-931c-4f68-a5c3-3311eeba9ac2` | BevyLabs |
| `e7eec6fe-31bd-4b83-be99-f1fd2cabfafb` | DevForum |
| `101b0c0b-7093-4902-b3a9-e63787893a3d` | Talent Hub |
| `75847db2-2b06-474b-83ec-05652f71c166` | Guilded |

## Notes

- Endpoints on `www`, `assetgame`, and `api` subdomains are largely deprecated and may be removed at any time.
- Most API sites expose a Swagger UI at `/docs` (e.g. `https://thumbnails.roblox.com/docs`).
- The `api.roblox.com` legacy docs are archived separately in the [api-docs](/article.php?path=infrastructure%2Fapi%2Fapi-docs) article.
- Roblox published an official OpenAPI 3.0.4 spec covering Open Cloud APIs on the [creator-docs GitHub](https://github.com/Roblox/creator-docs/blob/main/content/en-us/cloud/reference/openapi.md).
