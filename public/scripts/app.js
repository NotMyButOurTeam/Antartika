const banAppButton = document.getElementById("banAppButton");

if (banAppButton) {
    banAppButton.addEventListener("click", {
        let formData = new FormData();

        const url = window.location.href;
        const appId = url.match(/(\d+)$/);
        formData.append("appId", appId);

        fetch("/apps/ban", {
            method: "POST",
            body: formData
        }).then((response) => {
            if (response.redirected) {
                window.location.href = response.url;
            }
        });
    });
}
