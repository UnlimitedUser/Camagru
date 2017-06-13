function flike(a) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://localhost/Camagru/views/gallery/likes.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("q="+a.id);
    document.getElementById('p'+a.id).innerHTML = (parseInt(document.getElementById('p'+a.id).innerHTML) + 1) + '';
}

function comment(e) {
    e.onkeydown = function (a) {
        if (a.keyCode == 13) {
            console.log("comment");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "http://localhost/Camagru/views/gallery/comments.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("q=" + e.id.split('c')[1] + '&d=' + e.value + '&i=' +  e.id.split('c')[0]);
            console.log(e.id.split('c'));
            var x = document.createElement("LI");
            x.innerHTML = e.value;
            document.getElementById('ul'+e.id.split('c')[0]).appendChild(x);
            e.value = '';
        }
    }
}