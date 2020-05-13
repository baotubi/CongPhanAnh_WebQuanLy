    <?php
    session_start();
    require_once('../functions/redirect.php');
    if(isset($_SESSION['user_id'])) {
        session_destroy();
        redirectUrl('dangnhap.php');
    }