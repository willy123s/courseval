</div>
<?php
if (isset($_SESSION['notif'])) {
    echo $_SESSION['notif'];
    unset($_SESSION['notif']);
}
?>
<script src="/public/js/jquery-3.6.3.min.js"></script>
<script src="/public/js/popup.js"></script>
<script src="/public/js/filterSubject.js"></script>
<script src="/public/js/notif.js"></script>
<script src="/public/js/datatable.js"></script>
<script src="/public/js/toast.js"></script>

<script src="/public/js/loadSubjects.js"></script>

<script src="/public/js/prereq.js"></script>
<script src="/public/js/enroll.js"></script>

<script src="/public/js/loadGrades.js"></script>

<script src="/public/js/facultyLoadSubjects.js"></script>




</body>

</html>