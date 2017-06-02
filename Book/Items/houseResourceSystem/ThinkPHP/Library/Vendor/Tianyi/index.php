
<html>
<head>
	<meta charset="utf-8">
	<title>短信测试</title>
</head>
<body>
	<form method="POST" action="./sendSMSAct.php">
		<fieldset>
			<p>
				<label>手机号</label>
				<input name="phone" type="text">
				<input type="submit" value="发送验证码">
			</p>
		</fieldset>
		<fieldset>
			<p>
				<label>验证码</label>
				<input type="text" name="code">
				<input type="submit" value="验证">

			</p>
		</fieldset>
	</form>
</body>
</html>