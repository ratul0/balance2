<html>
<head>
	<title>Balance Transfer Application</title>
</head>
<body>
	<h1>welcome {{$username}}</h1>
	<p>Click Here To varify Your Email:</p>
	{{URL::route('mail.varification',$code)}}
</body>
</html>