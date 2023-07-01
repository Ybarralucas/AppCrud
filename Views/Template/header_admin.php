<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual Abel OSH">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Abel OSH">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media();?>/images/favicon.ico">
    <title><?= $data['page_tag'] ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.0/dist/bootstrap-table.min.css">
    
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>">AppCrud</a>
   
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <a type="button" href="<?= base_url(); ?>/generos" class="btn btn-success">Generos</a>
        <a type="button" href="<?= base_url(); ?>/canciones" class="btn btn-danger">Canciones</a>
      </ul>
    </header>
  