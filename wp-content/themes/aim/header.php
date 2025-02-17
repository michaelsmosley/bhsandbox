<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<div class="aim__page">
<?php require_once get_template_directory() . '/components/header/header.php'; ?>
<?php require_once get_template_directory() . '/components/header/header-mobile.php'; ?>
<?php

