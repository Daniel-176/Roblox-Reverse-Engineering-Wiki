# Client Patching: Windows, 2008 HtmlService

*Credits: gravity_hq. From Roblox Revival Helpers, June 15, 2024.*

The source guide warns that HtmlService can expose a server to remote-code-execution exploits.

1. Open `Roblox.exe` or `RobloxApp.exe` in x32dbg mode.
2. Open the module in **Symbols** and search its string references for `htmlservice`.
3. Inspect each result and locate the nearby `JE` or `JNE`.
4. Change the conditional jump to `JMP`, then save the patch.

