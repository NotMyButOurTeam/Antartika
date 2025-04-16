<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?= base_url('reset.css') ?>">
        <title>Submit Your App</title>
        <style>
        body {
            position: relative;
            margin: auto;
            margin-top:    6vw;
            margin-bottom: 6vw;
            width: 720px;
        }

        .root-form {
            width: 100%;
            
            display: flex;
            flex-wrap: wrap;
            gap: 12px;

            margin: auto;
            margin-top: 120px;
        }

        .root-form > form {
            width: 65%;
        }

        .root-form div {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .root-form img {
            width: 128px;
            height: auto;

            border: 2px solid black;
            border-radius: 8px;

            object-fit: cover;
            cursor: pointer;
        }

        .root-form img:hover {
            filter: sepia(50%) contrast(80%);
        }
        </style>
    </head>
    <body>
        <h1 style="text-align: center; font-size: 24pt;">Submit Your App</h1>
        <div class="root-form">
            <form id="appForm" onkeydown="if(event.key === 'Enter'){event.stopPropagation();}">
                <div>
                    <label for="appTitle">Title</label>
                    <input type="text" id="appTitle" name="appTitle" autocomplete="off" required autofocus><br>
                    <label for="appDescription">Description</label>
                    <textarea style="resize: none;" id="appDescription" name="appDescription" required rows="24"></textarea><br>
                    <label for="appTags">Tags</label>
                    <input type="text" id="appTags" name="appTags" autocomplete="off" autofocus><br>
                </div>
                <button id="appSubmit">Submit</button>
            </form>
            <div>
                <label for="appIcon">Icon</label><br>
                <input type="file" id="appIconDialog" style="display: none;" accept="image/jpeg, image/png">
                <img id="appIconView" style="height: 128px;" src="<?= base_url("noicon.png") ?>">

                <label for="appPreview">Preview</label><br>
                <input type="file" id="appPreview" accept="image/jpeg, image/png" multiple><br>
                <ul id="appPreviewView" sytle="list-style-type: none; padding-left: 0;">
                <ul>
            </div>
        <div>
        <script>
        const appPreview = document.getElementById("appPreview");
        const appIconView = document.getElementById("appIconView");
        const appIconDialog = document.getElementById("appIconDialog");
        const appPreviewView = document.getElementById("appPreviewView");
        const appForm = document.getElementById("appForm");
        let appPreviews = [ ];

        if (appIconDialog) {
            appIconDialog.addEventListener("change", (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        appIconView.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        if (appIconView) {
            appIconView.addEventListener("click", () => {
                if (appIconDialog) {
                    appIconDialog.click();
                }
            });
        }

        if (appPreview) {
            appPreview.addEventListener("change", (event) => {
                if (appPreviewView) {
                    for (let i = 0; i < event.target.files.length; ++i) {
                        const file = event.target.files[i];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                let li = document.createElement("li");
                                let img = document.createElement("img");
                                img.src = e.target.result;
                                li.appendChild(img);
                                appPreviewView.appendChild(li);
                            };
                            reader.readAsDataURL(file);
                            appPreviews.push(file);
                        }
                    }
                }
                appPreview.value = '';
            });
        }

        if (appForm) {
            appForm.addEventListener("submit", (event) => {
                event.preventDefault();

                let formData = new FormData(appForm);
                if (appIconDialog.files[0]) {
                    formData.append("appIcon", appIconDialog.files[0]);
                }
                for (let i = 0; i < appPreviews.length; ++i) {
                    formData.append("appPreviews[]", appPreviews[i]);
                }

                fetch(window.location.href, {
                    method: "POST",
                    body: formData
                }).then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    }
                });
            });
        }
        </script>
    </body>
</html>
