# iOS Patching Guide (2016)

*Credits: ORC guide server community, mssky (alternative method)*

## IPA Patching Steps

1. Download desired IPA
2. Change .ipa to .zip
3. Extract and open
4. Edit info.plist: roblox.com to 10-char domain
5. Save, zip back up
6. Sideload on iPhone

Requires mobile API set up on your site.

## Alternative Method (mssky)

1. Rename .ipa to .zip, unzip
2. Replace all roblox.com with your domain via text editor
3. Re-zip, rename .zip to .ipa
4. Sideload

## Required Endpoints

- `/device/initialize`
- `/login/v1` or `/v2/login`
- `/signup/v1` or `/v2/signup`
