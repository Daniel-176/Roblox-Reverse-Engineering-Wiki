# Website API Endpoints

*Credits: lrre.wiki (original documentation), Karma (author), la (original finding)*

## Legacy Endpoints

| Endpoint | Description |
|----------|-------------|
| GET /currency/balance | Returns current user balance (robux, tickets) |
| GET /games/players/{user_id} | Returns ChatFilter for specified user |
| GET /ownership/hasasset/{asset_id}/{user_id} | Returns whether user has asset |
| POST /moderation/filtertext | Returns censored version of text |
| GET /v1.1/avatar-fetch/{user_id} | Returns character appearance (asset URLs) |
| GET /my/economy-status | Returns economy status |
| GET /users/{user_id}/canmanage/{place_id} | Returns whether user can manage place |
| POST /marketplace/game-pass-product-info/ | Returns game pass product info |
