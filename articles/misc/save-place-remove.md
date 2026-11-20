# Remove "Save Changes" Dialog

*Credits: SomeoneInTheWorld (author)*

## Steps

1. Open joinscript in text editor
2. Add after creating player: `game:service("Visit"):SetUploadUrl("")`
3. Open RobloxApp.exe in x32dbg
4. Symbols > [Az] > search "SetUploadUrl"
5. Double-click result
6. Find `push 5` near it, change to `push 0`
7. File > Patch File > save
