<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <?php $role_id  = $this->session->userdata('role_id');
                $queryMenu = "SELECT `tb_user_menu`.`id`,`menu` FROM `tb_user_menu` JOIN `tb_user_access_menu` ON `tb_user_menu`.`id` = `tb_user_access_menu`.`menu_id` WHERE `tb_user_access_menu`.`role_id` = $role_id ORDER BY `tb_user_access_menu`.`menu_id` ASC";
                $menu = $this->db->query($queryMenu)->result_array(); ?>

                <?php foreach ($menu as $m) : ?>
                    <div class="container-fluid">
                        <div class="sb-sidenav-menu-heading"><?= $m['menu']; ?></div>
                        <div class="nav">
                            <!-- SUBMENU SESUAI MENU -->
                            <?php $menuId = $m['id'];
                            $querySubMenu = " SELECT * FROM `tb_user_sub_menu` WHERE `menu_id` = $menuId AND `is_active` = 1 ";
                            $subMenu = $this->db->query($querySubMenu)->result_array();
                            ?>
                            <?php foreach ($subMenu as $sm) : ?>
                                <?php if ($title == $sm['title']) : ?>
                                    <a class="nav-link active" href="<?= base_url(); ?><?= $sm['url'] ?>">
                                    <?php else : ?>
                                        <a class="nav-link" href="<?= base_url(); ?><?= $sm['url'] ?>">
                                        <?php endif; ?>
                                        <div class="sb-nav-link-icon"><i class="<?= $sm['icon']; ?>"></i></div>
                                        <?= $sm['title']; ?>
                                        </a>
                                    <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php if ($user['role_id'] == 1) {
                    echo 'Admin';
                } else {
                    echo 'Member';
                } ?>
            </div>
        </nav>
    </div>