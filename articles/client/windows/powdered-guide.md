# Powdered's Patching Guide (2012 PC)

*Credits: Powdered (author)*

## HxD Steps

1. Open exe in HxD, Ctrl+R, replace roblox.com with 10-char domain
2. Generate key from RBXSigTools > PublicKeyBlob.txt > copy
3. Search BGIAA, replace with your public key

## x32dbg Steps

1. Symbols > double-click RobloxPlayerBeta.exe
2. Click [Az] icon > References window
3. Search "Invalid Request" > JNE/JE > JMP each
4. Search "blocking %s" > scroll up > JE > JMP
5. Patch > save as -PATCHED.exe

**Note:** Make sure you have selected RobloxPlayerBeta.exe in the symbols list, not msvcrt or any other module. Also do not use x64dbg, stick to x32dbg for these clients.

## Web Setup

1. Set up web host, make key folder (non-browser accessible)
2. Place RBXSigTools generated files in it
3. Create /game/ folder with studio.ashx.php
4. Create joinscript
5. Create /asset/ folder with basic asset script

## Mobile (iOS)

1. Install Roblox mobile (2.4.1 recommended)
2. Use 3utools > Files > User applications > Roblox > Roblox.app
3. Edit info.plist: replace roblox.com with your domain
4. Export robloxmobile, edit in HxD, re-import
5. Set up /mobileapi/login, /games/list, /games/start endpoints

## Security Notes

- Do not run the patched client with robloxplayerbeta.exe exposed to untrusted users as it bypasses trust checks
- Use a dedicated server environment for hosting
