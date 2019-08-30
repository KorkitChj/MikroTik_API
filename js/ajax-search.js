function fetch() {
    // GET SEARCH TERM
    var data = new FormData();
    data.append('search', document.getElementById("search").value);
    data.append('ajax', 1);

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "3-search.php", true);
    xhr.onload = function () {
        if (xhr.status == 403 || xhr.status == 404) {
            alert("ERROR LOADING FILE!");
        } else {
            var results = JSON.parse(this.response),
                wrapper = document.getElementById("results");
            wrapper.innerHTML = "";
            if (results.length > 0) {
                for (var res of results) {
                    var line = document.createElement("div");
                    line.innerHTML = res['name'] + " - " + res['email'];
                    wrapper.appendChild(line);
                }
            } else {
                wrapper.innerHTML = "No results found";
            }
        }
    };
    xhr.send(data);
    return false;
}