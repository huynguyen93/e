<?php
//print_r($_SESSION);
if(isset($_SESSION['success'])) echo "<p class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>{$_SESSION['success']}</p>";
if(isset($_SESSION['error'])) echo $_SESSION['error'];
if(isset($_SESSION['fail'])) echo "<p class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>{$_SESSION['fail']}</p>";
if(isset($_SESSION['warning'])) echo "<p class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>{$_SESSION['success']}</p>";