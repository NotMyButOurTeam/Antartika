<header>
    <div>
        <a href="/"><p style="font-size: 18pt;">Antartika</p></a>
    </div>
    <form action="/app/search" class="search-form">
        <div>
            <input type="text" name="q" placeholder="Enter app name...">
            <button>→</button>
        </div>
    </form>
    <img id="profileButton"
        src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", session()->get("id"))) ?> " 
        onerror="this.src='<?= base_url("noprof.png") ?>';">
</header>
<?= view("parts/header_click") ?>
