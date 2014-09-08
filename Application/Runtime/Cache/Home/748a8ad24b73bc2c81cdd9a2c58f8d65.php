<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>emojiGo</title>
    <link rel="stylesheet" href="../emojigo/Public/css/base-debug.css">
</head>
<body>
<section id="todoapp">
    <div id="event">
      <ul>
        <li>😘😘😘😘😘♻︎♻︎♻︎♻︎♻︎♻︎<?php echo ($eventinfo["name"]); ?></li>
        <?php echo (😘); ?>
        <br>
        <li><?php echo ($eventinfo["content"]); ?></li>
      </ul>
    </div>
    <header id="header">
        
        <h1>emojiGo</h1>
        <input id="new-todo" placeholder="What needs to be done?" autofocus>
    </header>
    <section id="main">

        <ul id="todo-list">
            <li class="">
                <div class="view">
                    <lable class="toggle"></lable>
                    <label>wwww</label>
                    <button class="like"></button>
                </div>

            </li>
            <li class="">
                <div class="view">
                    <input class="toggle" type="checkbox">
                    <label>ff</label>
                    <button class="like"></button>
                </div>

            </li>
        </ul>
    </section>
    <footer id="footer"></footer>
</section>
<footer id="info">
    <p>Double-click to edit a todo</p>
    <p>Originated by <a href="https://github.com/addyosmani">Addy Osmani</a></p>
    <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
    <p>Modified by <a href="http://www.linkgod.net">LinkGod</a> in March 2013</p>
</footer>


<script src="../emojigo/Public/js/sea-modules/seajs/seajs/2.2.0/sea.js"></script> 


</body>
</html>