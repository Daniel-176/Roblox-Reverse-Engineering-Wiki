# Network: SSL & HTTPS Patching

## SSL Patch

*Credits: ORC guide server community*

Search for `CURLOPT_SSL_VERIFYPEER` and bypass the check with a jump.

---

## HTTPS Patch

*Credits: ORC guide server community*

## HTTPS Patch (Most Clients)

1. Search for the string `mc` and find a result that contains only `mc`.
2. Double-click it. If a `JE` or `JNE` appears nearby, change it to `JMP`.
3. Open the other `mc` result, the one without a nearby `JNE`.
4. Find `robloxlabs.com`, or your replacement domain if you already changed it.
5. Change the jump above that string to `JMP`.

---

## Auth Patch

*Credits: ORC guide server community*

To patch `universes/validate-place-join` (ID 146):

1. string search for PlaceAuthenticationThread
2. then change JE to JMP
3. save changes and enjoy

---

## Forcesign 2019

*Credits: ORC guide server community*

Change the `CryptVerifySignature` error branch to `JMP`. The note reports testing on 2019M-2019L (July-September); it does not specify the year.
