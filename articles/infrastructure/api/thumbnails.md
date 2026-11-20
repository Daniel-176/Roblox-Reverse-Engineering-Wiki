# API: Thumbnail Rendering (RCC + SoapUI)

*Credits: ORC guide server community, vmware (RBXGS tutorial)*

1. Download an RCC version
2. Start RCC with `-console` argument
3. Download [SoapUI](Resources/SoapUI.exe) or Insomnia. The [SoapUI for RCCService page](/article.php?path=rccservice%2Fwindows%2Fsoapui) also lists the SoapUI-RS rewrite and an archived source project.
4. Open SoapUI > localhost/127.0.0.1, port should be pre-set
5. Select "openjobex" command type

## Render Script (2007/8)

```lua
game.Players:CreateLocalPlayer(0)
game.Players.Player:LoadCharacter()
print(game:GetService("ThumbnailGenerator"):Click("PNG", 500, 500, true))
```

## Render Script (2015+)

```lua
game:GetService("ContentProvider"):SetBaseUrl("http://www.roblox.com")
game:GetService("ScriptContext").ScriptsDisabled = true
game.Players:CreateLocalPlayer(0)
game.Players.Player1:LoadCharacter()
print(game:GetService("ThumbnailGenerator"):Click("PNG", 500, 500, true))
```

RCC outputs base64 hash, decode to image. For loading a place: `game:Load("rbxasset://place.rbxl")`

## RBXGS Tutorial (Alternative to RCC)

1. Extract RBXGS installer with lessmsi
2. Download RBXGSConHost
3. Copy Content folder to main directory
4. Open [SoapUI](Resources/SoapUI.exe) > RBXGS Mode > IP 127.0.0.1:64989
5. Copy Environment ID from console, use in "execute" command

## 2012 ThumbnailGenerator reimplementations

The 2012 client retains `RenderView::renderThumb` functionality used by these `ThumbnailGenerator` projects:

- [watrabi/rbxRenderHook](https://github.com/watrabi/rbxRenderHook): fixes brick rendering.
- [unhappyworld/rbxRenderHook](https://github.com/unhappyworld/rbxRenderHook): removes cURL functionality and supports character thumbnail views. Increase the resolution setting if characters appear too small.
- [RogueCadet/rbxRenderHookRevivalEdition](https://github.com/RogueCadet/rbxRenderHookRevivalEdition): fork of unhappyworld's version with image uploading and revival-oriented changes.

*Credits: watrabi, unhappyworld, RogueCadet. Shared by vmultrawarefan. From ORC Guide, October 28, 2025.*
