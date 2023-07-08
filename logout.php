<?php
session_start();
session_destroy();
exit(header("Location: login.php?result=infoLogOut"));
