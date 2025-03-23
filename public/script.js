let profileToggle = true;

window.onload = function() {
    const homeButton = document.getElementById("homeButton");
    if (homeButton) {
        homeButton.addEventListener("click", function() {
            window.location.href = "/";
        });
    }

    const categoryButton = document.getElementById("categoryButton");
    if (categoryButton) {
        categoryButton.addEventListener("click", function() {
            window.location.href = "/apps/category";
        });
    }

    const rankingButton = document.getElementById("rankingButton");
    if (rankingButton) {
        rankingButton.addEventListener("click", function() {
            window.location.href = "/apps/ranking";
        });
    }

    const loginButton = document.getElementById("loginButton");
    if (loginButton) {
        loginButton.addEventListener("click", function() {
            window.location.href = "/login";
        });
    }

    const registerButton = document.getElementById("registerButton");
    if (registerButton) {
        registerButton.addEventListener("click", function() {
            window.location.href = "/register";
        });
    }

    const logoutButton = document.getElementById("logoutButton");
    if (logoutButton) {
        logoutButton.addEventListener("click", function() {
            fetch('/logout', { method: 'POST' })
                .then(response => {
                    if (response.status === 200) {
                        window.location.reload();
                    }
                });
        });
    }

    const profileButton = document.getElementById("profileButton");
    if (profileButton) {
        profileButton.addEventListener("click", function() {
            const profileBox = document.getElementById("profileBox");
            if (profileBox) {
                if (profileToggle) {
                    profileBox.style.transform = "translateX(calc(100vw - 280px))";
                    profileToggle = false;
                } else {
                    profileBox.style.transform = "translateX(120vw)";
                    profileToggle = true;
                }
            }
        });
    }

    const editProfileButton = document.getElementById("editProfileButton");
    if (editProfileButton) {
        editProfileButton.addEventListener("click", () => {
            window.location.href = "/account";
        })
    }

    const publishButton = document.getElementById("publishButton");
    if (publishButton) {
        publishButton.addEventListener("click", () => {
            window.location.href = "/apps/publish";
        })
    }

    const dashboardButton = document.getElementById("dashboardButton");
    if (dashboardButton) {
        dashboardButton.addEventListener("click", () => {
            window.location.href = "/apps/dashboard";
        })
    }

    const elevateButton = document.getElementById("elevateButton");
    if (elevateButton) {
        elevateButton.addEventListener("click", () => {
            window.location.href = "/account/elevate";
        })
    }
}
