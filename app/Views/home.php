<div class="search-bar">
    <input class="search-input" type="text" id="query" placeholder="App name...">
    <button class="search-button" id="searchbtn"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>

<div class="content">
    <h2>Welcome to Antartika</h2>
    <div class="app-list" id="applist"></div>
</div>

<script>
document.getElementById("searchbtn").addEventListener("click", function() {
    let query = document.getElementById("query").value.trim();
    let applist = document.getElementById("applist");

    if (query.length > 0) {
        fetch("/search?q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                applist.innerHTML = "";

                if (data.results.length > 0) {
                    data.results.forEach(app => {
                        let item = document.createElement("div");
                        item.classList.add("app");
                        item.innerHTML = "<h2>" + app.name + "</h2>\n" + "<p>" + app.description + "</p>";
                        applist.appendChild(item);
                    });
                } else {
                    applist.innerHTML = "<h2>App not found...</h2>"
                }
            });
    } else {
        applist.innerHTML = "";
    }
});

document.getElementById("query").addEventListener("keypress", function(e) {
    if (e.key == "Enter") {
        document.getElementById("searchbtn").click();
    }
});
</script>
