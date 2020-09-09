<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

div.wrapper {
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;
    text-align: left;
}
#fof {
    display: block;
    width: 100%;
    padding: 150px 0;
    line-height: 1.6em;
    text-align: center;
}

#fof .hgroup {
    display: block;
    width: 80%;
    margin: 0 auto;
    padding: 0;
}

#fof .hgroup h1,#fof .hgroup h2 {
    margin: 0 0 0 40px;
    padding: 0;
    float: none;
    text-transform: uppercase;
    font-weight: normal;
    line-height: normal;
    display: inline-block;
    color: #b9acac;
}

#fof .hgroup h1 {
    margin-top: -90px;
    font-size: 200px;
}

#fof .hgroup h2 {
    font-size: 60px;
}

#fof .hgroup h2 span {
    display: block;
    font-size: 30px;
}

#fof p {
    margin: 25px 0 0 0;
    padding: 0;
    font-size: 16px;
}

#fof p:first-child {
    margin-top: 0;
}

.clear:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
    line-height: 0;
}

</style>
</head>
<body>    
<div class="wrapper row2">
  <div id="container" class="clear">
  
    <section id="fof" class="clear">
    
      <div class="hgroup clear">
        <h1>404</h1>
        <h2>Error ! <span>Page Not Found</span></h2>
      </div>
      <p style="font-size: 20px; color: #f00;">Rất tiếc, Trang bạn đang tìm kiếm không tồn tại rất tiết</p>
      <p><a href="javascript:history.go(-1)">&laquo; Trở về</a> / <a href="./">Trang chủ &raquo;</a></p>
      
    </section>
  
  </div>
</div>
  
