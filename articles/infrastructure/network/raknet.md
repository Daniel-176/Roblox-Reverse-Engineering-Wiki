# RakNet Networking Protocol

*Credits: lrre.wiki (original documentation), watrabi (source archive and Rocknet-rblx). From ORC Guide.*

RakNet is the networking protocol that Roblox uses. It uses UDP as a base, and provides out-of-order delivery compensation and reliable transmission.

## Data Types

| Type | Size | Notes |
|------|------|-------|
| byte | 1 | |
| bool | 1 | |
| long | 8 | |
| magic | 16 bytes | OFFLINE_MESSAGE_DATA_ID |
| short/ushort | 2 | |
| string | varies | Perl-style (short prefix + data) |
| address | 7 bytes | |
| uint24le | 3 bytes | |

## Connection Handshake

1. Client -> Server: Open Connection Request 1 (0x05)
2. Server -> Client: Open Connection Reply 1
3. Client -> Server: Open Connection Request 2
4. Server -> Client: Open Connection Reply 2
   *(RakNet connection established)*
5. Client -> Server: Connection Request
6. Server -> Client: Connection Request Accepted
7. Client -> Server: New Incoming Connection
   *(Game packets follow)*

### Packet 0x05 - Open Connection Request 1

Fields: Magic (magic), Version (byte), MTU (padding)

## Source Archive

[RbxRakNet source archive](/vault/discord/orc-guide/engine/roblox-raknet.zip), shared by watrabi. The archive's version and date are unknown.

## Roblox 2016 Server Implementation

[Rocknet-rblx](https://github.com/watrabi/Rocknet-rblx) is a server implementation for the Roblox 2016 source. Created by watrabi.

