<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?= base_url() ?>assets/logo-usu.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('user') ?></div>
                <div class="email">Administrator</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" id="btn-logout"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('data-testing') ?>">
                        <i class="material-icons">border_color</i>
                        <span>Data Testing</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('data-training') ?>">
                        <i class="material-icons">border_color</i>
                        <span>Data Training</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('report') ?>">
                        <i class="material-icons">assignment</i>
                        <span>Report</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                <?= APP_COPYRIGHT ?>
            </div>
            <div class="version">
                <b>Version: </b> 1.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>