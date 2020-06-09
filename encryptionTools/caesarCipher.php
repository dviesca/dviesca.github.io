<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Caesar's Cipher</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style type="text/css">
		body 
    	{
    		background-color: #442c72;
    	}

    	h1, h2, label, small
    	{
    		color: white;
    	}

    	h3
    	{
    		color: black;
    	}

    	textarea
    	{
    		width: 90%;
    		height: 70%;
    	}

    	.btn
    	{
    		background-color: #725b2c;
    		border: none;
    		color: white;
    	}
    	
		#rot, #decryptRot
		{
			width: 30%;
		}

		.card
		{
			background-color: #8e71bf;
			padding: 10px;
			border-radius: 6px;
		}
	</style>

    <script>
    	$(document).ready(function(){
    		//TO ENCRYPT
			$("#encrypt").click(function() {
				var plaintext = $("#plaintext").val();
				var ciphertext = "";
				var rot = parseInt($("#rot").val());

				if (rot < 0 || rot > 25) 
				{
					$("#errorRotValue").html("Error: Rotation value must be between 0 and 25.");
					$("#errorRotValue").css('color', 'red');
					$("#errorRotValue").show();
					return true;
				}
				else
					$("#errorRotValue").hide();

				plaintext = plaintext.toLowerCase();
				var arrPlaintext = plaintext.split("");
				console.log(arrPlaintext);
				for (var i = 0; i <= arrPlaintext.length - 1; i++) 
				{
					console.log("letter is " + arrPlaintext[i].charCodeAt());
					if (arrPlaintext[i].charCodeAt() >= 97 && arrPlaintext[i].charCodeAt() <= 122) 
					{
						if((arrPlaintext[i].charCodeAt()+rot) > 122)
							arrPlaintext[i] = arrPlaintext[i].charCodeAt() - 26 + rot
						else
							arrPlaintext[i] = arrPlaintext[i].charCodeAt() + rot;

						console.log("Adding: " + String.fromCharCode(arrPlaintext[i]));
						ciphertext += String.fromCharCode(arrPlaintext[i]);
					}
					else
						ciphertext += arrPlaintext[i];
				}
				console.log("after for loop: " + ciphertext);

				$("#ciphertext").text(ciphertext);
			});

			//TO DECRYPT
			$("#decrypt").click(function() {
				var givenCiphertext = $("#givenCiphertext").val();
				var outputPlaintext = "";
				var decryptRot = parseInt($("#decryptRot").val());

				if (decryptRot < 0 || decryptRot > 25) 
				{
					$("#errorDecryptRotValue").html("Error: Rotation value must be between 0 and 25.");
					$("#errorDecryptRotValue").css('color', 'red');
					$("#errorDecryptRotValue").show();
					return true;
				}
				else
					$("#errorDecryptRotValue").hide();

				givenCiphertext = givenCiphertext.toLowerCase();
				var arrCiphertext = givenCiphertext.split("");
				console.log(arrCiphertext);
				for (var i = 0; i <= arrCiphertext.length - 1; i++) 
				{
					console.log("letter is " + arrCiphertext[i].charCodeAt());
					if (arrCiphertext[i].charCodeAt() >= 97 && arrCiphertext[i].charCodeAt() <= 122) 
					{
						if((arrCiphertext[i].charCodeAt()-decryptRot) > 122)
							arrCiphertext[i] = arrCiphertext[i].charCodeAt() - 26 - decryptRot
						else
							arrCiphertext[i] = arrCiphertext[i].charCodeAt() - decryptRot;

						console.log("Adding: " + String.fromCharCode(arrCiphertext[i]));
						outputPlaintext += String.fromCharCode(arrCiphertext[i]);
					}
					else
						outputPlaintext += arrCiphertext[i];
				}
				console.log("after for loop: " + outputPlaintext);

				$("#outputPlaintext").text(outputPlaintext);
			});
		});
	</script>
</head>
<body>

	<div class="row text-center">
		<div class="col-md">
			<br>
			<a class="btn btn-dark btn-sm" href="menu.php" role="button">Back</a>
		</div>
		<div class="col-md">
			<h1>Caesar's Cipher Encryptor</h1>
		</div>
		<div class="col-md"></div>
	</div>

	<br>
	
	<div class="container">
		<div class="card">
			<div class="row text-center">
				<div class="col-md"></div>
				<div class="col-md">
					<h3>Encrypt your message</h3>
				</div>
				<div class="col-md"></div>
			</div>

			<div class="row text-center">
				<div class="col-md">
					<label>Introduce your plaintext</label>
					<br>
					<textarea id="plaintext"></textarea>
				</div>

				<div class="col-md text-center">
					<label>Select the rotation value</label>
					<br>
					<small>Must be between 0 - 25</small>
					<br>
					<input type="number" id="rot" name="rot" max="25">
					<br>
					<br>
					<a id="encrypt" class="btn btn-info btn-lg" role="button">Encrypt!</a>
					<br>
					<br>
					<span class="inputError" id="errorRotValue"></span>
				</div>

				<div class="col-md">
					<label>Your ciphertext</label>
					<br>
					<textarea id="ciphertext" readonly></textarea>
				</div>
			</div>
		</div>

		<br>
		<br>

		<div class="card">
			<div class="row text-center">
				<div class="col-md"></div>
				<div class="col-md">
					<h3>Decrypt your message</h3>
				</div>
				<div class="col-md"></div>
			</div>

			<div class="row text-center">
				<div class="col-md">
					<label>Introduce your ciphertext</label>
					<br>
					<textarea id="givenCiphertext"></textarea>
				</div>

				<div class="col-md text-center">
					<label>Introduce the rotation value</label>
					<br>
					<small>Value used to encrypt. Must be between 0 - 25</small>
					<br>
					<input type="number" id="decryptRot" name="decryptRot" max="25">
					<br>
					<br>
					<a id="decrypt" class="btn btn-info btn-lg" role="button">Decript!</a>
					<br>
					<br>
					<span class="inputError" id="errorDecryptRotValue"></span>
				</div>

				<div class="col-md">
					<label>Your plaintext</label>
					<br>
					<textarea id="outputPlaintext" readonly></textarea>
				</div>
			</div>
		</div>
			
		</div>

</body>
</html>