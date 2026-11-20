# Network: Trust Check Bypass

*Credits: ORC guide server community*

## Basic Trust Check Failed

1. Open x32dbg
2. Search "trust check failed"
3. JMP the JNE above trust check
4. Patch the file

## Full Trust Check Patch

1. String search "trust check failed"
2. Click on "trust check failed for %s"
3. JMP both JNE and JE
4. Click other "trust check failed for %s"
5. JMP both JNE and JE

## Prevent IP Leak

1. Open RobloxApp in x32dbg
2. Symbols, select RobloxApp
3. String search all modules
4. Search each: "connection accepted", "connection from", "lost connection from", "Disconnect from"
5. Follow in dump, select the %s at end
6. Replace %s with null bytes (00)
