<?php

session_start();

// Hapus semua data session (unset) lalu hancurkan session
session_unset();
session_destroy();

header('Location: login.php');
exit;
