# Android Client Compiler Guide

*Credits: meditation/meditexts, ChatGPT (20% of fixes)*

## Requirements

- Android Studio 1.5.0-2.2.3
- Android NDK r10e
- Source code

## Steps

1. Download Android Studio (modern versions don't work)
2. Fix build.gradle, add mavenCentral and Fabric plugin
3. Add icon resource (Roblox didn't include icons in all builds)
4. Fix NDK path in android/nativeshell/build.gradle, point runNDKBuild() to your NDK