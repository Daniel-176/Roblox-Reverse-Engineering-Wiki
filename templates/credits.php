<?php
$creditsGuideAuthors = [
    'meditation/meditexts', 'Powdered', 'waterboi/watrabi', 'Jetray', 'Aep', 'Karma',
    'valley', 'nukley', 'h6di', 'VMsLover', 'shikataganai', 'mssky',
    'DoggoITA', 'ARC', 'zfut', 'SomeoneInTheWorld', 'Atomic', 'dxf',
    'katoe_real', 'simple the dimple', 'hadi', 'Crypt', 'Rocky', 'matt',
    'table', 'la', 'vmware', 'ethanm2502', 'guideofsmth',
    'iknowidontexistbutwhatifwin', 'BrentDaMage', 'vanilla', 'cub',
    'VisualPlugin', 'neva',
];

$creditsResourceContributors = [
    'Yakov5776', 'SonicGamingTV2019', '✝️ Silicon ✝️', 'LuaWiz',
    'NukaWorks Solutions', 'Ranged222', 'juliaoverflow',
];

$creditsPrimarySources = ['ORC guide server community', 'lrre.wiki'];

$contributorMapping = [
    'meditation/meditexts' => ['client/android/meditation-guide', 'client/android/compiler-guide', 'client/android/149-fix', 'client/windows/2015', 'rccservice/windows/not-expiring-jobs', 'knowledge/general-tips'],
    'Powdered' => ['client/windows/powdered-guide', 'knowledge/general-tips'],
    'waterboi/watrabi' => ['client/windows/waterboi-guide', 'knowledge/general-tips'],
    'Jetray' => ['client/windows/waterboi-guide', 'client/windows/2021', 'knowledge/general-tips'],
    'Aep' => ['client/windows/2018', 'client/windows/2018-plus', 'knowledge/general-tips'],
    'Karma' => ['infrastructure/api/games-relay', 'knowledge/general-tips'],
    'valley' => ['client/windows/2011', 'knowledge/general-tips'],
    'nukley' => ['client/windows/2010', 'client/windows/2011', 'knowledge/general-tips'],
    'h6di' => ['rccservice/windows/2015', 'knowledge/general-tips'],
    'VMsLover' => ['resources/gt2-stuff-archive', 'client/windows/2014-crash-fix', 'client/windows/2018-plus', 'knowledge/general-tips'],
    'shikataganai' => ['client/windows/2018-plus', 'knowledge/general-tips'],
    'mssky' => ['client/android/mssky-guide', 'client/ios/general', 'knowledge/general-tips'],
    'DoggoITA' => ['client/android/2018-plus', 'knowledge/general-tips'],
    'ARC' => ['client/android/arc-mobile-guide', 'knowledge/general-tips'],
    'zfut' => ['infrastructure/api/gamepass', 'knowledge/general-tips'],
    'SomeoneInTheWorld' => ['misc/save-place-remove', 'infrastructure/api/joinscript', 'knowledge/general-tips'],
    'Atomic' => ['utilities/lua-scripts', 'knowledge/general-tips'],
    'dxf' => ['knowledge/compile-sixteensrc', 'client/windows/2011', 'knowledge/general-tips'],
    'katoe_real' => ['knowledge/compile-sixteensrc', 'knowledge/general-tips'],
    'simple the dimple' => ['knowledge/compile-robloxsrc', 'knowledge/general-tips'],
    'hadi' => ['knowledge/compile-robloxsrc', 'knowledge/general-tips'],
    'Crypt' => ['knowledge/compile-robloxsrc'],
    'Rocky' => ['client/windows/2011'],
    'matt' => ['client/windows/2011'],
    'table' => ['client/windows/2016'],
    'la' => ['infrastructure/api/games-relay'],
    'vmware' => ['infrastructure/api/thumbnails'],
    'ethanm2502' => ['infrastructure/api/gamepass'],
    'guideofsmth' => ['studio/windows/hosting'],
    'iknowidontexistbutwhatifwin' => ['infrastructure/site/redirect-assets', 'client/windows/2021'],
    'BrentDaMage' => ['rccservice/windows/how2rcc'],
    'vanilla' => ['rccservice/windows/2015'],
    'cub' => ['client/windows/2013'],
    'VisualPlugin' => ['client/windows/2018-plus'],
    'neva' => ['client/placelauncher-status'],
    'Yakov5776' => ['resources/ultimate-mobile-archive'],
    'SonicGamingTV2019' => ['resources/ultimate-mobile-archive'],
    '✝️ Silicon ✝️' => ['resources/version-spreadsheets'],
    'LuaWiz' => ['resources/version-spreadsheets'],
    'NukaWorks Solutions' => ['resources/gt2-stuff-archive'],
    'Ranged222' => ['knowledge/rblx-subdomain-list', 'infrastructure/network/subdomain-prevalence'],
    'juliaoverflow' => ['knowledge/roblox-web-apis', 'infrastructure/api/web-api-subdomains', 'infrastructure/api/thumbnails-web-api'],
];

function contributorPathTitle(string $path): string {
    $name = basename($path);
    $name = preg_replace('/^\d+-/', '', $name);
    $name = str_replace(['-', '_'], ' ', $name);
    return ucwords($name);
}

function contributorPathUrl(string $path): string {
    return 'article.php?path=' . urlencode($path);
}
