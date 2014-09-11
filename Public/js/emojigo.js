	var uid = localStorage.uid;
	var eid = document.getElementById("event-id").value;
	var lastid = 0;
	var sendMsg = 1; var getMsg = 2;
	var allmsg = 0;
	var status = 0;
	var test;





sendcomment.count = 0;

function sendcomment() {
	var content = $("#content").val();
	var name = $("#name").val();
	getMessageCount();
	if(content&&name) {

		if(!uid) {
				var data = {name:name, content:content, eid:eid};
				$.post("../home/event/sendcomment",data,function(data){

					var msg = eval("["+data+"]");
	
					if(localStorage) {
						localStorage.name 	= msg[0].nickname;
						localStorage.uid 	= msg[0].id;
						uid = msg[0].id;
						setOnline();
					}
			});

				sendcomment.count++;
				document.getElementById("content").value = "";
		}else{
			var data = {name:localStorage.name, content:content, eid:eid};
			$.post("../home/event/sendcomment",data);

			if (sendcomment.count) {
				data.time = now();
				showComment(sendMsg, data);
			};
			sendcomment.count++;

			document.getElementById("content").value = "";



		}
	}else{
		if(!content) alert("内容必须"); 
		if(!name) alert("名字必须"); 


	}

	contentCompare(eid, content);

	if (sendcomment.count == 1) {
		getMessage();
		// $("#event-content").show();		
	};	
}
function getMessage() {

	var data = {eid:eid, lastid:lastid};
	$.post("../home/event/getMessage",data,function(data){var msg = eval(data);showComment(getMsg,msg);});
}

showComment.count = 0;

function showComment(type, data) {
	if(type==1) {
			var msg = "<ul id=\"comment\" class=\"comment\"><li class=\"reply-name\">"+":flushed:"+data.name+"</li><li class=\"reply-content\">"+data.content+"</li><li class=\"reply-time\">"+data.time+"</li></ul>";
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

		if (allmsg > showComment.count-1) {
			$("#getmessage").show();	
			$("#getmessage").text("显示剩余"+(allmsg-showComment.count)+"条评论");
		emojigo();

		};


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
	$.post("../home/event/messagecount",data, function(data){
		var html = "共有"+data+"条评论";
		$("#msgcount").html(html);
		allmsg = data;

	});

}

function eventCount() {
	var data = {eid:eid};
	$.post("../home/event/updateeventcount",data);

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

function contentCompare(eid, content) {
	var data = {eid:eid, content:content};
	$.post("../home/event/contentCompare",data,function(data){
		var result = eval('['+data+']');
		if (result[0].flag == "right") {
			status = 1;
		};
		if (result[0].flag == "wrong") {
			status = 0;
		};

		shownoticebox(result);

	});

}

function closethis() {

	$("#notice").fadeOut();

}

function shownoticebox(data) {
	var text = data[0].content;
	$("#notice-content").text(text);
	$("#notice").show();
	if (status==0) {
		setTimeout(function(){
			$("#notice").fadeOut();
		},3000);
	};
	if (status==1) {
		var text = document.getElementById("event-content").innerHTML;
		document.getElementById("notice-answer").innerHTML = text;
		$("#notice-event-content").show();

	};
}



