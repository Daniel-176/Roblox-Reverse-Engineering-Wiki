<?php
require_once __DIR__ . '/includes/functions.php';

$rawPath = $_GET['path'] ?? '';

$path = sanitizeArticlePath($rawPath);
if ($path === null) {
    http_response_code(400);
    $pageTitle = 'Invalid Path';
    require_once __DIR__ . '/templates/head.php';
    require_once __DIR__ . '/templates/header.php';
    echo '<h1>Invalid Path</h1>';
    echo '<p>The requested article path contains invalid characters.</p>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
    require_once __DIR__ . '/templates/footer.php';
    exit;
}

$mdFile = resolveArticlePath($path);
if ($mdFile === null || !file_exists($mdFile)) {
    http_response_code(404);
    $pageTitle = 'Article Not Found';
    require_once __DIR__ . '/templates/head.php';
    require_once __DIR__ . '/templates/header.php';
    echo '<h1>Article Not Found</h1>';
    echo '<p>The requested article could not be found.</p>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
    require_once __DIR__ . '/templates/footer.php';
    exit;
}

$raw = file_get_contents($mdFile);

preg_match('/^# (.+)$/m', $raw, $titleMatch);
$pageTitle = $titleMatch[1] ?? ucwords(str_replace(['-', '_'], ' ', basename($path)));

$description = extractDescription($mdFile);

require_once __DIR__ . '/templates/head.php';
require_once __DIR__ . '/templates/header.php';

[$before, $tabHtml, $after, $hasTabs] = renderWithTabs($raw);
$html = renderMarkdown($before) . $tabHtml . renderMarkdown($after);
echo '<div class="article-content">';
if ($description) {
    echo '<div class="article-description">' . htmlspecialchars($description) . '</div>';
}
echo $html;
echo '</div>';

echo '<hr><p><a href="index.php">Back to Main Page</a></p>';

if ($hasTabs) {
    echo '<script src="js/tabs.js"></script>';
}

require_once __DIR__ . '/templates/footer.php';

function sanitizeArticlePath(string $input): ?string {
    if ($input === '') return null;
    $input = str_replace('\\', '/', $input);
    $parts = explode('/', $input);
    foreach ($parts as $part) {
        if ($part === '..' || $part === '.' || $part === '') return null;
    }
    if (preg_match('/[^\w\-\/]/', $input)) return null;
    return $input;
}

function resolveArticlePath(string $path): ?string {
    $base = realpath(__DIR__ . '/articles');
    if ($base === false) return null;
    $resolved = realpath($base . '/' . $path . '.md');
    if ($resolved === false) return null;
    if (!str_starts_with($resolved, $base)) return null;
    if (!str_ends_with($resolved, '.md')) return null;
    return $resolved;
}

function extractLinks(string $line): array {
    $links = [];
    $line = preg_replace_callback('/<([^\s<>]+)>/', function($m) use (&$links) {
        $links[] = $m[1];
        return "\x00LINK" . (count($links)-1) . "\x00";
    }, $line);
    $line = preg_replace_callback('/\[([^\]]+)\]\(((?:https?:\/\/)?[^)]+)\)/', function($m) use (&$links) {
        $links[] = [$m[1], $m[2]];
        return "\x00MDLINK" . (count($links)-1) . "\x00";
    }, $line);
    return [$line, $links];
}

function restoreLinks(string $text, array $links): string {
    foreach ($links as $i => $link) {
        $placeholder = "\x00" . (is_array($link) ? "MDLINK$i" : "LINK$i") . "\x00";
        if (is_array($link)) {
            $href = htmlspecialchars($link[1]);
            $class = str_starts_with($link[1], 'Resources/') ? ' class="download-link"' : '';
            $text = str_replace($placeholder, '<a href="' . $href . '"' . $class . '>' . htmlspecialchars($link[0]) . '</a>', $text);
        } else {
            $href = htmlspecialchars($link);
            $class = str_starts_with($link, 'Resources/') ? ' class="download-link"' : '';
            $text = str_replace($placeholder, '<a href="' . $href . '"' . $class . '>' . htmlspecialchars($link) . '</a>', $text);
        }
    }
    return $text;
}

