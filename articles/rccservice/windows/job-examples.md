# RCCService Job Examples

*Credits: author not identified. From ORC Guide.*

These example JSON settings show a `GameServer` job and an avatar `Thumbnail` job. Replace the IDs, URLs, ports, and keys for your own setup.

## GameServer

```json
{
  "Mode": "GameServer",
  "Settings": {
    "PlaceId": 1,
    "CreatorId": 1,
    "GameId": "Test",
    "MachineAddress": "127.0.0.1",
    "MaxPlayers": 30,
    "GsmInterval": 5,
    "MaxGameInstances": 5,
    "PreferredPlayerCapacity": 30,
    "UniverseId": 1,
    "BaseUrl": "https://www.yourdomain.com",
    "PlaceFetchUrl": "https://www.yourdomain.com/asset/?id=1",
    "MatchmakingContextId": 1,
    "CreatorType": "User",
    "PlaceVersion": 1,
    "JobId": "Test",
    "PreferredPort": 53640,
    "ApiKey": "key",
    "PlaceVisitAccessKey": "key"
  }
}
```

## Thumbnail

```json
{
  "Mode": "Thumbnail",
  "Settings": {
    "Type": "Avatar",
    "Arguments": [
      "https://www.roblox.com",
      "https://avatar.roblox.com/v1/avatar-fetch?placeId=0&userId=1",
      "PNG",
      1024,
      1024
    ]
  }
}
```

[Original text attachment](/vault/discord/orc-guide/guides/gameserver-thumbnail-job-examples.txt)
