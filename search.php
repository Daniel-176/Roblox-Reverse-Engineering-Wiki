<?php
require_once __DIR__ . '/includes/functions.php';

$query = substr(trim($_GET['q'] ?? ''), 0, 200);
$pageTitle = $query ? "Search: $query" : 'Search';
require_once __DIR__ . '/templates/head.php';
require_once __DIR__ . '/templates/header.php';
?>

<h1>Search</h1>

<form action="search.php" method="get" class="search-form" style="margin-bottom:1.5em;">
    <input type="text" name="q" placeholder="Search articles..." value="<?= htmlspecialchars($query) ?>" style="width:400px;max-width:100%;">
    <button type="submit">Search</button>
</form>

<?php if ($query): ?>
    <h2>Results for "<?= htmlspecialchars($query) ?>"</h2>

    <?php
    $results = searchArticles($query);

    if (empty($results)):
    ?>
    <div class="no-results">No results found. Try a different search term.</div>
    <?php else: ?>
    <p>Found <strong><?= count($results) ?></strong> result(s):</p>

    <?php foreach ($results as $r): ?>
    <div class="search-result">
        <div class="result-title"><a href="<?= htmlspecialchars($r['url']) ?>"><?= htmlspecialchars($r['title']) ?></a></div>
        <div class="result-category"><?= htmlspecialchars($r['category']) ?> / <?= htmlspecialchars($r['subcategory'] ?? '') ?></div>
        <?php if (!empty($r['snippet'])): ?>
        <div class="result-snippet"><?= nl2br(htmlspecialchars($r['snippet'])) ?></div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
<?php else: ?>
    <p>Enter a search term above to find articles.</p>

    <h3>Browse by Category</h3>
    <?php
    $tree = getArticleTree();
    ?>
    <ul>
        <?php foreach ($tree as $cat => $info): ?>
        <li><strong><?= htmlspecialchars($info['label']) ?></strong>
            <ul>
            <?php foreach ($info['subs'] as $sub => $sinfo): ?>
                <li><?= htmlspecialchars($sinfo['label']) ?> (<?= count($sinfo['articles']) ?>)</li>
            <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
