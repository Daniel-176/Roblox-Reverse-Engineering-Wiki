# Client Patching: Windows, 2017E Version Check

*Credits: author not identified. Target: Danills 2017E clients. From ORC Guide.*

Use x32dbg and RCCService.

1. Open the client in x32dbg and double-click its module in **Symbols**.
2. Open string references with **Az** and search for `Checking Hash: %s`.
3. Open the result, analyze the function, and scroll up to `wcstombs+70`.
4. Copy the address of the `mov al, 1` instruction above it.
5. Select the nearby `JE`, press Space, change it to `JZ`, and use the copied address as the target.
6. Patch and save the executable.

The procedure was only reported for 2017E. [Original note](/vault/discord/orc-guide/guides/2017e-version-check.txt).
