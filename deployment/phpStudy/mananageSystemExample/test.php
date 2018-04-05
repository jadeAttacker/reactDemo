<?php
/**
 * Created by PhpStorm.
 * User: dw
 * Date: 2017/6/19
 * Time: 17:06
 */
header("Content-Type:text/html; charset=utf-8");
echo "<div class='comment'><h6>{$_REQUEST['username']}:</h6><p class='para'>{$_REQUEST['content']}</p></div>";
//echo "<div class='comment'><h6>{".$_REQUEST['username']."}:</h6><p class='para'>{".$_REQUEST['content']."}</p></div>";