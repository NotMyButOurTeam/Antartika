<section>
    <link rel="stylesheet" href="<?= base_url("styles/publish.css") ?>">
    <div class="publish-app-container">
        <h2>Publish Your App</h2>
        <form class="publish-app-form" method="post" enctype="multipart/form-data">
            <input type="file" id="appIconFile" name="appIconFile" style="display: none;" accept="image/png, image/jpeg" required/>
            <div>
                <label for="appIconPrev">App Icon</label><br>
                <img id="appIconPrev" src="" onerror="this.src='<?= base_url("uploads/apps/icons/00000.png") ?>';">
            </div>
            <div>
                <label for="appName">App Name</label><br>
                <input type="text" id="appName" name="appName" required>
            </div>
            <div>
                <label for="appDescription">App Description</label><br>
                <textarea id="appDescription" name="appDescription" required></textarea>
            </div>
            <div>
                <label for="appCategory">App Category</label><br>
                <select id="appCategory" name="appCategory" required>
                    <option value="0">Audio</option>
                    <option value="1">Developer Tools</option>
                    <option value="2">Education</option>
                    <option value="3">Games</option>
                    <option value="4">Graphics & Photography</option>
                    <option value="5">Networking</option>
                    <option value="6">Productivity</option>
                    <option value="7">Science</option>
                    <option value="8">System</option>
                    <option value="9">Utilities</option>
                </select>
            </div>
            <button id="appPublishButton">Publish</button>
        </form>
    </div>
    <script src="<?= base_url("scripts/publish.js") ?>"></script>
</section>
