	var uid = localStorage.uid;
	var eid = document.getElementById("event-id").value;
	var lastid = 0;
	var sendMsg = 1; var getMsg = 2;
	var allmsg = 0;
	var state = 0;





sendcomment.count = 0;

function sendcomment() {
	var content = $("#content").val();
	var name = $("#name").val();
	if(content&&name) {

		if(!uid) {
				var data = {name:name, content:content, eid:eid};
				alert(data.name);
				$.post("http://localhost/emojigo/home/event/sendcomment",data,function(data){
					state = 1;
					var msg = eval("["+data+"]");
	
					if(localStorage) {
						localStorage.name 	= msg[0].nickname;
						localStorage.uid 	= msg[0].id;
						uid = msg[0].id;
						setOnline();
					}
			}
			);
				sendcomment.count++;
				document.getElementById("content").value = "";
		}else{
			var data = {name:localStorage.name, content:content, eid:eid};
			$.post("http://localhost/emojigo/home/event/sendcomment",data);
			state = 1;
			if (sendcomment.count) {
				alert("send is work")
				data.time = now();
				showComment(sendMsg, data);
			};
			sendcomment.count++;

			document.getElementById("content").value = "";



		}
	}else{
		if(!content) alert(1); 
		if(!name) alert(2); 


	}

	if (sendcomment.count == 1) {
		getMessage();		
		$("#getmessage").show();
	};	
}
function getMessage() {

	var data = {eid:eid, lastid:lastid};
	$.post("http://localhost/emojigo/home/event/getMessage",data,function(data){var msg = eval(data);showComment(getMsg,msg);});
}

showComment.count = 0;

function showComment(type, data) {
	if(type==1) {
		alert("show is work");
			var msg = "<ul id=\"comment\" class=\"comment\"><li class=\"reply-name\">"+":person_with_blond_hair:"+data.name+"</li><li class=\"reply-content\">"+data.content+"</li><li class=\"reply-time\">"+data.time+"</li></ul>";
			$("#comment-box").prepend(msg);
			emojigo();
	}

	if(type==2){
		for (var i = 0; i < data.length; i++) {
			var msg = "<ul id=\"comment\" class=\"comment\"><li class=\"reply-name\">"+":flushed:"+data[i].nickname+"</li><li class=\"reply-content\">"+data[i].content+"</li><li class=\"reply-time\">"+data[i].publish_time+"</li></ul>";
			$("#comment-box").append(msg);
			lastid = data[i].id;
		}
		showComment.count+= i;

		$("#getmessage").text("显示剩余"+(allmsg-showComment.count)+"条评论");
		emojigo();

	}


	
}



function now() {
	var now = new Date();
	var year = now.getFullYear();	
	var month = now.getMonth()+1;	if (month< 10) {month='0'+month;};
	var day = now.getDay();			if (day< 10) {day='0'+day;};
	var hour = now.getHours();		if (hour< 10) {hour='0'+hour;};
	var minute = now.getMinutes();	if (minute< 10) {minute='0'+minute;};
	var second = now.getSeconds();	if (second< 10) {second='0'+second;};
	return (year+"-"+month+"-"+day+" "+hour+":"+minute+":"+second);

}

function setOnline() {
	if(localStorage.name) {
		var online = document.getElementById("name");
		online.value = localStorage.name;
		online.readOnly = "true";
		$("#user").html(localStorage.name);
		$("#user").show();

	}

}

function getMessageCount() {
	var data = {eid:eid};
	$.post("http://localhost/emojigo/home/event/messagecount",data, function(data){
		var html = "共有"+data+"条评论";
		$("#msgcount").html(html);
		allmsg = data;

	});

}

function eventCount() {
	var data = {eid:eid};
	$.post("http://localhost/emojigo/home/event/updateeventcount",data);

}

function emojigo() {
	$('#comment-box').each(function(i, d){
	    $(d).emoji();
	});
}

function showbutton() {
	if ($("#content").val()) {
		$("#sendcomment").fadeIn();
	}else{
        $("#sendcomment").fadeOut();

	};
         
}









