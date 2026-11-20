<?php
require_once __DIR__ . '/includes/functions.php';

define('VAULT_DIR', __DIR__ . '/vault');

function formatSize(int $bytes): string {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $i = 0;
    $n = (float) $bytes;
    while ($n >= 1024 && $i < count($units) - 1) {
        $n /= 1024;
        $i++;
    }
    return ($i === 0 ? (string) $bytes : number_format($n, 1)) . ' ' . $units[$i];
}

function getVaultFiles(): array {
    $base = realpath(VAULT_DIR);
    if ($base === false) return [];

    $files = [];
    $it = new RecursiveIteratorIterator(
        new RecursiveCallbackFilterIterator(
            new RecursiveDirectoryIterator($base, FilesystemIterator::SKIP_DOTS),
            fn($f) => $f->getFilename()[0] !== '.'
        )
    );
    foreach ($it as $f) {
        if (!$f->isFile() || $f->isLink()) continue;
        if (preg_match('/\.(php|phtml|phar)$/i', $f->getFilename())) continue;

        $rel = str_replace('\\', '/', substr($f->getPathname(), strlen($base) + 1));
        $files[] = [
            'path' => $rel,
            'dir'  => dirname($rel) === '.' ? '' : dirname($rel),
            'name' => $f->getFilename(),
            'ext'  => strtolower($f->getExtension()),
            'size' => $f->getSize(),
            'time' => $f->getMTime(),
            'url'  => 'vault/' . implode('/', array_map('rawurlencode', explode('/', $rel))),
        ];
    }
    usort($files, fn($a, $b) => strcasecmp($a['path'], $b['path']));
    return $files;
}

$files = getVaultFiles();
$total = array_sum(array_column($files, 'size'));

$pageTitle = 'Vault';
require_once __DIR__ . '/templates/head.php';
require_once __DIR__ . '/templates/header.php';
?>

<h1>Vault</h1>

<p>Files kept here for later reference. Anything placed in the <code>vault/</code> folder shows up in this list.</p>

<?php if (empty($files)): ?>
<div class="no-results">The vault is empty.</div>
<?php else: ?>
<p><strong><?= count($files) ?></strong> file(s), <?= formatSize($total) ?> total.</p>

<form class="search-form" onsubmit="return false" style="margin-bottom:1em;">
    <input type="text" id="vault-filter" placeholder="Filter files..." autocomplete="off">
</form>

<div class="table-wrapper">
<table class="wikitable" id="vault-table">
    <tr><th>File</th><th>Folder</th><th>Type</th><th>Size</th><th>Modified</th></tr>
    <?php foreach ($files as $f): ?>
    <tr>
        <td><a href="<?= htmlspecialchars($f['url']) ?>"><?= htmlspecialchars($f['name']) ?></a></td>
        <td><?= htmlspecialchars($f['dir']) ?></td>
        <td><?= htmlspecialchars($f['ext'] ?: '-') ?></td>
        <td data-sort="<?= $f['size'] ?>"><?= formatSize($f['size']) ?></td>
        <td><?= date('Y-m-d', $f['time']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>

<script>
(function () {
    var input = document.getElementById('vault-filter');
    var rows = document.querySelectorAll('#vault-table tr:not(:first-child)');
    input.addEventListener('input', function () {
        var q = input.value.toLowerCase();
        rows.forEach(function (r) {
            r.style.display = r.textContent.toLowerCase().indexOf(q) === -1 ? 'none' : '';
        });
    });
})();
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
