<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui">
    <title>emojiGo</title>
    <link   rel="stylesheet" href="/emojigo/Public/css/jquery.mobile-1.4.3.css"></link>
    <link   rel="stylesheet" href="/emojigo/Public/css/test.css"></link>
    <script src="/emojigo/Public/js/jquery/jquery-1.11.1.js"></script>
    <script src="/emojigo/Public/js/jquery/jquery.mobile-1.4.3.js"></script>
    <script src="/emojigo/Public/js/jquery/jquery.emoji.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('#body').each(function(i, d){
            $(d).emoji();
          });
        });
        $(document).ready(function(){
    getMessageCount();
    eventCount();
    if(uid) {
        var data = {name:localStorage.name, uid:localStorage.uid};

        $.post("http://localhost/emojigo/home/event/getLocalStorage",data);

        setOnline();
    }else{
        var data = {};
        $.post("http://localhost/emojigo/home/event/getLocalStorage",data);
    }
});


    </script>

</head>
    <body id="body">

        <div data-role="page" id="pageone">

            <div data-role="header">
                <h1>emojiGo</h1>
            </div>
            <span id="user" style="position: absolute;top: 12px;left: 9px; display: none"></span>

            
<div id="event" data-position="fixed">
	<div id="event-info">
		<ul class="event-info">
			<li id="event-title"><?php echo ($eventinfo["name"]); ?>:+1:</li>
			<li id="event-content"><?php echo ($eventinfo["content"]); ?></li>
			<li id="event-time" ><lable style="position: relative; top: -2px;">:clock3: </lable><?php echo ($eventinfo["time"]); ?></li>
			<li id="viewcount"><lable style="position: relative; top: -2px;">:eyes: </lable><?php echo ($eventinfo["view_count"]); ?></li>
			<li id="event-id" value="<?php echo ($eventinfo["id"]); ?>" style="display: none">事件ID<?php echo ($eventinfo["id"]); ?></li>

		</ul>
	</div>
</div>
<div id="event-mini" style="display: none">
	<ul>
		<li class="event-info-mini"><?php echo ($eventinfo["name"]); ?></li>
		<a class="event-info-button ui-btn"  href="#pagetwo"  data-transition="slideup">发评论</a>
	</ul>
</div>
            
            	
<div  id="reply">
	<pointer id="1"></pointer>
	
	<span id="msgcount"class="ui-btn-inline"></span>
	<a href="#pagetwo"  data-transition="slideup" class="ui-btn ui-btn-inline ui-mini" style="float: right;top:-10px">发评论</a>

	<div id="comment-box">


	</div>

	<button  id="getmessage" class="ui-btn" onclick="getMessage();" style="display: none">getMessage</button>
</div>

        </div>
            <div data-role="page" id="pagetwo">
                <div data-role="header">
                    <a href="#pageone" class="ui-btn ui-icon-carat-l ui-btn-icon-notext ui-corner-all">Icon only</a>
                    <h1>emojiGo</h1>
                </div>
            <div>

                
<div id="event" data-position="fixed">
	<div id="event-info">
		<ul class="event-info">
			<li id="event-title"><?php echo ($eventinfo["name"]); ?>:+1:</li>
			<li id="event-content"><?php echo ($eventinfo["content"]); ?></li>
			<li id="event-time" ><lable style="position: relative; top: -2px;">:clock3: </lable><?php echo ($eventinfo["time"]); ?></li>
			<li id="viewcount"><lable style="position: relative; top: -2px;">:eyes: </lable><?php echo ($eventinfo["view_count"]); ?></li>
			<li id="event-id" value="<?php echo ($eventinfo["id"]); ?>" style="display: none">事件ID<?php echo ($eventinfo["id"]); ?></li>

		</ul>
	</div>
</div>
<div id="event-mini" style="display: none">
	<ul>
		<li class="event-info-mini"><?php echo ($eventinfo["name"]); ?></li>
		<a class="event-info-button ui-btn"  href="#pagetwo"  data-transition="slideup">发评论</a>
	</ul>
</div>
                <input type="text" id="name" placeholder="输入昵称" oninput="" data-corners="false">
                <textarea cols="40" rows="8" name="textarea" oninput="showbutton(content)" placeholder="输入这段Emoji的含义" data-corners="false" id="content"></textarea>

                <a href="#pageone"  id="sendcomment" data-transition="fade" onclick="sendcomment()" class="ui-btn ui-mini" style="display: none;">发送</a>

            </div>

        </div>
            
            <script src="/emojigo/Public/js/emojigo.js"></script>




    </body>

    <script type="text/javascript">        
 
    $(document).ready(function() {
    

    window.onscroll = function() {
    var p = document.getElementById("1");
    var h = p.offsetTop;
    var y = window.scrollY;
        if (y > h) {
            $("#event-mini").fadeIn();
        }else{
            $("#event-mini").fadeOut();

        };
    }
});

    </script>


</html>