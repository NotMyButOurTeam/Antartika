window.onload = () => {
    const profileButton = document.getElementById("profileButton");
    let profileBox = document.getElementById("profileBox");

    profileButton.addEventListener("click", () => {
        profileBox.style.display = 
            profileBox.style.display === "none" ?
            "flex" :
            "none";
    });
}
