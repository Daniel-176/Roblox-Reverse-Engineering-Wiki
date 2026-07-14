# Historical Vulnerabilities

*Credits: lrre.wiki (original documentation)*

*Description: Historical Roblox vulnerabilities including critical loadstring, chat crash, and signature bypass issues.*

## Vulnerability Table

| Vulnerability | Affects | Patched | Severity |
|--------------|---------|---------|----------|
| Loadstring can run bytecode | Client & Studio | Aug 3, 2012 | CRITICAL |
| :Chat has no check on length, can crash RCCService | RCCService | 2020 | CRITICAL |
| Lots of UIs can cause de-spawning of CoreGUI | Studio & Client | 2021 | CRITICAL |
| __gc can be used to execute the sandbox | Needs more info | 2006-2009 | HIGH |
| Instance::setParentInternal can parent tools to StarterPack regardless of FilteringEnabled | Needs more info | 2023 | HIGH |
| Shirts with bad cHRM chunk data can crash others | Client & Studio(?) | 2014 | HIGH |
| Scripts can access ClientReplicators to IP log users | Client | Nov 17, 2016 | HIGH |
| Crypt::verifySignatureBase64 buffer overflow (1024+ bytes) | Needs more info | 2009-2018 | MEDIUM |
| CVE-2011-3026 can stop avatar loading | Website | Needs more info | LOW |
| **UNCONFIRMED!** Winsock asset streaming (allows for any content to be streamed through network) | Client & RCC | Needs more info | HIGH |
| game.NetworkServer.IncommingConnection can grab connecting player ips| Client & RCC | 2007 - 2012 | HIGH |