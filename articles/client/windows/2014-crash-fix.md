# Fix 2014L Crashing When Physics Occurs

*Credits: VMsLover*

**Issue:** Player's client crashes as soon as a physics event happens (unanchored parts).

**Fix:** Check your host script. Find and remove/comment this line:

```lua
pcall(function() settings().Network.PhysicsSend = Enum.PhysicsSendMethod.ErrorComputation2 end)
```

Change to:

```lua
-- pcall(function() settings().Network.PhysicsSend = Enum.PhysicsSendMethod.ErrorComputation2 end)
```

Rehost and rejoin. The issue should be fixed.
