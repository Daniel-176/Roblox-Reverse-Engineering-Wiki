# RakNet Security Key

*Credits: Skyler-sama (author); Octacore (additional information). From ORC Guide.*

The key is a SHA-1 digest of the client version, client type, and salt, followed by ROT13. Example input: `0.x.0pcplayersalthere`. Client types are `pcplayer`, `androidapp`, `iosapp`, and `macplayer`. The salt is stored in RCCService; the example salt is `askljfLUZF`.

1. Concatenate the version, client type, and salt.
2. Generate a SHA-1 hash of the combined string.
3. Apply ROT13 to the hash.
4. In x32dbg, open the client module's string references, enable **Regex**, and search for `^.[A-Za-z0-9]{40}.$`. If that finds no match, try `^.[A-Qa-q0-9]{40}.$`.
5. Copy the matching 40-character key, then find it in HxD and replace it with the generated key.
6. Save the executable.

An incorrect key can cause BitStream or version compatibility errors. The guide cautions against using `ratnetkeyhowtochange.txt` because it may cause BitStream errors.

[Original note](/vault/discord/orc-guide/guides/raknet-security-key-skyler-sama.txt)

For RakNet protocol details, see [RakNet Networking Protocol](/article.php?path=infrastructure%2Fnetwork%2Fraknet).
