<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../../res/portal/assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
  <link rel="stylesheet" href="../../res/portal/assets/css/shared/style.css">
  <link rel="stylesheet" href="../../res/portal/assets/css/shared/style1.css">
  <link rel="shortcut icon" href="https://www.police.gov.sg/-/media/logo-spf-white/SPF_Crest.png" />
  <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="43c1e5d9-fe19-48ed-8f4e-be24ce370950";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</head>

<body>
    <div class="page-body">
      <div class="sidebar">
        <div class="user-profile">
          <div class="display-avatar animated-avatar">
            <img class="profile-img img-lg rounded-circle" src="https://www.police.gov.sg/-/media/logo-spf-white/SPF_Crest.png" alt="profile image">
          </div>
          <div class="info-wrapper">
            <p class="user-name"><?php echo($_SESSION["pr"]); echo(" | "); echo($_SESSION["name"]);?></p>
            <p class="user-pr"><?php echo($_SESSION["branch"]);?></p>
            <br>
            <span class="display-income">Dashboard</span>
          </div>
        </div>
        <ul class="navigation-menu">
          <li class="nav-category-divider">Menu</li>
          <li>
            <a href="">
              <span class="link-title">Dashboard</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>
          <li>
            <a href="../message">
              <span class="link-title">Announcements</span>
              <i class="mdi mdi-message-outline link-icon"></i>
            </a>
          </li>
          <li class="nav-category-divider">Profile</li>
          <li>
            <a href="../profile">
              <span class="link-title">Settings</span>
              <i class="mdi mdi-account-settings link-icon"></i>
            </a>
          </li>
          <li>
            <a href="../../res/login/logout.php">
              <span class="link-title">Logout</span>
              <i class="mdi mdi-logout link-icon"></i>
            </a>
          </li>
        </ul>
      </div>
      <!-- partial -->
      <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
          <div class="content-viewport">
            <div class="row">
              <div class="col-12 py-5">
                <h4><?php echo($_SESSION["pr"]); echo(" | "); echo($_SESSION["name"]);?></h4>
              </div>
            </div>
            <div class="row">

              <div class="col-md-5 col-md-6 col-sm-12 equel-grid">
                <div class="grid">
                  <div class="grid-body">
                    <div class="split-header">
                      <p class="card-title">Chain of custody</p>
                    </div>
                    <div class="wrapper d-flex pr-4">
                      <small class="text-success font-weight-medium mr-2">Require attention : 0</small>
                    </div>
                    <div class="d-flex flex-row mt-4 mb-4">
                      <button type="button" class="btn btn-primary btn-block mt-0" onclick="window.location.href='manage.php'">MANAGE</button>
                    </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="../../res/portal/assets/vendors/js/core.js"></script>

  </body>
</html>
