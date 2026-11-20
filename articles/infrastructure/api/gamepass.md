# API: Gamepass Purchasing System

*Credits: zfut (author), ethanm2502 (void source)*

## Overview

Endpoints needed for gamepass purchases in old clients (2016E and below).

## /Login/Negotiate.ashx

Gets account cookie. Client uses `-a "http://yourdomain.com/Login/Negotiate.ashx"`. Returns ROBLOSECURITY cookie.

```
setcookie(".ROBLOSECURITY", "YOURROBLOSECURITY", time() + (460800*30), "/", '.yourdomain.com');
```

## /marketplace/productinfo?assetId=gamepassid

Returns gamepass info JSON with TargetId, AssetId, ProductId, Name, Description, PriceInRobux, etc.

## /currency/balance

Returns: `{"robux": 123123}`

## /marketplace/purchase

Accepts purchase. Request uses locationId/placeId, productId, purchasePrice.

Success: `{"success":"true","status":"Bought","receipt":"..."}`
Failure: `{"success":"false","status":"Error","receipt":null,"message":null}`

## /ownership/hasasset?userId=X&assetId=Y

Returns 1 if owned, 0 if not. Alternative: `/Game/GamePass/GamePassHandler`
