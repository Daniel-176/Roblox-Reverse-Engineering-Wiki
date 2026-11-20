# DLL Hooking for Legacy Roblox Clients

*Credits: Skyler-sama; Mike (Floof), with help from Marsoc. From ORC Guide.*

## Add an import with LordPE

1. Open the client executable in LordPE and choose **PE Editor**.
2. Open **Directories > ImportTable**.
3. Right-click the import list and choose **Add Import**.
4. Enter the DLL name and an exported function from that DLL, then save the executable.

[Original note](/vault/discord/orc-guide/guides/dll-hooking-skyler-sama.txt)

## Detours example

Targets clients before VMProtect, including 2012M and earlier.

Requirements listed in the guide: C/C++, Visual Studio, Detours 3 or another hook library, a decompiler, and StudPE.

Export a function from the DLL:

```cpp
extern "C" __declspec(dllexport) void PE_Entry() {}
```

Start work on a separate thread from `DllMain`:

```cpp
DisableThreadLibraryCalls(hModule);
CreateThread(0, 0, (LPTHREAD_START_ROUTINE)threadEntry, hModule, 0, 0);
```

The guide uses this macro to resolve addresses when ASLR is enabled:

```cpp
#define ASLR(x) (x - 0x400000 + (DWORD)GetModuleHandleA(0))
```

Example hook for the client function at `0x675A20`:

```cpp
typedef void (__cdecl* pushS_t)(DWORD*, const char*);
UINT_PTR pushS_a = 0x675A20;
pushS_t pushS = reinterpret_cast<pushS_t>(ASLR(pushS_a));

void __cdecl pushS_hook(DWORD* a1, const char* a2) {
    puts("hello there!");
    return pushS(a1, a2);
}

DetourTransactionBegin();
DetourUpdateThread(GetCurrentThread());
DetourAttach((PVOID*)&pushS, pushS_hook);
DetourTransactionCommit();
```

Build the DLL and use StudPE or a similar PE editor to add it to the executable's imports.

[Original text attachment](/vault/discord/orc-guide/guides/dll-hooking-mike-floof.txt)
