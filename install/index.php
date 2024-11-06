<?php
ini_set('display_errors', 0);
if (version_compare(PHP_VERSION, '5.3', '>='))
{
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
}
else
{
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
}
//Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if ($_POST) {

    // Load the classes and create the new objects
    require_once('includes/core_class.php');
    require_once('includes/database_class.php');

    $core     = new Core();
    $database = new Database();


    // Validate the post data
    if ($core->validate_post($_POST) == true) {
        // First create the database, then create tables, then write config file
//        if ($database->create_database($_POST) == false) {
//            $message = $core->show_message('error', "The database could not be created, please verify your settings.");
//        } else
        if ($database->create_tables($_POST) == false) {
            $message = $core->show_message('error', "The database tables could not be created, please verify your settings.");
        } else if ($core->write_config($_POST) == false) {
            $message = $core->show_message('error', "The database configuration file could not be written, please chmod application/config/database.php file to 777");
        }

        // If no errors, redirect to index
        if (!isset($message)) {
            $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $redir .= "://" . $_SERVER['HTTP_HOST'];
            $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $redir = str_replace('install/', '', $redir);
            header("refresh:10;url=" . $redir);
            $installing = 1;
        }

    } else {
        $message = $core->show_message('error', 'Not all fields have been filled in correctly. The host, username, password, and database name are required.');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Bank App - Installer</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">

    <!--        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">-->
    <!-- Font-awesome CSS -->

    <!--        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/img/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

<!-- Top menu -->
<!--		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">-->
<!--			<div class="container">-->
<!--				<div class="navbar-header">-->
<!--					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">-->
<!--						<span class="col-form-label col-form-label-sm">Toggle navigation</span>-->
<!--						<span class="icon-bar"></span>-->
<!--						<span class="icon-bar"></span>-->
<!--						<span class="icon-bar"></span>-->
<!--					</button>-->
<!--				</div>-->
<!---->
<!--			</div>-->
<!--		</nav>-->

<!-- Top content -->
<div class="top-content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-sm-8 col-sm-offset-2 text">
                <p>
                    <img class="img-rounded" width="150" src="assets/img/logo.png" alt="">
                </p>
                <?php if (!isset($installing)) { ?>
                    <h1>Welcome to the Installer</h1>
                <?php } ?>
            </div>
        </div>

        <?php if (is_writable($db_config_path)) { ?>

            <?php if (isset($message)) { ?>
                <div class="alert alert-danger" style="max-width: 558px;float: none;margin:0 auto;">
                    <strong><?php echo $message; ?></strong>
                </div>
            <?php } ?>
            <?php if (isset($installing)) { ?>
                <div class="alert alert-success" style="max-width: 558px;float: none;margin:0 auto;">
                    <strong>Your script is installing. Please wait 10 seconds... <br>
                        (Page will refresh automatically)</strong>
                </div>
            <?php } else { ?>

                <div class="row justify-content-center">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                        <form id="install_form" method="post" class="f1" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <h3>Install Your App</h3>
                            <p>Fill in the form</p>
                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"
                                         style="width: 16.66%;"></div>
                                </div>
                                <div class="f1-step active">
                                    <div class="f1-step-icon"><i class="fa fa-database"></i></div>
                                    <p>Database</p>
                                </div>
                                <div class="f1-step ">
                                    <div class="f1-step-icon"><i class="fa fa-users-cog"></i></div>
                                    <p>Admin Login</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-folder-open"></i></div>
                                    <p>Folder Permissions</p>
                                </div>
                            </div>

                            <fieldset>
                                <h4>Database settings: </h4>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="f1-hostname">Hostname</label>
                                    <input type="text" name="hostname" placeholder="Hostname" value="localhost"
                                           class="form-control" id="f1-hostname">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="f1-username">Username</label>
                                    <input type="text" name="username" placeholder="Username" class="form-control"
                                           id="f1-username">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="f1-password">Password</label>
                                    <input type="password" name="password" placeholder="Password" class="form-control"
                                           id="f1-password">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="f1-database">Database Name</label>
                                    <input type="text" name="database" placeholder="Database Name" class="form-control"
                                           id="f1-database">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="f1-database_type">Database Type</label>
                                    <select name="database_type" id="f1-database_type" class="form-control">
                                        <option value="without_regions">Without Regions Data</option>
                                        <option value="with_regions">With Regions Data</option>
                                    </select>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
                            <fieldset>
                                <h4>Admin Login Information:</h4>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm"
                                           for="f1-admin_username">Username</label>
                                    <input type="text" name="admin_username" placeholder="Username" value="admin"
                                           required
                                           class="form-control" id="f1-admin_username">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="f1-admin_email">Email</label>
                                    <input type="text" name="admin_email" value="admin@admin.com" placeholder="Email"
                                           required
                                           class="form-control"
                                           id="f1-admin_email">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="f1-admin_password">Password
                                        <small>(default:
                                            <strong>admin</strong>)</small></label>
                                    <input type="text" name="admin_password" value="admin" placeholder="Password"
                                           required
                                           class="form-control"
                                           id="f1-admin_password">
                                </div>

                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4>Set your folder permissions:</h4>
                                <p class="text-danger">Folder permissions are usually should be 0755.</p>
                                <p class="text-danger"><strong>Note: </strong> Please delete install directory after
                                    successful install</p>
                                <div class="col-sm-12" style="padding: 0;margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong>Folder</strong>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong>Writable</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12" style="padding: 0;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><i class="fa fa-folder-open"></i> uploads</p>
                                            <p><i class="fa fa-folder-open"></i> uploads/images</p>
                                            <p><i class="fa fa-folder-open"></i> images</p>
                                            <p><i class="fa fa-folder-open"></i> images/thumb</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><?php if (is_writable('../uploads')) { ?><i
                                                        class="fa fa-check text-success"></i><?php } else { ?><i
                                                        class="fa fa-close text-danger"></i><?php } ?></p>
                                            <p><?php if (is_writable('../uploads/images')) { ?><i
                                                        class="fa fa-check text-success"></i><?php } else { ?><i
                                                        class="fa fa-close text-danger"></i><?php } ?></p>
                                            <p><?php if (is_writable('../images')) { ?><i
                                                        class="fa fa-check text-success"></i><?php } else { ?><i
                                                        class="fa fa-close text-danger"></i><?php } ?></p>
                                            <p><?php if (is_writable('../images/thumb')) { ?><i
                                                        class="fa fa-check text-success"></i><?php } else { ?><i
                                                        class="fa fa-close text-danger"></i><?php } ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" class="btn btn-next">Install</button>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
            <?php } ?>

        <?php } else { ?>
            <div class="alert alert-danger">
                Please make the application/config/database.php file writable.
                <strong>Example</strong>:<br/><code>chmod 777 application/config/database.php</code>
            </div>
        <?php } ?>

    </div>
</div>


<!-- Javascript -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/retina-1.1.0.min.js"></script>
<script src="assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>