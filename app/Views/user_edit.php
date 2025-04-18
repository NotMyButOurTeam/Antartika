<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <title>Edit Profile | Antartika</title>
    </head>
    <style>
    section {
        margin-top: 6vw;
        width: 712px;
    }

    section img {
        display: block;
        margin: auto;
        
        height: 215px;
        width: 215px;
        
        border-radius: 100%;

        cursor: pointer;
    }

    section img:hover {
        filter: sepia(20%) contrast(50%);
    }

    form {
        display: flex;
        margin: auto;
        margin-top: 64px;
        flex-direction: column;
        gap: 32px;
        width: 396px;
    }

    button {
        display: block;
        margin: auto;
        
        border-radius: 15pt;

        width: 256px;
        height: 32px;
    }

    textarea {
        text-align: justify;
        height: 128px;
    }
    </style>
    <body>
        <?= view("parts/header") ?>
        <section>
            <input type="file" id="userProfileDialog" style="display: none;" accept="image/jpeg, image/png">
            <img id="userProfileButton"
                src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", session()->get("id"))) ?> " 
                onerror="this.src='<?= base_url("noprof.png") ?>';">
            <form method="POST" id="userChangeForm">
                <input type="text" name="newName" value="<?= esc($name) ?>" 
                    style="font-size: 24pt;">
                <textarea name="newProfile" style="resize: none;"><?= esc($profile) ?></textarea>
                <input type="text" name="newEmail" value="<?= esc($email) ?>">
                <div>
                    <input style="width: 45%" type="password" name="oldPassword" placeholder="Old Password" autocomplete="off">
                    <input style="width: 45%" type="password" name="newPassword" placeholder="New Password" autocomplete="off">
                </div>
                <button>Save</button>
            </form>
            <?php if (session()->get("is_publisher") === false): ?>
            <form method="POST" action="elevateToPublisher">
                <button>Become Publisher</button>
            </form>
            <?php endif; ?>
        </section>
        <script>
        const userChangeForm = document.getElementById("userChangeForm");
        const userProfileDialog = document.getElementById("userProfileDialog");
        let userProfileButton = document.getElementById("userProfileButton");

        userProfileButton.addEventListener("click", () => {
            userProfileDialog.click();
        });

        userProfileDialog.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    userProfileButton.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        userChangeForm.addEventListener("submit", (e) => {
            e.preventDefault();

            let formData = new FormData(userChangeForm);
            if (userProfileDialog.files[0]) {
                formData.append("newProfile", userProfileDialog.files[0]);
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
        </script>
    </body>
</html>
