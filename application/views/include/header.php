<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Readditing is a social reddit website">
   <meta name="keywords" content="reddit social friends news information readdit readditing">
   <meta name="author" content="">

   <title>Readditing | <?=$title?></title>
   <link href='http://fonts.googleapis.com/css?family=Montserrat|Roboto' rel='stylesheet' type='text/css'>
   <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/bootstrap-switch.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/upvoteable.css') ?>" rel="stylesheet">
   <link rel="shortcut icon" href="<?=base_url('assets/img/favicon.ico')?>" type="image/x-icon">
   <link rel="icon" href="<?=base_url('assets/img/favicon.ico')?>" type="image/x-icon">
</head>
<body>
   <?=$this->load->view('pages/about') ?>
   <?=$this->load->view('pages/tos') ?>
   <?=$this->load->view('pages/contact') ?>
