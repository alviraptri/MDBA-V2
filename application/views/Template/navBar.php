<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown nav-icon me-2">
                <!-- <?php date_default_timezone_set('Asia/Jakarta');
                        echo date('l, d F Y H:i:s'); ?> -->
                <div class="date-time">
                    <span id="time"></span>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar me-1">
                        <i data-feather="user" width="20"></i>
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $this->session->userdata('user_nama'); ?></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>"><i data-feather="log-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    var span = document.getElementById('time');

    function time() {
        var weekdays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var d = new Date();
        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();
        var dat = d.getDate();
        var mon = d.getMonth();
        var yea = d.getFullYear();
        var days = d.getDay();
        span.textContent =
            (weekdays[days]) + ", " + ("0" + dat).substr(-2) + " " + (months[mon]) + " " + (yea) + "  " + ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
    }

    setInterval(time, 1000);
</script>