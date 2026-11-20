# Client Patching: ClientSettings Hostname

*Credits: Skyler-sama. From ORC Guide.*

This HxD edit changes a `clientsettings.api` hostname to one without the `api` label. The note describes it as a fix for FFlag loading failures with a Cloudflare tunnel.

1. Open the client in HxD and search all for `clientsettings`.
2. Find the hostname formatted like `%sapi.example.com/%s/?apiKey=%s`.
3. Replace it with `%sexample.com/%s/?apiKey=%s`.
4. Fill the remaining bytes up to the existing null terminator with `00` bytes.
5. Save the executable.

The note reports that this can fix silent client exits during FFlag loading, sometimes reported as an `MSVCR110.dll` error.

[Original note](/vault/discord/orc-guide/guides/clientsettings-domain-patch-skyler-sama.txt)
