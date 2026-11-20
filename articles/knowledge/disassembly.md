# Disassembly & Reverse Engineering

*Credits: lrre.wiki (original documentation)*

Disassembly is taking apart binaries (.exe files) to analyze without source code. Necessary for hooks, string modification, and other client modifications.

## Tools

| Tool | Description |
|------|-------------|
| Cutter | Cross-platform disassembler with Ghidra decompiler |
| IDA Pro + Hex-Rays | Preferred but expensive |
| Ghidra | NSA-developed, free, requires Java |
| x64dbg | Windows debugger |
| HxD | Hex editor |
| Resource Hacker | Resource editor |

For Windows DLL import and Detours examples, see [DLL Hooking for Legacy Roblox Clients](/article.php?path=knowledge%2Fdll-hooking).

## x86 Instructions

| Instruction | Description |
|-------------|-------------|
| jmp | Unconditional jump |
| call | Call procedure |
| cmp | Compare two values |
| mov | Move value |
| nop | No operation |
| jnz | Jump if not zero |
| jz | Jump if zero |

## CPU Registers

| Register | Purpose |
|----------|---------|
| EAX | Accumulator |
| EBX | Base |
| ECX | Counter |
| EDX | Data |
| EBP | Base pointer |
| ESP | Stack pointer |
| EDI | Destination index |
| ESI | Source index |
| EIP | Instruction pointer |
| EFLAGS | Status flags |

## Memory

Types: uint64, uint32, uint16, uint8
Endianness: Little-endian

## Calling Conventions

| Convention | Description |
|------------|-------------|
| __cdecl | Caller cleans stack |
| __thiscall | This pointer in ECX |
| __stdcall | Callee cleans stack |

## Module Sections

| Section | Contents |
|---------|----------|
| .text | Executable code |
| .rodata | Read-only data |
| .data | Read-write data |
| .bss | Uninitialized data |
