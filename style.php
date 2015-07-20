<style type="text/css">
.anvita-enq .enq-msg{font-size:12px;}
.anvita-enq .enq-msg li{
	padding:0 5px; 
	list-style:none;
}
.anvita-enq .enq-msg.enq-shown{
	border:1px solid #ff0000;
	padding:5px;
}
.anvita-enq .enq-msg.enq-shown.enq-success{
border:1px solid #00a549;
}
.anvita-enq .enq-msg.enq-shown li{
	color:#ff0000;	
}
.anvita-enq .enq-msg.enq-shown.enq-success li{
color:#00a549;	
}
.anvita-enq hr{
padding:0; 
margin:5px 0;
}
.anvita-enq .enq-submit{
text-align:center;
margin:5px 0;
}
.anvita-enq .captcha{
	text-align:center;
}
.anvita-enq .enq-captchaimg{
	border:1px solid #ccc;
	width:55%;
}
.anvita-enq .enq-captcha{
	max-width:150px;
	min-height:30px;
}
.anvita-enq .enq-refresh{
	height:45px;
	cursor:pointer;
}
.anvita-enq .enq-refresh:active{
	position:relative;
	top:-1px;
}
.anvita-enq button.enq-button{
	background-color: #0392ff;
    border: 0;
    outline:0;
    padding:0;
    margin:0 auto;
    color: #FFF;
    cursor: pointer;
    height: 35px;
    width: 100px;
    font-size:13px;
    line-height:35px;
    box-shadow:0 0 2px #333;
}
.anvita-enq button.enq-button:hover{
	background-color:#299FF9;
}
.anvita-enq button.enq-button:active{
	position:relative;
	top:-1px;
}
.anvita-enq .enq-btn-deactive{
	background: #0392ff url('<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>loadingbtn.gif') no-repeat;
	  padding-left: 29px !important;
  background-position-y: center;
  background-size: 25px 25px;
  background-position-x: 4px;
}

.anvita-enq input,.enq-appointment textarea{
	margin:2px 0;
	width:100%;
	padding: 0.5278em;
	background:#F7F7F7;
	color:#707070;
	color:rgba(51, 51, 51, 0.7);
}
.anvita-enq input.enq-input,.anvita-enq textarea.enq-input{
	margin:2px 0;
	width:100%;
	padding: 0.5278em;
	background:#F7F7F7;
	color:#707070;
	color:rgba(51, 51, 51, 0.7);
}
.anvita-enq input.enq-input:focus{
  outline:0;
  background-color: #fff;
  border: 1px solid #c1c1c1;
  border: 1px solid rgba(51, 51, 51, 0.3);
  color: #333;
}



.anvita-enq .enq-error{
border:1px solid red;
}
.anvita-enq .enq-success{
	border:2px solid green;
	color:green;
	font-size:13px;
}
.anvita-enq .enq_msg{display:none;}
.anvita-enq .enq-shown {display:block;}
.anvita-enq .red{
	color:#DD4B39;
}
.anvita-enq .lightbg{background:#F3F3F3; padding:3px 10px;}
</style>