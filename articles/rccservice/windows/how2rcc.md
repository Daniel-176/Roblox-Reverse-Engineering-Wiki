# RCCService Overview

*Credits: lrre.wiki (original documentation), BrentDaMage (WSDL documentation), ORC guide server community*

RCCService is the server Roblox has used since 2008 to manage game servers and rendering thumbnails. It stands for "Roblox Cloud Compute Service", and uses SOAP over HTTP (typically 127.0.0.1:64989).

## SOAP Methods

RCCService exposes a [WSDL interface](Resources/RCCService.wsdl) with the following methods. Types suffixed with "Ex" return strongly-typed `ArrayOfLuaValue` instead of raw arrays.

See [RCCService Job Examples](/article.php?path=rccservice%2Fwindows%2Fjob-examples) for GameServer and Thumbnail settings JSON.

| Method | Parameters | Returns |
|--------|-----------|---------|
| HelloWorld | (none) | string |
| GetVersion | (none) | string |
| GetStatus | (none) | Status (version string, environmentCount int) |
| OpenJob / OpenJobEx | Job, ScriptExecution (optional) | LuaValue[] |
| BatchJob / BatchJobEx | Job, ScriptExecution | LuaValue[] |
| Execute / ExecuteEx | jobID (string), ScriptExecution | LuaValue[] |
| RenewLease | jobID (string), expirationInSeconds (double) | double |
| CloseJob | jobID (string) | void |
| GetExpiration | jobID (string) | double |
| GetAllJobs / GetAllJobsEx | (none) | Job[] |
| CloseExpiredJobs | (none) | int |
| CloseAllJobs | (none) | int |
| Diag / DiagEx | type (int), jobID (string, optional) | LuaValue[] |

### Data Types

**Job**: `{id: string, expirationInSeconds: double, category: int, cores: double}`

**ScriptExecution**: `{name: string, script: string, arguments: LuaValue[]}`

**LuaValue**: `{type: LuaType, value: string, table: LuaValue[]}`

**LuaType**: enum of LUA_TNIL, LUA_TBOOLEAN, LUA_TNUMBER, LUA_TSTRING, LUA_TTABLE

### PHP Usage

```php
$rcc = new Roblox\Grid\Rcc\RCCServiceSoap("127.0.0.1", 64989);
$rcc->HelloWorld();
$rcc->GetVersion();
$status = $rcc->GetStatus();
$jobs = $rcc->GetAllJobs();

$job = new Roblox\Grid\Rcc\Job("job-id");
$script = new Roblox\Grid\Rcc\ScriptExecution("script-name", 'print("hello")');
$result = $rcc->BatchJob($job, $script);
```

## Arguments

| Argument | Description |
|----------|-------------|
| -console | Console mode |
| -start | Service mode |
| -placeid:<ID> | Opens and loads Place ID |
| -verbose | Verbose output |

## ThumbnailGenerator

Instance used by RCCService to render thumbnails.

`string Click(string format, int x, int y, bool hideSky)`

- Renders image at resolution x/y, returns Base64-encoded image
- Formats: PNG, GIF, BMP, others

## Trustcheck Registry Entry

`HKEY_LOCAL_MACHINE/SOFTWARE/Roblox`
Add DWORD "SkipTrustCheck" = 1 to disable trust check
