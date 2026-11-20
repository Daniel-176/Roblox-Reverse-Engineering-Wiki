# Client Patching: Windows, Common Patches

*Credits: gravity_hq; Kinery (custom title, RatNet, and 2011 patches). From Roblox Revival Helpers, June 15, 2024.*

## Universal patches

### Player, Studio, RCCService

#### Website patch

*Note: unnecessary on 2007-2010, but still recommended. Required from 2010 onward.*

1. Run HxD and open your client: `Roblox.exe`, `RobloxApp.exe`, `RobloxPlayerBeta.exe`, or `RobloxStudioBeta.exe`.
2. Press **Ctrl+R**.
3. In **Search for**, enter `roblox.com`.
4. In **Replace with**, enter your website domain. It must be 10 characters long.
5. Set **Search direction** to **All**.
6. Choose **Replace All** and press **Ctrl+S**.
7. Open `AppSettings.xml` in a text editor. If it is missing, create it with a `Settings` element containing `ContentFolder` and `BaseUrl`, then set `BaseUrl` to your domain.

#### Public key patch

*Note: required on versions from 2009 onward.*

1. Download [RbxSigTools](https://www.mediafire.com/file/msbfxp1ades6v9j/tools.zip/file) and extract it.
2. Run `KeyGenerator.exe`. It creates `PublicKeyBlob.txt`, `PrivateKeyBlob.txt`, and `PrivateKey.pem`.
3. Open the client in HxD and search all for `BGIAA`.
4. Select the complete public key and replace it with the contents of `PublicKeyBlob.txt`.
5. Save the file.

### Blocking `%s` patch

*Not recommended. It allows assets to be inserted from other domains, including Roblox assets after a site patch.*

1. Open x96dbg in x32dbg mode and load the Roblox client.
2. In **Symbols**, double-click the client module.
3. Open the string search with **Az** and search for `blocking %s`.
4. Double-click the first result. Scroll up to the block of consecutive `JB` instructions and the `JE` after them.
5. Select the `JE`, press Space, and change it to `JMP`.
6. Press **Ctrl+P**, select all patches, and choose **Patch File**.
7. If the patches appear red, review the edit or restart. The change may exceed the original instruction size and relocate code.

### Invalid request patch

*Major security risk. Use only with a launcher or a friends-only revival.*

1. Open x96dbg in x32dbg mode and load the Roblox client.
2. In **Symbols**, double-click the client module.
3. Open string search with **Az** and search for `invalid request`.
4. Check each result. A few lines above it, find the `JE` or `JNE` instruction.
5. Select the instruction, press Space, and change it to `JMP`.
6. Press **Ctrl+P**, select all patches, and choose **Patch File**.
7. If the patches appear red, review the edit or restart. The change may exceed the original instruction size and relocate code.

### Trust check patch

*Not recommended. The guide describes it as an older version of the invalid-request patch and gives the same security warning.*

1. Open x96dbg in x32dbg mode and load the Roblox client.
2. In **Symbols**, double-click the client module.
3. Open string search with **Az** and search for `trust check failed for %s`.
4. Double-click each result. A few lines above it, find the `JE` or `JNE` instruction.
5. Select the instruction, press Space, and change it to `JMP`.
6. Press **Ctrl+P**, select all patches, and choose **Patch File**.
7. If the patches appear red, review the edit or restart. The change may exceed the original instruction size and relocate code.

### Username patch

*May allow inappropriate names. Usually unnecessary after 2012.*

1. Open x96dbg in x32dbg mode and load the Roblox client.
2. In **Symbols**, double-click the client module.
3. Open string search with **Az** and search for `set a Player's name`.
4. Double-click each result. Find the `push 3` instruction below it.
5. Select the instruction, press Space, and change `3` to `0`.
6. Press **Ctrl+P**, select all patches, and choose **Patch File**.

### User ID patch

*May allow bad IDs. Usually unnecessary after 2012.*

Use the username patch steps, searching for `set a Player's id`.

### Character name patch

*May allow inappropriate names. Usually unnecessary after 2012.*

Use the username patch steps, searching for `set a Character's name`.

## RCCService RatNet key patch

*Credit: Kinery. Required for some RCCService versions.*

1. Open RCCService in x96dbg in x32dbg mode.
2. Open string search with **Az** and enable **RegEx**.
3. Search for `^.[A-Qa-q0-9]{40}.$` or `^.[A-Za-z0-9]{40}.$`.
4. Open the first result and locate the key in the dump.
5. Replace it with the key for your RCCService version:

   - `RCCService-0.285.0.49012`: `1ro78912031q78334p81s417q586ss732s4qr2n4`
   - `RCCService-0.206.0.62042`: `77on3909rpn6n323ro1274963ro43776rsn18488`

6. Press **Ctrl+P**, select all patches, and choose **Patch File**.

## 2011 Player name and ID patch

*Credit: Kinery. Works on most 2011 versions.*

1. Open `RobloxApp.exe` in x32dbg and press **Run** until the window loads.
2. Choose **File > New** and press **Run** again until the game loads.
3. In x32dbg, open **Symbols**, select the `RobloxApp.exe` module, and find `__CxxThrowException`.
4. Right-click the result and set a breakpoint.
5. In Roblox, open **View > Toolbars > Command Bar** and run `game.Players:CreateLocalPlayer(0):LoadCharacter()`.

6. Select the player and change the name or ID. Repeat the steps for the other value. The game should hang; do not press **Run** again.
7. In x32dbg, open the highlighted area at the bottom right of the CPU view and change the jump instruction.

## 2008 HtmlService patch

*Warning: HtmlService can expose a server to remote-code-execution exploits.*

1. Open `Roblox.exe` or `RobloxApp.exe` in x96dbg in x32dbg mode.
2. In **Symbols**, double-click `RobloxApp.exe`.
3. Open string search with **Az** and search for `htmlservice`.
4. Double-click each result. A few lines above it, find the `JE` or `JNE` instruction.
5. Select the instruction, press Space, and change it to `JMP`.
6. Press **Ctrl+P**, select all patches, and choose **Patch File**.
