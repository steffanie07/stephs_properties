<?php
use App\Controllers\Validator as Validator;
$crfToken  = Validator::crfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <Script type="text/javascript" src="/assets/scripts/jquery-3.3.1.min.js"></script>

 <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Stephanie Boms">
<meta name="csrf-token" content="$csrfToken">

<!--===================FAVICON PATH ================================-->
<link rel="icon" href="<?php $favicon; ?>">
<!--================================================================-->

<!--=================== APP TITLE ==================================-->
<title>Assignment</title>
<!--================================================================-->

<!--================== CSS PATHS ===================================-->
<link rel="stylesheet" href="/assets/styles/bootstrap.min.css">
<link rel="stylesheet" href="/assets/styles/style.css">
<!--================== CSS PATHS ===================================-->   

<!--====================== JAVASCRIPT PATH==========================-->
    <script type="text/javascript">
  $(function() {
     $( "#search" ).autocomplete({
       source: 'search.php',
     });
  });
</script>
<!--================================================================-->
</head>
<body>
