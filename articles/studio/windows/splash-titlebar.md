# Studio: Splash Screen & Title Bar

*Credits: ORC guide server community, Kinery (custom title method), mugny (PlayerBeta title variant)*

## Change Studio Splash Screen

1. Open x32dbg > RobloxStudioBeta
2. Right-click > Search For > All Modules > String References
3. Search "splash", find `:/images/RobloxStudioSplash.png`
4. Double-click > in CPU, Follow In Dump > RobloxStudioBeta_(stuff)
5. Select the string in dump (don't select green dot) > Ctrl+E
6. Click "Keep Size"
7. Change to: `Content/RobloxStudioSplash.png`
8. Ctrl+P > Patch File > save as .exe

## Custom Title Bar

The string-table method is credited to Kinery. Mugny posted a similar procedure for PlayerBeta clients.

1. Open file in Resource Hacker
2. Create new resource with string table:

```
STRINGTABLE
LANGUAGE LANG_ENGLISH, SUBLANG_ENGLISH_US
{
  13,     "inserttitlehere"
}
```

3. Compile, save, load in debugger
4. Right-click > Search For > Current Module > Command
5. Paste `push 0x320` and press OK
6. Find `push 65` (push 0x65) above it, change to `push 0xD`