function inlineMarkdown(string $text): string {
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);
    $text = preg_replace('/`(.+?)`/', '<code>$1</code>', $text);
    return $text;
}

function processInline(string $raw): string {
    [$withPlaceholders, $links] = extractLinks($raw);
    $escaped = htmlspecialchars($withPlaceholders);
    $rendered = inlineMarkdown($escaped);
    return restoreLinks($rendered, $links);
}

function renderWithTabs(string $raw): array {
    if (!str_contains($raw, '*Tabs*')) return [$raw, '', '', false];
    $before = '';
    $after = '';
    $tabLabels = [];
    $tabContents = [];
    $tabBuffer = '';
    $inTabs = false;
    $tabsDone = false;
    $lines = explode("\n", $raw);

    foreach ($lines as $line) {
        $trimmed = trim($line);
        if ($trimmed === '*Tabs*') {
            $inTabs = true;
            $tabLabels = [];
            $tabContents = [];
            $tabBuffer = '';
            continue;
        }
        if ($trimmed === '*TabsEnd*') {
            if (trim($tabBuffer) !== '') $tabContents[] = $tabBuffer;
            $inTabs = false;
            $tabsDone = true;
            continue;
        }
        if ($inTabs) {
            if (preg_match('/^##\s+(.+)/', $line, $m)) {
                if (trim($tabBuffer) !== '') $tabContents[] = $tabBuffer;
                $tabLabels[] = trim($m[1]);
                $tabBuffer = '';
            } else {
                $tabBuffer .= $line . "\n";
            }
        } elseif (!$tabsDone) {
            $before .= $line . "\n";
        } else {
            $after .= $line . "\n";
        }
    }

    $tabHtml = '';
    if (!empty($tabLabels)) {
        $tabHtml .= '<div class="tab-container"><div class="tab-nav">';
        foreach ($tabLabels as $i => $label) {
            $active = $i === 0 ? ' active' : '';
            $escaped = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');
            $tabHtml .= '<button class="tab-btn' . $active . '" data-tab="' . $i . '">' . $escaped . '</button>';
        }
        $tabHtml .= '</div>';
        foreach ($tabContents as $i => $content) {
            $active = $i === 0 ? ' active' : '';
            $tabHtml .= '<div class="tab-panel' . $active . '" data-tab="' . $i . '">' . renderMarkdown($content) . '</div>';
        }
        $tabHtml .= '</div>';
    }

    return [$before, $tabHtml, $after, true];
}

