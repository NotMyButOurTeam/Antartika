<div class="searchbar">
    <input type="text" id="query" placeholder="App name...">
    <button id="searchbtn">Search</button>
</div>

<div id="applist">
    <h2>Welcome to Antartika</h2>
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
