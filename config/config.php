<?php
function connect() {
    return mysqli_connect("localhost", "root", "", "media");
}