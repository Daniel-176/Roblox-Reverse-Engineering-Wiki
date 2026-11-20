# Studio: Hosting & Fullscreen

*Credits: ORC guide server community, guideofsmth (renderhook)*

## Studio Host Batch Script

```batch
@echo off
set /p map=Drag map into here
echo What is the port
set /p Port="port: "
start RobloxStudioBeta.exe -localPlaceFile %map% -task StartServer -port %port%
```

## Studio 2016: Fullscreen Mode

Build start command will start studio in fullscreen with no Qtitan GUIs as long as it's 2016 or below.

## RenderHook DLL Guide

1. Download rbxRenderhook source, build in Debug/Win32
2. Copy rbxRenderhook.dll to client directory
3. Open studPE to drag RobloxStudioBeta.exe in
4. Functions > Add New Import > Dll Select > select the DLL
5. Select Function > add to list > OK

Usage: `render("file.png", 768, 432, "http://google.com")`
