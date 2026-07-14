<?php

define('ARTICLES_DIR', __DIR__ . '/../articles');

function getArticleTree(): array {
    $tree = [];
    $catLabels = [
        'client' => 'Client',
        'rccservice' => 'RCCService',
        'studio' => 'Studio',
        'infrastructure' => 'Infrastructure',
        'resources' => 'Resources',
        'misc' => 'Misc',
        'utilities' => 'Utilities',
        'knowledge' => 'Knowledge',
        ""
    ];
    $subLabels = [
        'windows' => 'Windows',
        'android' => 'Android',
        'ios' => 'iOS',
        'network' => 'Network',
        'site' => 'Site',
        'api' => 'API',
    ];

    $dirs = scandir(ARTICLES_DIR);
    foreach ($dirs as $cat) {
        if ($cat[0] === '.') continue;
        $catPath = ARTICLES_DIR . '/' . $cat;
        if (!is_dir($catPath)) continue;

        $tree[$cat] = [
            'label' => $catLabels[$cat] ?? ucfirst($cat),
            'subs' => [],
        ];

        $subDirs = scandir($catPath);
        foreach ($subDirs as $sub) {
            if ($sub[0] === '.') continue;
            $subPath = $catPath . '/' . $sub;
            if (!is_dir($subPath)) {
                if (!str_ends_with($sub, '.md')) continue;
                $name = pathinfo($sub, PATHINFO_FILENAME);
                $title = ucwords(str_replace(['-', '_'], ' ', preg_replace('/^\d+-/', '', $name)));
                $content = file_get_contents($subPath);
                $outlink = str_contains($content, '*Outlink*');
                $desc = extractDescription($subPath);
                $path = urlencode("$cat/$name");
                $tree[$cat]['subs']['_root'][] = [
                    'file' => $sub,
                    'title' => $title,
                    'url' => "article.php?path=$path",
                    'outlink' => $outlink,
                    'description' => $desc,
                ];
                continue;
            }

            $articles = [];
            $files = scandir($subPath);
            foreach ($files as $f) {
                if ($f[0] === '.' || !str_ends_with($f, '.md')) continue;
                $name = pathinfo($f, PATHINFO_FILENAME);
                $title = ucwords(str_replace(['-', '_'], ' ', preg_replace('/^\d+-/', '', $name)));
                $fp = $subPath . '/' . $f;
                $content = file_get_contents($fp);
                $outlink = str_contains($content, '*Outlink*');
                $desc = extractDescription($fp);
                $path = "$cat/$sub/$name";
                $articles[] = [
                    'file' => $f,
                    'title' => $title,
                    'url' => "article.php?path=" . urlencode($path),
                    'outlink' => $outlink,
                    'description' => $desc,
                ];
            }

            if (!empty($articles)) {
                usort($articles, fn($a, $b) => strcmp($a['title'], $b['title']));
                $tree[$cat]['subs'][$sub] = [
                    'label' => $subLabels[$sub] ?? ucfirst($sub),
                    'articles' => $articles,
                ];
            }
        }

        if (!empty($tree[$cat]['subs']['_root'])) {
            usort($tree[$cat]['subs']['_root'], fn($a, $b) => strcmp($a['title'], $b['title']));
            $tree[$cat]['subs']['_root'] = [
                'label' => 'General',
                'articles' => $tree[$cat]['subs']['_root'],
            ];
        }
    }

    return $tree;
}

function getAllArticles(): array {
    static $all = null;
    if ($all !== null) return $all;
    $all = [];
    $tree = getArticleTree();
    foreach ($tree as $cat => $info) {
        foreach ($info['subs'] as $sub => $sinfo) {
            foreach ($sinfo['articles'] as $a) {
                $a['category'] = $info['label'];
                $a['subcategory'] = $sinfo['label'];
                $all[] = $a;
            }
        }
    }
    usort($all, fn($a, $b) => strcmp($a['title'], $b['title']));
    return $all;
}

function searchArticles(string $query): array {
    $q = strtolower($query);
    $results = [];
    foreach (getAllArticles() as $a) {
        $titleMatch = str_contains(strtolower($a['title']), $q);
        $catMatch = str_contains(strtolower($a['category']), $q);

        $content = '';
        $params = [];
        parse_str(parse_url($a['url'], PHP_URL_QUERY) ?: '', $params);
        if (!empty($params['path'])) {
            $fp = ARTICLES_DIR . '/' . $params['path'] . '.md';
            if (file_exists($fp)) $content = strtolower(file_get_contents($fp));
        }
        $contentMatch = str_contains($content, $q);

        if ($titleMatch || $catMatch || $contentMatch) {
            $a['relevance'] = ($titleMatch ? 10 : 0) + ($catMatch ? 3 : 0) + ($contentMatch ? 1 : 0);
            $a['snippet'] = '';
            if ($content) {
                $pos = strpos($content, $q);
                if ($pos !== false) {
                    $start = max(0, $pos - 100);
                    $snippet = substr($content, $start, 250);
                    if ($start > 0) $snippet = '...' . $snippet;
                    $a['snippet'] = substr($snippet, 0, 250) . '...';
                }
            }
            $results[] = $a;
        }
    }
    usort($results, fn($a, $b) => $b['relevance'] - $a['relevance']);
    return $results;
}

function getCategoryIcon(string $cat): string {
    return '';
}

function getSubIcon(string $sub): string {
    return '';
}

function extractDescription(string $filePath): string {
    $content = file_get_contents($filePath);
    $lines = explode("\n", $content);
    foreach ($lines as $line) {
        $trimmed = trim($line);
        if ($trimmed === '' || str_starts_with($trimmed, '#') || str_starts_with($trimmed, '*Outlink*') || str_starts_with($trimmed, '*Credits:') || str_starts_with($trimmed, '|') || str_starts_with($trimmed, '-') || str_starts_with($trimmed, '>')) {
            continue;
        }
        if (str_starts_with($trimmed, '*Description:')) {
            return trim(substr($trimmed, strlen('*Description:')));
        }
        $desc = strip_tags($trimmed);
        $desc = preg_replace('/\*\*(.+?)\*\*/', '$1', $desc);
        $desc = preg_replace('/\*(.+?)\*/', '$1', $desc);
        $desc = preg_replace('/`(.+?)`/', '$1', $desc);
        $desc = preg_replace('/\[([^\]]+)\]\([^)]+\)/', '$1', $desc);
        $desc = preg_replace('/<[^>]+>/', '', $desc);
        if (strlen($desc) > 150) $desc = substr($desc, 0, 147) . '...';
        return trim($desc);
    }
    return '';
}