function renderMarkdown(string $raw): string {
    $lines = explode("\n", $raw);
    $html = '';
    $inCodeBlock = false;
    $codeContent = '';
    $codeLang = '';
    $codeIndent = 0;
    $inList = false;
    $listType = '';
    $inBlockquote = false;
    $inTable = false;
    $pendingHeader = null;

    $closeTable = function() use (&$html, &$inTable, &$pendingHeader) {
        if ($inTable) { $html .= "</table></div>\n"; $inTable = false; $pendingHeader = null; }
        $pendingHeader = null;
    };

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if (preg_match('/^( *)```(\w*)\s*$/', $line, $m)) {
            if ($inCodeBlock) {
                $code = htmlspecialchars($codeContent);
                $html .= "<pre><code" . ($codeLang ? " class=\"language-" . htmlspecialchars($codeLang) . "\"" : '') . ">$code</code></pre>\n";
                $codeContent = '';
                $codeLang = '';
                $inCodeBlock = false;
            } else {
                if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
                $inCodeBlock = true;
                $codeLang = $m[2];
                $codeIndent = strlen($m[1]);
            }
            continue;
        }
        if ($inCodeBlock) {
            $codeContent .= preg_replace('/^ {0,' . $codeIndent . '}/', '', $line) . "\n";
            continue;
        }

        if ($trimmed === '') {
            $closeTable();
            if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $html .= "<br>\n";
            continue;
        }

        if (str_starts_with($trimmed, '*Description:')) {
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            continue;
        }

        if (str_starts_with($trimmed, '> ')) {
            $closeTable();
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            if (!$inBlockquote) { $html .= "<blockquote>\n"; $inBlockquote = true; }
            $html .= "<p>" . processInline(substr($trimmed, 2)) . "</p>\n";
            continue;
        }
        if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }

        if (preg_match('/^(#{1,6})\s(.+)/', $line, $m)) {
            $closeTable();
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $level = strlen($m[1]);
            $text = htmlspecialchars(trim($m[2]));
            $id = preg_replace('/[^a-z0-9]+/', '-', strtolower($text));
            $html .= "<h$level id=\"$id\">$text<a class=\"anchor\" href=\"#$id\" title=\"Permalink\">#</a></h$level>\n";
            continue;
        }

        if (preg_match('/^[-*]\s(.+)/', $line, $m) && !preg_match('/^\*.*\*$/', $line)) {
            $closeTable();
            if ($inList && $listType !== 'ul') { $html .= "</ol>\n<ul>\n"; $listType = 'ul'; }
            if (!$inList) { $html .= "<ul>\n"; $inList = true; $listType = 'ul'; }
            $html .= "<li>" . processInline(trim($m[1])) . "</li>\n";
            continue;
        }

        if (preg_match('/^\d+[.)]\s(.+)/', $line, $m)) {
            if ($inList && $listType !== 'ol') { $html .= "</ul>\n<ol>\n"; $listType = 'ol'; }
            if (!$inList) { $html .= "<ol>\n"; $inList = true; $listType = 'ol'; }
            $html .= "<li>" . processInline(trim($m[1])) . "</li>\n";
            continue;
        }

        if (preg_match('/^---+$/', $trimmed) || preg_match('/^\*\*\*+$/', $trimmed)) {
            $closeTable();
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $html .= "<hr>\n";
            continue;
        }

        if (preg_match('/^\|(.+)\|$/', $line, $m)) {
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $cells = array_map('trim', explode('|', $m[1]));
            if (preg_match('/^[-| :]+$/', $cells[0] ?? '')) {
                if ($pendingHeader !== null) {
                    $html .= "<div class=\"table-wrapper\"><table class=\"wikitable\">\n";
                    $html .= "<tr><th>" . implode('</th><th>', $pendingHeader) . "</th></tr>\n";
                    $inTable = true;
                    $pendingHeader = null;
                }
                continue;
            }
            $cellContent = array_map(fn($c) => processInline(trim($c)), $cells);
            if (!$inTable) {
                if ($pendingHeader === null) {
                    $pendingHeader = $cellContent;
                    continue;
                } else {
                    $html .= "<div class=\"table-wrapper\"><table class=\"wikitable\">\n";
                    $html .= "<tr><td>" . implode('</td><td>', $pendingHeader) . "</td></tr>\n";
                    $html .= "<tr><td>" . implode('</td><td>', $cellContent) . "</td></tr>\n";
                    $inTable = true;
                    $pendingHeader = null;
                }
            } else {
                $html .= "<tr><td>" . implode('</td><td>', $cellContent) . "</td></tr>\n";
            }
            continue;
        }

        if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
        $closeTable();

        $html .= "<p>" . processInline($line) . "</p>\n";
    }

    if ($inCodeBlock) {
        $code = htmlspecialchars($codeContent);
        $html .= "<pre><code" . ($codeLang ? " class=\"language-" . htmlspecialchars($codeLang) . "\"" : '') . ">$code</code></pre>\n";
    }
    $closeTable();
    if ($inList) $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n";
    if ($inBlockquote) $html .= "</blockquote>\n";

    return $html;
}
