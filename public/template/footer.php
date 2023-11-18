</div>
<script src="/public/js/jquery-3.6.3.min.js"></script>
<script src="/public/js/popup.js"></script>
<script src="/public/js/datatable.js"></script>
<script src="/public/js/notif.js"></script>
<script src="/public/js/filterSubject.js"></script>
<?php
if (isset($_SESSION['notif'])) {
    echo $_SESSION['notif'];
    unset($_SESSION['notif']);
}
?>
</body>

</html>