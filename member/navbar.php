<style>
  .dropdown:hover>.dropdown-menu {
    display: block;
  }

  .container:hover {
    display: block;

  }
</style>
<nav class="navbar navbar-expand-sm bg-success navbar-success fixed-top">
  <div class="rownav ">
    <a href="index.php">
    </a>
  </div>
  <div class="container-fluid justify-content-start ">
  <ul class="navbar-nav p-2 ">
      <li class="nav-item ">
        <a class="nav-link text-light " href="index.php">หน้าหลัก</a>
      </li>
      </li>
            <li class="nav-item mb-1">
                <a class="nav-link  text-light" href="list.php">รายการจอง</a>
            </li>
  </ul>
  </div>
  <div class="col-6 text-white text-end">
                <div class="row">
                    <div class="col-6 text-end"> </div>
                    <div class="col-6 text-start p-2"> 
                        <?php echo $data2['memfirst'] ?>
                        <a href="logout.php" class="btn btn-outline-light">
                            ออกจากระบบ
                        </a>
                    </div>
                </div>
            </div>
</nav>