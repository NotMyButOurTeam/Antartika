let profileEditOverlay = document.getElementById("profileEditOverlay");

let accountNameButton = document.getElementById("accountNameButton");
let accountEmailButton = document.getElementById("accountEmailButton");
let profileImageButton = document.getElementById("profileImage");
let changePasswordButton = document.getElementById("changePasswordButton");

const editPencil = "  <i class='icon-small hn hn-pencil-solid'></i>";

function closeOverlay()
{
    profileEditOverlay.style.display = "none";
    profileEditOverlay.innerHTML = "";
}

if (accountNameButton) {
    const originalValue = accountNameButton.innerHTML;
    accountNameButton.addEventListener("mouseenter", () => {
        accountNameButton.innerHTML += editPencil;
    });
    accountNameButton.addEventListener("mouseleave", () => {
        accountNameButton.innerHTML = originalValue;
    });

    accountNameButton.addEventListener("click", () => {
        profileEditOverlay.innerHTML = `
<div class="profile-edit-box">
    <div class="profile-edit-box-title">
        <h2>Edit Name</h2>
        <p onclick="closeOverlay()" class="clickable" style="font-weight: bold;"><i class="hn hn-times-solid"></i></p>
    </div>
    <form method="post">
        <label for="newName">New Name </label>
        <input class="profile-edit-input-text" type="text" id="newName" name="newName" placeholder="Enter new name...">
        <input type="submit" value="Confirm">
    </form>
</div>
`;
        profileEditOverlay.style.display = "flex";
    });
}

if (accountEmailButton) {
    const originalValue = accountEmailButton.innerHTML;
    accountEmailButton.addEventListener("mouseenter", () => {
        accountEmailButton.innerHTML += editPencil;
    });
    accountEmailButton.addEventListener("mouseleave", () => {
        accountEmailButton.innerHTML = originalValue;
    });

    accountEmailButton.addEventListener("click", () => {
        profileEditOverlay.innerHTML = `
<div class="profile-edit-box">
    <div class="profile-edit-box-title">
        <h2>Edit Name</h2>
        <p onclick="closeOverlay()" class="clickable" style="font-weight: bold;"><i class="hn hn-times-solid"></i></p>
    </div>
    <form method="post">
        <label for="newEmail">New Email </label>
        <input class="profile-edit-input-text" type="text" id="newEmail" name="newEmail" placeholder="Enter new email...">
        <input type="submit" value="Confirm">
    </form>
</div>
`;
        profileEditOverlay.style.display = "flex";
    });
}

if (changePasswordButton) {
    const originalValue = changePasswordButton.innerHTML;
    changePasswordButton.addEventListener("mouseenter", () => {
        changePasswordButton.innerHTML += editPencil;
    });
    changePasswordButton.addEventListener("mouseleave", () => {
        changePasswordButton.innerHTML = originalValue;
    });

    changePasswordButton.addEventListener("click", () => {
        profileEditOverlay.innerHTML = `
<div class="profile-edit-box">
    <div class="profile-edit-box-title">
        <h2>Edit Name</h2>
        <p onclick="closeOverlay()" class="clickable" style="font-weight: bold;"><i class="hn hn-times-solid"></i></p>
    </div>
    <form method="post">
        <label for="oldEmail">Old Password </label>
        <input class="profile-edit-input-text" type="password" id="oldPassword" name="oldPassword" placeholder="Enter old password..." autocomplete="off">
        <label for="newEmail">New Password </label>
        <input class="profile-edit-input-text" type="password" id="newPassword" name="newPassword" placeholder="Enter new password..." autocomplete="off">
        <label for="newEmail">Verify Password </label>
        <input class="profile-edit-input-text" type="password" id="verifyPassword" name="verifyPassword" placeholder="Verify new password..." autocomplete="off">
        <input type="submit" value="Confirm">
    </form>
</div>
`;
        profileEditOverlay.style.display = "flex";
    });
}

if (profileImageButton) {
    profileImageButton.addEventListener("click", () => {
        const fileInput = document.getElementById("fileInput");
        if (fileInput) {
            fileInput.addEventListener("change", function () {
                if (this.files.length > 0) {
                    let formData = new FormData();
                    formData.append("file", this.files[0]);

                    fetch("/file/uploadProfileImage", {
                        method: "POST",
                        body: formData
                    }).then((response) => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        }
                    });
                }
            });

            fileInput.click();
            fileInput.remove();
        }
    });
}

if (profileEditOverlay) {
    profileEditOverlay.addEventListener("keydown", (e) => {
        if (e.key == "Escape") {
            profileEditOverlay.style.display = "none";
            profileEditOverlay.innerHTML = "";
        }
    });
}

