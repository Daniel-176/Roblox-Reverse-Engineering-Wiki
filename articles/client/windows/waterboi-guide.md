# Waterboi's Patching Guide: 2007-2021E

*Credits: waterboi (author), Jetray (2021E section)*

Patching notes for Windows clients from 2007 through 2021E.

Tools needed:
- Website (Join and asset API's)
- HxD (or a hex editor)
- x32dbg

## ALL CLIENTS

### Patch URL

1. Open HxD
2. Open your client inside of HxD
3. Do ctrl + R
4. For the first textbox do "roblox.com"
5. The second box put your website (MUST BE 10 CHARACTERS!)
6. Replace all
7. Then, do CTRL + S to save

### Trust Check (Insecure, like really)

1. Open x32dbg
2. Open your client
3. Go to the "Symbols" tab and double-click your client (e.g RobloxApp.exe)
4. Then click the "Az" button at the top
5. Wait for it to load then search "trust check failed for %s"
6. There should be about 2 results
7. Double click the first one
8. Scroll up a few (8) lines until you find "jne" (the quotes was on purpose, cuz too long text wtf?)
9. Click the push statement then press spacebar
10. Change "jne" to "jmp"
11. Save the change then go back to the references tab
12. Double click the one at the bottom and repeat the process.
13. do CTRL + P and click save file

## 2007 & 2010

### Patch player names

1. Open x32dbg
2. Open your client
3. Go to the "Symbols" tab and double-click your client (e.g RobloxApp.exe)
4. Then click the "Az" button at the top
5. Wait for it to load then search "set a"
6. There should be about 2 results
7. Double click the first one
8. Depending on your client there will be Push 3 or 4
9. Click the push statement then press spacebar
10. Change push 0x* to push 0x0
11. Save the change then go back to the references tab
12. Double click the one at the bottom and repeat the process.
13. do CTRL + P and click save file

### ioEnabled

1. Open x32dbg
2. Open your client
3. Go to the "Symbols" tab and double-click your client (e.g RobloxApp.exe)
4. Then click the "Az" button at the top
5. Wait for it to load then search "ioEnabled"
6. There should be about 1 result
7. Double click the first one
8. Scroll up 4 lines
9. Click the "push 4" statement then press spacebar
10. Change push 0x4 to ret
11. do CTRL + P and click save file

### HtmlService (2008)

1. Open x32dbg
2. Open your client
3. Go to the "Symbols" tab and double-click your client (e.g RobloxApp.exe)
4. Then click the "Az" button at the top
5. Wait for it to load then search "HtmlService"
6. There should be about 1 result
7. Double click the first one
8. Scroll up a few lines until you find "jne (module name).(hexadecimal)" (example: "jne Roblox.63FADC")
9. Click on the line containing "jne"
10. Press the spacebar
11. Replace the "jne" with "jmp" (DO NOT ALTER ANY OTHER LINES)
12. Press the enter key
13. Press the CTRL+P keys
14. Double-click your client name (ie: Roblox.exe)
15. Press Patch File
16. Save your file

### SiteUrl (fixing errors)

1. Open x32dbg
2. Open your client
3. Go to the "Symbols" tab and double-click your client (e.g RobloxApp.exe)
4. Then click the "Az" button at the top
5. Wait for it to load then search "Failed to get SiteUrl"
6. There should be about 1 result
7. Double click the first one
8. Scroll up 15 lines
9. Click on the line containing "jne"
10. Change jne to jmp
11. do CTRL + P and click save file

## 2013 & 2014

### Game Joining

1. Open HxD
2. Open your client
3. Get RBXSIGTOOLS
4. Open the tool and copy everything in PublicKeyBlob.txt
5. In HxD do CTRL = F
6. Search for bgiaa
7. Copy everything down to the last to ==
8. Paste your public key
9. Save

### Name And ID (2011 guide, might work for later)

1. Open x32dbg
2. Open your client
3. Once you have x32dbg open, spam the run button, symbolized as a blue arrow pointing to the right. Once you have done it enough, the roblox application should open up in the background. If it is frozen, go back to x32dbg and keep spamming the run button.
4. Once the application stabilizes, create a new game. The application will freeze, so keep spamming the run button until it frees up.
5. At this point, make sure the command bar is shown in the roblox application. If not, go to View < Toolbars Then Click Command.
6. Run this line of code in the command bar "game.Players:CreateLocalPlayer(0):LoadCharacter()" (Without Quotes).
7. Go back to x32dbg and go to the symbols tab. Look for the roblox application and click it. Then search for "_CxxThrowException" (Without Quotes). Right click the result and click toggle breakpoint.
8. Try renaming the player, or changing their id in Players < Player. The application should seize up, this is good. DO NOT SPAM RUN.
9. Go back to x32dbg, go to the CPU tab, There should be a window just above "Time Wasted Debugging" in this tab. Go to the very top value that is currently shown on that window (Dont scroll up), and right click it. Click follow DWORD in dissassembler. or Follow in dissassembler.
10. Scroll up just a little to find a dotted arrow pointing to the selected value. The arrow should be coming from a bit that starts with jne. Double click this bit and change the "jne" part to "jmp".
11. There should be a Patches icon in x32dbg, indicated by a Band-Aid. Click this, then click "Patch File". Now you must name the file.

### Blocking %s

1. Search blocking %s
2. Double click it
3. Scroll up a bit, above a few jbs, then a je. change je to jmp

### Analytics / Game

1. Search analytics
2. Double click the string that's JUST analytics
3. Scroll up to find the string
4. Change the above jne to a jmp

### Public Key (hardest one yet)

1. Search BGIAA
2. Generate a key from [rbxsigtools](Resources/rbxsigtool.zip) (or u already generated)
3. Copy that key from PublicKeyBlob.txt
4. Right click the very long string in CPU, and hover over "follow in dump" and click the address "Value [any numbers idk]"
5. Ctrl + E to change a key.

### Invalid Request + Invalid Request 2-5

1. Search invalid request
2. In every single one there is a jne or je above it, change it to jmp

### !isKeyboardAcquired

1. Search !isKeyboardAcquired
2. Double click the string thats JUST !isKeyboardAcquired
3. Scroll down a bit, you will see a push 5
4. Change it to push 6

### Fflags for 2013

1. Create folder in your client ClientSettings
2. Create file in folder ClientAppSettings.json
3. And copy that text and paste in ClientAppSettings.json here text: `{"ReconstructAssetUrlNew": "True","FFlagReconstructAssetUrl": "True","FFlagPhysics60HZ":"True","FFlagPathfindingEnabled":"True","FFlagUseKeyframeHumanoidAnimations":"True","FFlagRenderNewMaterials": true,"FFlagNewWaterMaterialEnable": true}`

### Fflags for 2014

1. Search `%s://%sapi.roblox.com/%s/?apiKey=%s`
2. Replace with `http://(your_site_url)/2014Lfflag/`
3. Go to your webhoster, create a folder in ur site "2014Lfflag"
4. Create file "index.php"
5. And copy that:

```php
<?php
	header("Content-Type: text/plain");
	ob_start();
?>
{"ReconstructAssetUrlNew": "True","FFlagReconstructAssetUrl":"True","DFFlagReconstructAssetUrl":"True","FFlagPhysics60HZ":"True","FFlagPathfindingEnabled":"True","FFlagUseKeyframeHumanoidAnimations":"True","DFFlagUseKeyframeHumanoidAnimations":"True","DFFLagLoadAnimationsThroughInsertService":"True","FFLagLoadAnimationsThroughInsertService":"True","FFlagAnimationFormatAssetId": "True","DFFlagAnimationFormatAssetId": "True","FFlagAddPlaceIdToAnimationRequests": "True","DFFlagAddPlaceIdToAnimationRequests": "True","FFlagEnableAnimationExport": "True","DFFlagEnableAnimationExport": "True", "FFlagAnimationAllowProdUrls": "True","DFFlagAnimationAllowProdUrls": "True","FFlagSSAOForce":"True","DFFlagSSAOForce":"True","FFlagNewWaterMaterialEnable":"True","DFFlagNewWaterMaterialEnable":"True","FFlagCreateHumanoidRootNode":"True","DFFlagCreateHumanoidRootNode":"True","FFlagUseCharacterRootForCameraTarget":"True","DFFlagUseCharacterRootForCameraTarget":"True","FFlagRenderNewMaterials":"False","DFFlagRenderNewMaterials":"False","DFFlagUseNewSounds":"True","FFlagUseNewSounds":"True","FFlagUserHttpAPIEnabled":"True","FFlagDataStoreEnabled":"True","DFFlagDataStoreEnabled":"True","FFlagConsoleCodeExecutionEnabled":"True","DFFlagConsoleCodeExecutionEnabled":"True","FFlagLoggingConsoleEnabled":"True","DFFlagLoggingConsoleEnabled":"True","FFlagUseNewSoundEngine":"True","DFFlagUseNewSoundEngine":"True","FFlagLocalHumanoidSoundsEnabled":"True","DFFlagLocalHumanoidSoundsEnabled":"True","FFlagRibbonBarEnabled":"True","DFFlagRibbonBarEnabled":"True","FFlagPointsServiceDisabledIfLoadStringEnabled":"False","FFlagPointsServiceEnabledForEveryone":"False","FFlagClientAdditionalPOSTHeaders":"True","FFlagToggleDevConsoleThroughChatCommandEnabled":"True","FFlagRibbonBarEnabledGA":"True","DFFlagRibbonBarEnabledGA":"True","DFFlagClientAdditionalPOSTHeaders":"True","FFlagCSGToolsEnabled":"True","DFFlagCSGToolsEnabled":"True","FFlagCSGMeshRenderEnable":"True","DFFlagCSGMeshRenderEnable":"True","FFlagCSGUseMarchingCubes": "True","DFFlagCSGUseMarchingCubes": "True","FFlagDragDetectImprovementsStart":"True","DFFlagDragDetectImprovementsStart":"True","FFlagContextualProductPurchaseModal":"True","DFFlagContextualProductPurchaseModal":"True","FFlagWebGLMultithreadedSupport":"True","DFFlagWebGLMultithreadedSupport":"True","FFlagSmoothTerrainLOD":"True","DFFlagSmoothTerrainLOD":"True","FFlagTextureQualityDropdown":"True","DFFlagTextureQualityDropdown":"True","FFlagRenderToTextureEnabled":"True","DFFlagRenderToTextureEnabled":"True","FFlagBubbleChatFromDisplayName":"True","DFFlagBubbleChatFromDisplayName":"True","FFlagGameSettingsBrandingUIUpdate5":"True","DFFlagGameSettingsBrandingUIUpdate5":"True","FFlagBuyRobuxButtonOpenBrowser":"True","DFFlagBuyRobuxButtonOpenBrowser":"True","FFlagHandleAltEnterFullscreenManually":"False","DFFlagHandleAltEnterFullscreenManually":"False","FFlagGameSettingsBrandingUIUpdate5":"True","DFFlagGameSettingsBrandingUIUpdate5":"True","FFlagBuyRobuxButtonOpenBrowser":"True","DFFlagBuyRobuxButtonOpenBrowser":"True","FFlagHandleAltEnterFullscreenManually":"False","DFFlagHandleAltEnterFullscreenManually":"False","FFlagNewAdminUX2016":"True","DFFlagNewAdminUX2016":"True","FFlagGameSettings":"True","DFFlagGameSettings":"True","FFlagGameSettingsBranding":"True","DFFlagGameSettingsBranding":"True","FFlagAdSpearOperator":"True","DFFlagAdSpearOperator":"True","FFlagNotifications2016":"True","DFFlagNotifications2016":"True","FFlagRenderToTextureEnabled":"True","DFFlagRenderToTextureEnabled":"True","FFlagSpeechToTextEnabled":"True","DFFlagSpeechToTextEnabled":"True","FFlagNotificationsNew":"True","DFFlagNotificationsNew":"True","FFlagNewAdminUX":"True","DFFlagNewAdminUX":"True","FFlagNewAdminUXOnlyInGame":"True","DFFlagNewAdminUXOnlyInGame":"True","FFlagNewAdminUXMenu":"True","DFFlagNewAdminUXMenu":"True","FFlagNewAdminUXReportAbuse":"True","DFFlagNewAdminUXReportAbuse":"True","FFlagNewAdminUXPlayerList":"True","DFFlagNewAdminUXPlayerList":"True","FFlagNewAdminUXGameDetails":"True","DFFlagNewAdminUXGameDetails":"True","FFlagAdditionalCameraControls":"True","DFFlagAdditionalCameraControls":"True","FFlagAccountInventory":"True","DFFlagAccountInventory":"True","FFlagGameDetailsBuyRobux":"True","DFFlagGameDetailsBuyRobux":"True","FFlagGameDetailsFavorites":"True","DFFlagGameDetailsFavorites":"True","FFlagGameDetailsVoting":"True","DFFlagGameDetailsVoting":"True","FFlagProfileStarCode":"True","DFFlagProfileStarCode":"True","FFlagObserverInventory":"True","DFFlagObserverInventory":"True"}
```

## 2015 & 2016 (may work for 2017)

### Game Joining

1. Open HxD
2. Open your client
3. Get RBXSIGTOOLS
4. Open the tool and copy everything in PublicKeyBlob.txt
5. In HxD do CTRL = F
6. Search for bgiaa
7. Copy everything down to the last to ==
8. Paste your public key
9. Save

### RCC client

1. Open x32dbg
2. Open your client
3. Go to the "Symbols" tab and double-click your client (e.g RobloxApp.exe)
4. Then click the "Az" button at the top
5. ermm I give up
6. Are you fucking seriously, Waterboi?

### SysStats Patch

1. string search sysstats
2. double click "Players::onRemoteSysStats disconnect"
3. jmp both jne and je, then change push 1 to push 0
4. go back to the References tab
5. double click "Players::onRemoteSysStats disconnect not in the clist"
6. first jmp the je above it
7. then jmp the jne above it
8. change push 1 to push 0

### Version Compatibility Setup

You must create two folders in your domain for the client to join (versioncompatibility.api.domain.tld):

- "GetAllowedMD5Hashes"
- "GetAllowedSecurityVersions"

After that, go into getallowedmd5hashes folder, create index.php and place the following in it:

```json
{"data":["YOURCLIENTHASHGOESHERE"]}
```

To get your client's hash, go here http://onlinemd5.com/ and drag your .exe to it. The letters will be uppercase, you gotta make them lowercase.

Now set up GetAllowedSecurityVersions. Go in the folder, create index.php, and put this in it:

```json
{"data":["THEVERSIONOFYOURCLIENTHEREpcplayer"]}
```

To get the version of your client, launch your client with the single arg: `--version`
Now copy the first 7 characters (example: 0.xxx.0)

After that you should put in the index like this:

```json
{"data":["0.xxx.0pcplayer"]}
```

## 2021E (THE MOST FUCKING HARD EVER) (also thanks jetray) (mostly lan patched)

Open up x32dbg then drag the client in.

Go to symbols, RobloxPlayerBeta.exe then once it loads click the right arrow, which is at the top left of the screen. Be sure to click that twice (clicking the arrow gets around vmprotect).

Now right click anywhere on code > Search for > Current Module > string references.

Search for "trust check failed". Click on each result one by one, find the je or jne above it. Click on the je or jne, then click the spacebar, and then change it to jmp and click enter.

Search for "127.0.0.1", go through each result and find the one that has a je above it and a "push D188" under the je. turn the je to jmp, and if theres another "127.0.0.1" under a je or jne above that, also jmp that.

Create a folder called clientsettings in the same folder as the player. In that folder make a file called ClientAppSettings.json, and change it to the contents of this file: https://www.mediafire.com/file/ktli6i6dkcxf1u4/ClientAppSettings.json/file

Change ssl/cacert.pem file to this file: https://www.mediafire.com/file/ytfj51sxsmbws0v/cacert.pem/file

Download these two dlls: https://www.mediafire.com/file/jbimz51b6a5jgeu/Player.7z/file, then extract them into the same folder as the client.

Final client patch: Open stud_pe and drag the client in. go to functions then right click anywhere on imported functions. Click add new import. Dll Select. and select Injector. Select func. add the only func, then click add to list. click on the function, then click add, then click ok.

Done patching client.

### Patching the Server (2021E)

Open the rccservice up in hxd. Search for `00 68 74 74 70 73 00` and change it to `00 68 74 74 70 00 00` and save it.

Close hxd and open x32dbg. Now patch trust check similarly to how you did it with the client, this time just dont click the right arrow because rcc does not have vmprotect. Also patch "Non-trusted BaseURL used. HttpRbxApiService is only for Roblox API calls" with jmp, just like you did for trust check failed.

Put this in the same folder as the rcc: https://www.mediafire.com/file/z6fu21i4lt6qo3f/DevSettingsFile.json/file

Also put this in the same folder as the rcc: https://www.mediafire.com/file/n75folbg0dwt9m7/gameserver.json/file

### Setting up the Website (2021E)

I have already prepared a premade website for this client, https://www.mediafire.com/file/l2g0u80ad36r3i0/Webserver.7z/file

Now run uwamp.exe

Finally, we can start the rcc and client. Heres the cmds.

Server: `RCCService.exe -Console -verbose -placeid:1818 -localtest "gameserver.json" -settingsfile "DevSettingsFile.json" -port 64989`

Client: `start RobloxPlayerBeta.exe -a "http://localhost/Login/Negotiate.ashx" -j "http://localhost/game/placelauncher.ashx" -t "1"`

If you get placeId verification failed, its probably because you are using an incorrect content folder. You can find a working one in various places online.

If you run into any other issues, try to use this precompiled content folder and shaders, and everything else rcc may need: https://www.mediafire.com/file/az99ei05rnp74pw/Content.7z/file

there you go
