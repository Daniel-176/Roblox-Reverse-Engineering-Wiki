# Site: Patch Tickets (2018L+)

*Credits: ORC guide server community*

## Method 1: 2018

1. Search "ProcessTicket exception"
2. Double-click "ServerReplicator::processTicket exception: %s"
3. Find JE above, JMP
4. Find ProcessTicketException under the string
5. Binary > Edit > first two hex bytes > 00

## Method 2: 2019

Use FFlag: `"DFFlagCLI120342":"True"`

## Method 3: Most Versions

Use debuglocalrcc fflag. JMP either "127.0.0.1" with D188 near it, or "localhost" with D188 near it. Apply fflag on both client and RCCService.
