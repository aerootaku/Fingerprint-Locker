<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 6/15/2018
 * Time: 1:51 AM
 */ ?>
<section class="sidebar">
    <div class="w-80px mt-3 mb-3 ml-3">
<!--        <img src="../assets/img/basic/logo.png" alt="">-->
        <h3 style="text-align: center;">Locker</h3>
    </div>
    <div class="relative">
        <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
           aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm fab-right fab-top btn-primary shadow1 ">
            <i class="icon icon-cogs"></i>
        </a>
        <div class="user-panel p-3 light mb-2">
            <div>
                <div class="float-left image">
                    <img class="user_avatar" src="../assets/img/dummy/u2.png" alt="User Image">
                </div>
                <div class="float-left info">
                    <h6 class="font-weight-light mt-2 mb-1"><?= $_SESSION['username']; ?></h6>
                    <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="collapse multi-collapse" id="userSettingsCollapse">
                <div class="list-group mt-3 shadow">
                       <a href="logout.php?logout=true" class="list-group-item list-group-item-action"><i
                            class="mr-2 icon-exit_to_app text-purple"></i>Logout</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li class="header"><strong>MAIN NAVIGATION</strong></li>
        <li class="treeview"><a href="#">
                <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="header"><strong>SYSTEM MANAGEMENT</strong></li>
        <li class="treeview"><a href="clients.php">
                <i class="icon icon icon-user blue-text s-18"></i>
                <span>Clients</span>
            </a>
            <ul class="treeview-menu">
                <li><a href="clients.php"><i class="icon icon-circle-o"></i>All Clients</a>
                </li>
                <li><a href="clients-create.php"><i class="icon icon-add"></i>Add
                        New </a>
                </li>
            </ul>
        </li>
        <li class="header"><strong>TOOLS</strong></li>
        <li class="treeview"><a href="logs.php">
                <i class="icon icon-circle-o purple-text s-18"></i> <span>Logs</span>
            </a>
        </li>
        <li class="treeview"><a href="locker.php">
                <i class="icon icon-circle-o purple-text s-18"></i> <span>Locker</span>
            </a>
        </li>
        <li class="treeview"><a href="logout.php?logout=true">
                <i class="icon icon-exit_to_app purple-text s-18"></i> <span>Logout</span>
            </a>
        </li>

    </ul>
</section>
