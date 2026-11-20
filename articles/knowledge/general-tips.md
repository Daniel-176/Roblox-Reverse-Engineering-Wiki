# General Knowledge & Tips

*Credits: Compiled from the works of meditation, Powdered, waterboi, Jetray, Aep, Karma, valley, nukley, h6di, VMsLover, shikataganai, mssky, DoggoITA, ARC, zfut, SomeoneInTheWorld, Atomic, dxf, katoe_real, simple the dimple, hadi, and the entire ORC guide server community.*

*Description: Common patches, tools and domain length rules for Roblox client modification.*

## Common Patches Summary

- **Domain replacement**: HxD: roblox.com with your domain (10 chars)
- **Public key**: RBXSigTools > generate > replace BGIAA
- **Trust check**: x32dbg: JNE/JE, JMP on "trust check failed"
- **Invalid request**: JNE/JE to JMP on "invalid request"
- **Blocking %s**: JE, JMP
- **Analytics**: JNE, JMP on "analytics" string
- **SysStats**: JMP sysstats related jumps + push 1 to push 0
- **HTTPS to HTTP**: JMP "mc" strings or hex replace `00 68 74 74 70 73 00`
- **Version compatibility**: 00 out "versioncompatibility" string + API endpoints
- **RCC timeout**: `00 00 00 00 00 c0 82 40` to `00 00 f8 1f 5f a0 02 42`

## Tools Reference

| Tool | Use |
|------|-----|
| x32dbg | Debugger for patching assembly (JNE/JE, JMP) |
| HxD | Hex editor for domain/key replacement |
| RBXSigTools | Key generation for signature verification |
| stud_pe | PE editor for adding DLL imports |
| Resource Hacker | Editing string tables in launchers |
| OpenSSL | Generating RSA key pairs |
| APKTool | Decompiling/recompiling Android APKs |
| [SoapUI](Resources/SoapUI.exe)/Insomnia | Sending API requests to RCC |

## Domain Length Rules

- **10 chars**: ideal, drop-in replacement for roblox.com
- **14 chars**: can replace robloxlabs.com instead
- **12+ chars**: need to adjust push length above string
- **Extremely long**: dump free space method (paste at bottom, push address)
