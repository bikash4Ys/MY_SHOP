<?php
session_start();
session_regenerate_id(true);

if (isset($_SESSION['my_shop']['user'])) {
    unset($_SESSION['my_shop']['user']);
}
header('Location: ../login/');