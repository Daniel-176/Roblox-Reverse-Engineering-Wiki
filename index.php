<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/templates/credits.php';
$pageTitle = 'Main Page';
require_once __DIR__ . '/templates/head.php';
require_once __DIR__ . '/templates/header.php';

$articles = getAllArticles();
$tree = getArticleTree();
?>

<div class="welcome-box">
    <h1>Welcome to the Roblox Reverse Engineering Wiki</h1>
    <p>A collection of ORC guides and reverse engineering notes for Roblox revival projects and private use.</p>
    <p>This wiki contains <strong><?= count($articles) ?></strong> articles.</p>

    <div class="links">
        <p><a href="guides.zip" class="download-link">Download All Source Guides (ZIP)</a></p>
        <p><a href="vault.php" class="download-link">Vault (reference files)</a></p>
        <p><a href="https://github.com/Daniel-176/Roblox-Reverse-Engineering-Wiki" class="download-link">Site source code (with articles)</a></p>
    </div>

    <div class="stat-box">
        <div class="stat-item">
            <div class="stat-number"><?= count($articles) ?></div>
            <div class="stat-label">Articles</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><?= count($tree) ?></div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
</div>

<div id="contributors-section">
    <h2 id="contributors-toggle">Contributors</h2>
    <p class="contributors-intro">Click a name to see their articles.</p>

    <div class="contributor-grid" id="contributor-grid">
        <?php
        $contributorData = [];
        foreach ($contributorMapping as $name => $articles) {
            $list = [];
            foreach ($articles as $p) {
                $list[] = ['url' => contributorPathUrl($p), 'title' => contributorPathTitle($p)];
            }
            $contributorData[$name] = $list;
        }
        ?>
        <?php foreach ($contributorMapping as $name => $articles): ?>
        <span class="contributor-name-item" data-name="<?= htmlspecialchars($name, ENT_QUOTES) ?>"><?= htmlspecialchars($name) ?></span>
        <?php endforeach; ?>
    </div>
    <div id="contributor-tooltip" class="hidden"></div>
</div>

<script>
(function() {
    const toggle = document.getElementById('contributors-toggle');
    const section = document.getElementById('contributors-section');
    toggle.addEventListener('click', () => {
        const hidden = toggle.classList.toggle('collapsed');
        section.querySelector('.contributor-grid').style.display = hidden ? 'none' : '';
        section.querySelector('.contributors-intro').style.display = hidden ? 'none' : '';
    });
})();

const contributorData = <?= json_encode($contributorData) ?>;

(function() {
    const grid = document.getElementById('contributor-grid');
    const items = Array.from(grid.querySelectorAll('.contributor-name-item'));
    const tooltip = document.getElementById('contributor-tooltip');
    let hovered = null;
    let rafId = null;

    function pushAway() {
        if (!hovered) return;
        const hRect = hovered.getBoundingClientRect();
        const hcx = hRect.left + hRect.width / 2;
        const hcy = hRect.top + hRect.height / 2;

        for (const other of items) {
            if (other === hovered) {
                other.style.transform = 'scale(1.35)';
                other.style.setProperty('--weight', '700');
                other.style.setProperty('--color', '#3366cc');
                continue;
            }
            const oRect = other.getBoundingClientRect();
            const ocx = oRect.left + oRect.width / 2;
            const ocy = oRect.top + oRect.height / 2;

            const dx = ocx - hcx;
            const dy = ocy - hcy;
            const dist = Math.sqrt(dx * dx + dy * dy);

            const maxPush = 100;
            const falloff = 3.5;
            const push = Math.max(0, maxPush - dist / falloff);

            if (push > 1) {
                const angle = Math.atan2(dy, dx);
                const px = Math.cos(angle) * push;
                const py = Math.sin(angle) * push;
                other.style.transform = 'translate(' + px.toFixed(1) + 'px,' + py.toFixed(1) + 'px)';
            } else {
                other.style.transform = '';
            }
            other.style.setProperty('--weight', '400');
            other.style.setProperty('--color', '');
        }
    }

    function resetAll() {
        for (const other of items) {
            other.style.transform = '';
            other.style.setProperty('--weight', '400');
            other.style.setProperty('--color', '');
        }
    }

    for (const item of items) {
        item.addEventListener('mouseenter', () => {
            hovered = item;
            tooltip.classList.add('hidden');
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(pushAway);
        });

        item.addEventListener('mousemove', () => {
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(pushAway);
        });

        item.addEventListener('mouseleave', () => {
            hovered = null;
            if (rafId) cancelAnimationFrame(rafId);
            resetAll();
        });

        item.addEventListener('click', function(e) {
            e.stopPropagation();
            const name = this.getAttribute('data-name');
            const arts = contributorData[name];
            if (!arts || arts.length === 0) return;

            const rect = this.getBoundingClientRect();
            const scrollX = window.scrollX || window.pageXOffset;
            const scrollY = window.scrollY || window.pageYOffset;

            let html = '<div class="tip-arrow"></div><ul>';
            for (const a of arts) {
                html += '<li><a href="' + a.url + '">' + a.title + '</a></li>';
            }
            html += '</ul>';

            tooltip.innerHTML = html;
            tooltip.style.left = Math.min(rect.left + scrollX, window.innerWidth - 320) + 'px';
            tooltip.style.top = (rect.bottom + scrollY + 6) + 'px';
            tooltip.classList.remove('hidden');
        });
    }

    document.addEventListener('click', function(e) {
        if (!tooltip.contains(e.target) && !e.target.closest('.contributor-name-item')) {
            tooltip.classList.add('hidden');
        }
    });
})();
</script>

<h2>Categories</h2>

<div class="category-grid">
    <?php foreach ($tree as $cat => $info): ?>
    <div class="category-card">
        <h3><a href="category.php?cat=<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($info['label']) ?></a></h3>
        <?php foreach ($info['subs'] as $sub => $sinfo): ?>
        <h4><?= htmlspecialchars($sinfo['label']) ?></h4>
        <ul>
            <?php foreach ($sinfo['articles'] as $a): ?>
            <li><a href="<?= htmlspecialchars($a['url']) ?>"<?= !empty($a['outlink']) ? ' class="outlink"' : '' ?>><?= htmlspecialchars($a['title']) ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
        <div class="article-count">
            <?php
            $count = 0;
            foreach ($info['subs'] as $sinfo) $count += count($sinfo['articles']);
            echo "$count article(s)";
            ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
