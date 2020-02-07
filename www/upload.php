<?php require "login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'imports/jquery.php';?>
    <?php include 'imports/bootstrap.php';?>
    <?php include 'imports/fontawesome.php';?>
    <?php include 'imports/global.php';?>
    <link rel="stylesheet" href="css/upload.css">
    <script src="js/uploadManager.js"></script>
</head>
<body>
    <div id="body-wrap">
        <div id="nav-box">
            <?php include 'side-nav.php';?>
        </div>
        <div id="body-box">
            <?php include 'navbar.php';?>
            <div class="container">
               <?php include "imports/page_notifications.php"; ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(!isset($_SESSION['username'])){?>
                        <div class="basic-box info">
                            <div class="basic-box-head">
                                <h3>Warning</h3>
                            </div>
                            <div class="basic-box-body">
                                <p>Posts made without being logged in will result in anonymous post.</p>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="basic-box">
                            <div class="basic-box-body">
                                <label for="file" id="file-box" class="fill">
                                    <span id="file-container">
                                        <h3 class="no-m">Select A file</h3>
                                        <h3 class="no-m">or</h3>
                                        <h3 class="no-m">Drag and Drop Here</h3>
                                    </span>
                                    <input type="file" name="file" id="file">
                                </label>
                            </div>
                        </div>
                        <div class="basic-box" id="name-container" style="display: none;">
                            <div class="basic-box-head">
                                <h3>Name Your Post</h3>
                            </div>
                            <div class="basic-box-body">
                                <input class="form-control" id="post-name" type="text">
                            </div>
                        </div>
                        <div class="basic-box" id="tag-container" style="display: none;">
                            <div class="basic-box-head">
                                <h3>Add Tags To your Post</h3>
                            </div>
                            <div class="basic-box-body">
                                <p class="add-pad">Tags will allow others to search for your post. Please read the rules and guidlines about tagging a post.</p>
                                <a class="button small hollow add-marg" id="clear-tags">Clear Tags</a>
                                <form id="tags">
                                    <input id="tag" type="text" class="form-control" placeholder="Tags" autocomplete="off">
                                    <input type="submit" hidden>
                                </form>
                            </div>
                            <div class="basic-box-body">
                                <div class="tags-box"></div>
                            </div>
                        </div>
                        <div class="basic-box" id="upload-container" style="display: none;">
                            <div class="basic-box-body">
                                <div id="upload-box"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>