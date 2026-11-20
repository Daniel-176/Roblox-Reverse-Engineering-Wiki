# Placelauncher Status Codes

*Description: Roblox game error codes and status list returned by PlaceLauncher.ashx for modern clients (2018+)*
*Credits: neva (author)*

The client transitions through status codes when joining a game:

- `0`: retry until new status, "Waiting for an available server"
- `1`: retry until new status, "Server found, loading..."
- `2`: join, "Joining server"

## Unjoinable Statuses

Status codes above `2` are errors and cannot be joined:

| Code | Meaning | Message |
|------|---------|---------|
| `3` | Game disabled | "This game is disabled" |
| `4` | Gameserver not found | "Cannot find game server" |
| `5` | Game ended/shutdown | "This game has ended" |
| `6` | Game full | "Requested game is full" |
| `10` | Followed user left the game | "Followed user has left the game" |
| `11` | Game restricted | "This game is restricted" |
| `12` | Unauthorized | "Not authorized to join this game" |
| `13` | Server busy (shutting down) | "Server is busy" |
| `14` | Hash was on MD5 list | "Hash Expired" |
| `15` | Hash NOT on MD5 list | "Hash Exception" |
| `16` | Party too large | "Your party is too large to fit" |
| `17` | Public key failure or SSL failure | "A http error has occured. Please close the client and try again." |

## Flow

Your status should go from `0` (contacting gameserver for start) to `1` (gameserver started new job, wait for place load) and finally `2` to join.
