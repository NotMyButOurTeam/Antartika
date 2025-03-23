let appImageArrays = new Array();

const appIconPrev = document.getElementById("appIconPrev");
const appIconFile = document.getElementById("appIconFile");
let appImageFile = document.getElementById("appImageFile");
let appImages = document.getElementById("appImages");

if (appIconPrev) {
    appIconPrev.addEventListener("click", () => {
        appIconFile.click();
    });
}

if (appIconFile) {
    appIconFile.addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
            const appIcon = document.getElementById("appIconPrev");
            if (appIcon) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        appIcon.src = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    });
}

if (appImageFile) {
    appImageFile.addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    appImageArrays.push(ev.target.result);

                    let img = document.createElement("img");
                    img.src = ev.target.result;
                    img.className = "appImage";

                    appImages.appendChild(img);
                };

                reader.readAsDataURL(file);
                appImageFile.value = "";
            }
        }
    });
}
