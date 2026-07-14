# Security

When it comes to a roblox revival, security is usually pretty bad, here are some general tips to keep in mind.

# General Security Tactics
1. Use a reverse proxy to prevent IP leaks
2. Should be obvious, hash/encrypt ips when using them in a database (especially if you're new to coding) (just general web dev stuff)
3. Should be very obvious, hash passwords using a secure algorithm (just general web dev stuff)
4. Don't show site errors (e.g. php errors/warnings) to the people using the site. (just general web dev stuff)
5. Look over code, and implement things like rate limits, [**CSRF**](https://en.wikipedia.org/wiki/Cross-site_request_forgery) (This is something most revivals don't do but they **really really should**), and test for sql injection attacks along with xss attacks 
6. [General web security knowledge.](https://developer.mozilla.org/en-US/docs/Web/Security)
7. Don't leave private keys open to the public. Many revivals leave their private keys open to the public for anyone to download and use, ensure you keep it private, otherwise malicious actors could easily join as anyone and do nasty things. (do this especially if you have a client from 2011 - 2015, they can modify and do crazy things with corescripts)
# Vulnerabilities
The older roblox clients have vulnerabilities, many of which can be found [here](https://finobe.lol/article.php?path=knowledge%2Fvulnerabilities)  
Please ensure you do your best to patch these as if not, **bad things *could* happen**
# Systats
Systats is essentially the roblox anticheat  
While its not a great anticheat, for most revivals it can get the job done  
| Code         | Description                                             |
| ----------- | ------------------------------------------------------- |
| `tochigi`   | Scorn Replication (11:0)                                |
| `baseball`  | MD5 Hash wasn't correct                                 |
| `impala`    | Impossible Error (31) OR Scorn Impossible Error (31:12) |
| `robert`    | WriteCopy changed (30)                                  |
| `moded`     | Stealth Edit Revival (29)                               |
| `booing`    | Tried to modify hash function (28)                      |
| `bobby`     | Function Return Check Failed (27)                       |
| `vera`      | Tried to get build tools (26)                           |
| `vegah`     | VEH used (25)                                           |
| `fisher`    | HumanoidState::computeEvent changed (24)                |
| `dallas`    | DLL Injection (23)                                      |
| `tomy`      | Sandbox or VM detected (22)                             |
| `usain`     | Speedhack. (21)                                         |
| `carol`     | Lua vm hooked (20)                                      |
| `steven`    | OSX hash changed (19)                                   |
| `larry`     | Our VEH hook removed (18)                               |
| `mal`       | Any New CE Method (17)                                  |
| `ebx`       | HumanoidState::computeEvent changed ebx (16)            |
| `terrance`  | Early null weak pointer (15)                            |
| `ursula`    | Lua hash changed (14)                                   |
| `bruger`    | Speculative Call Check (13)                             |
| `seth`      | SEH chain into dll (12)                                 |
| `curly`     | Hooked API function (11)                                |
| `olivia`    | Debugger found (10)                                     |
| `norman`    | Lua script hash changed (9)                             |
| `mallory`   | Catch executable acccess violation (8)                  |
| `lance`     | Const Changed (7)                                       |
| `jack`      | Invalid bytecode (6)                                    |
| `imogen`    | Memory hash changed (5)                                 |
| `ivan`      | Illegal scripts (4)                                     |
| `omar`      | Bad signature (3)                                       |
| `moe`       | detected HWBP (2)                                       |
| `lafayette` | xxhash broken (1)                                       |
| `murdle`    | Cheat Engine Stable Methods (0)                 |
(could be more that I missed)  
This is a list of all the hate flags systats can give to rcc  
If you want to get an alert when systats is triggered,  
run the following function in your gameserver script  
`pcall(function() game:GetService("Players"):SetSysStatsUrl("")`  
  
It's very vital to use a form of dll hooking to fix systats instead of patching it out (like most do... or just compile source for 2016)

(NOTE: I'll probably write an entire page for this, if I learn more on how it works - watrabi)