# Site: Asset Redirect & Joinscript

*Credits: iknowidontexistbutwhatifwin (hosts trick + PHP)*

## Asset Redirect (Pre-2018)

1. Open `C:/Windows/System32/drivers/etc/hosts`
2. Add: `127.0.0.2 assetgame.roblox.com`
3. Set up XAMPP with index.php:

```php
<?php header("Location: https://assetdelivery.roblox.com/v1/asset/?".$_SERVER["QUERY_STRING"]); ?>
```

4. If you changed URLs in client, make sure hosts entry matches

## Less Requests Patch

1. String search "/Error/Dmp.ashx"
2. Scroll up, JMP all JNE and JE
3. Done, Roblox will say offline mode but stuff still works

## Version Compatibility API

Create two folders on your domain:

- `GetAllowedMD5Hashes`: `{"data":["YOURCLIENTHASH"]}`
- `GetAllowedSecurityVersions`: `{"data":["0.xxx.0pcplayer"]}`
