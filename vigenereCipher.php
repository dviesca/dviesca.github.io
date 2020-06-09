<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Vigenère Cipher</title>

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
				var key = $("#key").val();
				var arrKey = [];

				if(!/^[a-z]+$/.test(key))
				{
					$("#errorKeyValue").html("Error: Key value must contain only lowercase letters.");
					$("#errorKeyValue").css('color', 'red');
					$("#errorKeyValue").show();
					return true;
				}
				else
					$("#errorKeyValue").hide();

				plaintext = plaintext.toLowerCase();
				var arrPlaintext = plaintext.split("");

				//This is to create a mirror array of the key's repeated values and offset the key character
				j = 0;
				for (var i = 1; i <= arrPlaintext.length; i++) 
				{
					//console.log("i = " + i + " j = " + j)
					if (!/^[a-z]+$/.test(arrPlaintext[i-1])) 
					{
						arrKey.push(arrPlaintext[i-1]);

						continue;
					}

					if (j % key.length == 0) 
					{
						j = 0;

						if (arrPlaintext[i-1] == " ") 
						{
							arrKey.push(" ");

							continue;
						}
						else
						{
							arrKey.push(key[j]);
							j++;
						}
					}
					else
					{
						if (arrPlaintext[i-1] == " ") 
						{
							arrKey.push(" ");
						}
						else
						{
							arrKey.push(key[j]);
							j++;
						}
					}
				}
				console.log(arrPlaintext);
				console.log(arrKey);

				var rot = -9999;

				for (var i = 0; i <= arrPlaintext.length - 1; i++) 
				{

					if (arrPlaintext[i].charCodeAt() >= 97 && arrPlaintext[i].charCodeAt() <= 122) 
					{
						rot = Math.abs(arrPlaintext[i].charCodeAt() - 97);

						if((arrKey[i].charCodeAt()+rot) > 122)
							arrKey[i] = arrKey[i].charCodeAt() + rot - 26;
						else
						{

							arrKey[i] = arrKey[i].charCodeAt() + rot;
						}

						ciphertext += String.fromCharCode(arrKey[i]);
					}
					else
					{
						ciphertext += arrKey[i];

					}
				}
				console.log("after for loop: " + ciphertext);

				$("#ciphertext").text(ciphertext);
			});


			//TO DECRYPT
			$("#decrypt").click(function() {
				var givenCiphertext = $("#givenCiphertext").val();
				var outputPlaintext = "";
				var decryptKey = $("#decryptKey").val();
				var arrDecryptKey = [];

				if(!/^[a-z]+$/.test(decryptKey))
				{
					$("#errordecryptKeyValue").html("Error: Key value must contain only lowercase letters.");
					$("#errordecryptKeyValue").css('color', 'red');
					$("#errordecryptKeyValue").show();
					return true;
				}
				else
					$("#errordecryptKeyValue").hide();

				givenCiphertext = givenCiphertext.toLowerCase();
				var arrCiphertext = givenCiphertext.split("");

				//This is to create a mirror array of the key's repeated values and offset the key character
				j = 0;
				for (var i = 1; i <= arrCiphertext.length; i++) 
				{
					//console.log("i = " + i + " j = " + j)
					if (!/^[a-z]+$/.test(arrCiphertext[i-1])) 
					{
						arrDecryptKey.push(arrCiphertext[i-1]);

						continue;
					}

					if (j % decryptKey.length == 0) 
					{
						j = 0;

						if (arrCiphertext[i-1] == " ") 
						{
							arrDecryptKey.push(" ");

							continue;
						}
						else
						{
							arrDecryptKey.push(decryptKey[j]);
							j++;
						}
					}
					else
					{
						if (arrCiphertext[i-1] == " ") 
						{
							arrDecryptKey.push(" ");
						}
						else
						{
							arrDecryptKey.push(decryptKey[j]);
							j++;
						}
					}
				}
				console.log(arrCiphertext);
				console.log(arrDecryptKey);

				var decryptRot = -9999;

				for (var i = 0; i <= arrCiphertext.length - 1; i++) 
				{

					if (arrCiphertext[i].charCodeAt() >= 97 && arrCiphertext[i].charCodeAt() <= 122) 
					{
						decryptRot = Math.abs(arrCiphertext[i].charCodeAt() - arrDecryptKey[i].charCodeAt());
						alert("The rotation is: " + decryptRot);

						/*if((arrDecryptKey[i].charCodeAt()+decryptRot) > 122)
						{
							//110 + (110 - 116)/2
							arrDecryptKey[i] = 97 + decryptRot + (Math.abs(97 + decryptRot - arrDecryptKey[i].charCodeAt())) / 2;
							alert("overflow, arrDecryptKey["+i+"] is: " + arrDecryptKey[i]);
						}
						else*/
						
							arrDecryptKey[i] = 97 + decryptRot;
							alert("arrDecryptKey["+i+"] is: " + arrDecryptKey[i]);
						

						outputPlaintext += String.fromCharCode(arrDecryptKey[i]);
					}
					else
					{
						outputPlaintext += arrDecryptKey[i];
					}
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
			<a class="btn btn-primary btn-sm" href="index.php" role="button">Back</a>
		</div>
		<div class="col-md">
			<h1>Vigenère Cipher Encryptor</h1>
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
					<label>Introduce your key</label>
					<br>
					<small>Must be a word, lowercase, without spaces</small>
					<br>
					<input type="text" id="key" name="key" maxlength="20">
					<br>
					<br>
					<a id="encrypt" class="btn btn-primary btn-lg" role="button">Encrypt!</a>
					<br>
					<br>
					<span class="inputError" id="errorKeyValue"></span>
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
					<label>Introduce the key</label>
					<br>
					<small>Must be the key used to encrypt. <br> Must be a word, lowercase, without spaces</small>
					<br>
					<input type="text" id="decryptKey" name="decryptKey" maxlength="20">
					<br>
					<br>
					<a id="decrypt" class="btn btn-primary btn-lg" role="button">Decrypt!</a>
					<br>
					<br>
					<span class="inputError" id="errorDecryptKeyValue"></span>
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