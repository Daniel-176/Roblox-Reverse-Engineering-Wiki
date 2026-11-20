<div id="content" class="mw-body">
    <div id="sidebar">
        <div id="logo">
            <a href="index.php">
                <img src="css/favicon.ico" alt="W" style="width:32px;height:32px;border:none;">
            </a>
        </div>
        <div class="sidebar-title">RREW</div>
        <div class="sidebar-tagline">Roblox Reverse Engineering Wiki</div>
        <hr>
        <ul class="sidebar-nav">
            <li><a href="index.php">Main Page</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="vault.php">Vault</a></li>
            <li><a href="guides.zip">Download All Guides</a></li>
        </ul>
        <hr>
        <div class="sidebar-cat-title">Categories</div>
        <ul class="sidebar-nav sidebar-cats">
            <?php
            $tree = getArticleTree();
            foreach ($tree as $catKey => $catInfo):
            ?>
            <li><a href="category.php?cat=<?= htmlspecialchars($catKey) ?>"><?= htmlspecialchars($catInfo['label']) ?></a></li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <div class="sidebar-stats">
            <strong><?= count(getAllArticles()) ?></strong> articles
        </div>
    </div>
    <div id="main-content">
        <div id="topbar">
            <form action="search.php" method="get" class="search-form">
                <input type="text" name="q" placeholder="Search wiki..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                <button type="submit">Search</button>
            </form>
            <div class="topbar-links">
                <a href="index.php">Home</a>
                <a href="search.php">Search</a>
                <a href="vault.php">Vault</a>
            </div>
        </div>
        <div id="bodyContent">

<div class="notice notice-info">
    <strong>Credits:</strong> every article names its original author(s). <a href="#" onclick="document.getElementById('credits-modal').style.display='flex'; return false;">View all credits</a>
</div>

<?php require_once __DIR__ . '/credits.php'; ?>
<div id="credits-modal" class="modal-overlay" onclick="if(event.target===this)this.style.display='none'">
    <div class="modal-content">
        <span class="modal-close" onclick="document.getElementById('credits-modal').style.display='none'">&times;</span>
        <h2>Credits</h2>
        <p>Every article names its original author(s).</p>
        <h3>Primary Sources</h3>
        <p><?= htmlspecialchars(implode(', ', $creditsPrimarySources)) ?></p>
        <h3>Guide Authors</h3>
        <p><?= htmlspecialchars(implode(', ', $creditsGuideAuthors)) ?></p>
        <h3>Archive &amp; Resource Contributors</h3>
        <p><?= htmlspecialchars(implode(', ', $creditsResourceContributors)) ?></p>
        <h3>References</h3>
        <p>lrre.wiki archive (<a href="https://web.archive.org/web/20220000000000*/https://lrre.wiki/">Wayback Machine</a>), Ranged222 (<a href="https://github.com/Ranged222/RobloxSubDomainList">subdomain enumeration</a>), juliaoverflow and matthewdean (<a href="https://github.com/juliaoverflow/roblox-web-apis">web API documentation</a>)</p>
    </div>
</div>
