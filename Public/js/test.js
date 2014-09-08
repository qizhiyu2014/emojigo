
var uid = localStorage.uid;
var eid = document.getElementById("event-id").value;
var lastid = 0;
var commentCount = 0;
var commentCountS = 0;
var showCount = 0;
var allmsg = 0;


// $(document).ready(function(){
// 	getMessageCount();
// 	eventCount();
// 	if(uid) {
// 		var data = {name:localStorage.name, uid:localStorage.uid};

// 		$.post("http://localhost/emojigo/home/event/getLocalStorage",data);

// 		setOnline();
// 	}else{
// 		var data = {};
// 		$.post("http://localhost/emojigo/home/event/getLocalStorage",data);
// 	}
// });




function sendcomment() {
	var content = $("#content").val();
	var name = $("#name").val();

	if(content&&name) {

		if(!uid) {
				var data = {name:name, content:content, eid:eid};

				createSmbox(data);

				$.post("http://localhost/emojigo/home/event/sendcomment",data,function(data){
						
						var msg = eval("["+data+"]");
						test = msg;
							if(localStorage) {
								localStorage.name 	= msg[0].nickname;
								localStorage.uid 	= msg[0].id;
								uid = msg[0].id;
								setOnline();
								localStorage.state 	= 1;
							}
						}
				);

				document.getElementById("content").value = "";
				document.getElementById("content").placeholder ="输入你的答案";

		}else{
			var data = {name:localStorage.name, content:content, eid:eid};
			$.post("http://localhost/emojigo/home/event/sendcomment",data);
			createSmbox(data);

			document.getElementById("content").value = "";
			document.getElementById("content").placeholder ="输入你的答案";



		}
	}else{
		if(!content) alert(1); 
		if(!name) alert(2); 


	}

	getMessageCount();

	if(commentCountS == 1){
		
		getMessage();
	
	}

}


function getMessage() {

	var data = {eid:eid, lastid:lastid};
	$.post("http://localhost/emojigo/home/event/getMessage",data,function(data){var msg = eval(data); showMessage(msg);});


}

function createSmbox(data) {
		
	if(commentCountS!=0) {
		var cmbox 	= document.getElementById("send-box");
		var ul 		= 	document.createElement("ul");
		var cm  	= 	document.getElementById("scomment");
		ul.id 		= "scomment";
		ul.className 	= "comment";

		cmbox.insertBefore(ul, cm);
		li = new Array(3);
		for (var i = 0; i < li.length; i++) {
			li[i] = document.createElement("li");
			ul.appendChild(li[i]);
		};
		li[0].id = "send-name"+commentCountS;	li[0].className = "reply-name";
		li[1].id = "send-content"+commentCountS;li[1].className = "reply-content";
		li[2].id = "send-time"+commentCountS;	li[2].className = "reply-time";

		document.getElementById("send-name"+commentCountS).innerHTML = data.name;
		document.getElementById("send-content"+commentCountS).innerHTML = data.content;
		document.getElementById("send-time"+commentCountS).innerHTML = now();
	};

	commentCountS++;

}

function createCmbox() {
	var cmbox 	= document.getElementById("comment-box");
	var ul 		= 	document.createElement("ul");
	ul.id 		= "comment";
	ul.className 	= "comment";

	cmbox.appendChild(ul);
	li = new Array(3);
	for (var i = 0; i < li.length; i++) {
		li[i] = document.createElement("li");
		ul.appendChild(li[i]);
	};
	li[0].id = "comment-name"+commentCount;		li[0].className = "reply-name";
	li[1].id = "comment-content"+commentCount;	li[1].className = "reply-content";
	li[2].id = "comment-time"+commentCount;		li[2].className = "reply-time";
	commentCount++;

}



function showMessage(data) {

	for (var i = 0; i < data.length; i++) {
		createCmbox();
		document.getElementById("comment-name"+showCount).innerHTML = data[i].nickname;
		document.getElementById("comment-content"+showCount).innerHTML = data[i].content;
		document.getElementById("comment-time"+showCount).innerHTML = data[i].publish_time;
		lastid = data[i].id;
		showCount++;


	};
	
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
		var online = document.getElementById("name")
		online.value = localStorage.name;
		online.readOnly = "true";

	}

}

function getMessageCount() {
	var data = {eid:eid};
	$.post("http://localhost/emojigo/home/event/messagecount",data, function(data){
		$("#msgcount").html(data);
		allmsg = data;

	});

}

function eventCount() {
	var data = {eid:eid};
	$.post("http://localhost/emojigo/home/event/updateeventcount",data);

}

function reply() {
   if (event.keyCode == "13") {
document.getElementById("sendbutton").click();
	}
}




