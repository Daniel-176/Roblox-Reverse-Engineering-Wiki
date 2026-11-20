# VIP Server Link Codes

*Credits: vmultrawarefan. From ORC Guide.*

```php
public static function GenerateLinkCodeCrypto($length)
{
    $num = ceil($length / 4) * 3;
    $randomBytes = random_bytes($num);
    $base64String = base64_encode($randomBytes);
    $trimmedString = substr($base64String, 0, $length);
    $replacedString = str_replace(['+', '/'], ['-', '_'], $trimmedString);

    return $replacedString;
}
```

The function generates random bytes, Base64-encodes them, truncates the result to the requested length, and replaces `+` and `/` with URL-safe characters.

