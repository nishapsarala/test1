<!DOCTYPE html>
<html>
<head>
    <title>Recursive File Structure</title>
        <!--Jquery Link-->
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <!-- Bootstrap Styling-->
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <!-- custom stylesheet-->
        <link rel="stylesheet" type="text/css" href="css/custom.css" />
        <!-- custom javascript--> 

</head>

<body>
<?php
    require_once 'classFile.php';
?>
    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
                <div class="panel panel-info0">

                        <div class="panel-heading text-center">
                            <div class="row">
                                    <h4>Recursive File Structure</h4>
                            </div>
                            <hr />
                            <div class="panel-body">
                                <div class="row list_wrapper">
                                    <form role="form" method="post" action="" name="fmPath" id="fmPath">

                                    <div class="col-md-6 md">
                                        <div class="form-group"><label>Directory</label>
                                            <input autocomplete="off" required="" name="path" id="path" type="text" class="form-control" value="<?php echo $folder_path; ?>"/></div>
                                        <div class="form-group">
                                            <input  name="update" type="submit" value="Update"></div>
                                    </div>

                                    </form>
                                    <form role="form" method="post" action="" name="fmSearch" id="fmSearch">

                                    <div class="col-md-6">
                                        <div class="form-group"><label>Search</label>
                                            <input autocomplete="off" required="" placeholder="Search" name="search" id="search" type="text" class="form-control"/></div>
                                        <div class="form-group">
                                            <input class="list_search_button" type="submit" value="Search"></div>
                                    </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
                 <div class="panel-body">
                                <div class="row list_wrapper search">
                                    <?php $searchFile->getSrchFile($rows); ?>
                                </div>
                            </div>
            </div>
        </div>
    </div>
</body>
</html>
