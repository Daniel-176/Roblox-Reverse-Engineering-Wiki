# Compiling 2016 Source (Client & RCC)

*Credits: dxf (major help), katoe_real (author), ___________ (alternate guide author)*

## Requirements

- Visual Studio 2012 build tools
- Visual Studio 2019/2022 (to open solution)
- Sixteensrc source code
- Contrib libraries
- Mesa (for RCC)

## Setup

1. Create `C:\Trunk2012`
2. Extract source into `C:\Trunk2012\Build`
3. Create `C:\Trunk2012\Contrib2`, extract contribs
4. Set system variable `CONTRIB_PATH = C:\Trunk2012\Contrib2`
5. Open .sln in VS 2019
6. Change all to v110 build tools

## Building

1. Change to Release (or ReleaseRCC for RCC)
2. Build App first, then WindowsClient
3. Fix zlib: copy 3rd party/zlib files to rendering/graphics3D filter
4. Delete deflate.c lines 54-55
5. For RCC: extract Mesa to RCCService folder

## Common Errors

- Boost not found: add `$(CONTRIB_PATH)\boost_1_56_0` to include directories
- Warning as error: disable in C/C++ settings
- libboost not found: add `$(CONTRIB_PATH)\boost_1_56_0\lib` to library directories
- Vulnerability: fix buffer overflow in signature check with `i<signatureLen && i<=10240`

Watrabi also shared [2016 engine source files](https://drive.google.com/file/d/1agqkRWIFIp_bHkCBDkDwni0aTHkn1pRG/view), which vmultrawarefan recommended for compiling a 2016 client.
