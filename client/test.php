<?php include '../includes/navbar.php'; ?>
<?php include '../includes/header.php'; ?>

<body>
    <div class="container">
        <div class="row">
            <form action="" method="POST">
                <label> ID </label>
                <input type="text" id="rollNo" class="form-control" onkeyup="GetDetail(this.value)" required>
                <br>
                <label> Name </label>
                <input type="text" id="users_name" class="form-control" onkeyup="GetDetail(this.value)" required>
                <br>
                <label> Email </label>
                <input type="text" id="users_email" class="form-control" onkeyup="GetDetail(this.value)" required>
            </form>
        </div>
    </div>
</body>
<script>
    function GetDetail(str) {
        if (str.lenght == 0) {
            document.getElementById("users_name").value = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var myObj = JSON.parse(this.responseText);
                    document.getElementById("users_name").value = myObj[0];
                    document.getElementById("users_email").value = myObj[1];
                }
            }
            xmlhttp.open("GET", "search.php?rollNo=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<?php include '../includes/footer.php'; ?>