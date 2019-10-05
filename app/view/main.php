<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeeJee test</title>

    <link rel="stylesheet" href="/design/css/main.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</head>
<body>
    <div class="container">
    	<header>
    		<div class="row">
                <div class="col col-3">
                    <a class="btn btn-dark btn-sm" href="/tasks/add_edit">
                        New task
                    </a>
                </div>
                <div class="col col-9 fright text-right">
                    <? if(isset($_SESSION['loggedIn'])) { ?>
                        <span class="badge badge-info"><?=$_SESSION['u_name']; ?></span>
                        <span class="logout-button"><a href="/auth/logout" class="btn btn-light btn-sm">Log out</a></span>
                    <? } else { ?>
                        <span class=login-button><a href="/auth/login" class="btn btn-light btn-sm">Log in</a></span>
                    <? } ?>
                </div>
            </div>
        </header>

        <div class="row content padding-horizontal-30">
            <div class="notifications">
                <? 
                    # вывод сообщений
                    foreach($_SESSION['messages'] as $k => $v) 
                    { 
                        echo    '
                                    <div class="alert alert-'.$v['type'].' alert-dismissible fade show" role="alert">
                                        '.$v['text'].'
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                ';
                        unset($_SESSION['messages'][$k]);   
                    }
                ?>
            </div>
            <? include 'app/view/'.$content_view; ?>
        </div>

        <footer>

        </footer>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>