# Join Scripts

*Credits: lrre.wiki (original documentation), ORC guide server community, SomeoneInTheWorld (SavePlaceRemove)*

Joinscripts are used to make a client connect to a gameserver.

## Lua Join Script

TODO

## JSON Join Script (2016+)

Roblox switched from Lua join scripts to JSON join scripts in 2016.

Example JSON:
```json
{"ClientPort":0,"MachineAddress":"127.0.0.1","ServerPort":25564,...}
```

### Properties

| Property | Description |
|----------|-------------|
| UserName | Username of connecting player |
| CharacterAppearance | Character appearance URL |
| CharacterAppearanceId | Character appearance ID |
| ServerPort | Server port |
| ClientPort | Source port (0 = random) |
| MachineAddress | Server IP |
| BaseUrl | Base URL of the game |
| CreatorTypeEnum | User or Group |
| MembershipType | None, BuildersClub, TurboBuildersClub, OutrageousBuildersClub |
| ClientTicket | Client authentication ticket |
| SuperSafeChat | Whether Super Safe Chat is enabled |
