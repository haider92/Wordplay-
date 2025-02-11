
<?php
require ('header/header.php');

?>
<body>
<!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">
            
            <li><a href="index.php"><span class="glyphicon glyphicon-menu-hamburger"></span>Home</a></li>
            <li><a href="games_menu.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Interactive Games </a></li>
               <li><a href="rewards.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Rewards </a></li>
              <li><a href="whiteboard.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Whiteboard </a></li>
              <li><a href="lessons_menu.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Lessons</a></li>
               <li><a href="about.php"><span class="glyphicon glyphicon-menu-hamburger"></span> About</a></li>
            
        

            <!-- Dropdown-->
           <li class="active" class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                       <span  class="glyphicon glyphicon-menu-down"></span> Admin <span class="caret"></span>
                </a>  
<?php
require ('header/dropdown1.php');

?>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        <div id="header">

           <h1> WordPlay!</h1>
        </div>

<style>
.error {color: #FF0000;}
.worked {color: #004c00;}
</style>
<h2 align="center">Update Question In Spot the picture game</h2>  
<?php

// include 'ChromePhp.php';
// this was used to debug php

/*
Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password)
*/
$link = mysqli_connect("localhost", "root", "secret", "wordplay_demo");

// Check connection

if ($link === false)
{
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

define("MAX_SIZE", "1000");

function getExtension($str)
{
	$i = strrpos($str, ".");
	if (!$i)
	{
		return "";
	}

	$l = strlen($str) - $i;
	$ext = substr($str, $i + 1, $l);
	return $ext;
}

$worked = "";
$imageerr = "";
$game1ID = $question = $answer1 = $answer2 = $answer3 = $answer4 = $correct = $newname = "";
$game1IDerr = $questionerr = $answer1err = $answer2err = $answer3err = $answer4err = $correcterr = $missingerr = "";

// check if input box was filled or not if not throw an error

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST["game1ID"]))
	{
		$game1IDerr = "A game1ID is required";
	}
	else
	{
		$game1ID = mysqli_real_escape_string($link, $_POST['game1ID']);
	}

	if (empty($_POST["question"]))
	{
		$questionerr = "A question is required";
	}
	else
	{
		$question = mysqli_real_escape_string($link, $_POST['question']);
	}

	if (empty($_POST["answer1"]))
	{
		$answer1err = "A answer1 is required";
	}
	else
	{
		$answer1 = mysqli_real_escape_string($link, $_POST['answer1']);
	}

	if (empty($_POST["answer2"]))
	{
		$answer2err = "A answer2 is required";
	}
	else
	{
		$answer2 = mysqli_real_escape_string($link, $_POST['answer2']);
	}

	if (empty($_POST["answer3"]))
	{
		$answer3err = "A answer3 is required";
	}
	else
	{
		$answer3 = mysqli_real_escape_string($link, $_POST['answer3']);
	}

	if (empty($_POST["answer4"]))
	{
		$answer4err = "A answer4 is required";
	}
	else
	{
		$answer4 = mysqli_real_escape_string($link, $_POST['answer4']);
	}

	if (empty($_POST["correct"]))
	{
		$correcterr = "A correct is required";
	}
	else
	{
		$correct = mysqli_real_escape_string($link, $_POST['correct']);
	}

	// check image was of right size and accpeted extensions if conditions not met then throw error

	$image = $_FILES['image']['name'];
	if ($image)
	{
		$filename = stripslashes($_FILES['image']['name']);
		$extension = getExtension($filename);
		$extension = strtolower($extension);
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "JPG") && ($extension != "JPEG") && ($extension != "PNG") && ($extension != "GIF"))
		{
			$imageerr = "image is of Unknown extension!";
		}
		else
		{
			$size = filesize($_FILES['image']['tmp_name']);
			if ($size > MAX_SIZE * 1024)
			{
				$imageerr = "You have exceeded the size limit!";
			}

			$image_name = time() . '.' . $extension;
			$newname = "images/" . $image_name;
			$copied = copy($_FILES['image']['tmp_name'], $newname);
			if (!$copied)
			{
				$imageerr = "Failed to copy image!";
			}
		}
	}
	else
	{
		$imageerr = "A image is required";
	}

	if ($question != "" && $answer1 != "" && $answer2 != "" && $answer3 != "" && $answer4 != "" && $correct != "" && $imageerr == "" && $game1ID != "")
	{
        // delete old image from images folder
        $sqlimage = "SELECT * FROM  game1  WHERE game1ID='$game1ID';";
        $imageresult = mysqli_query($link, $sqlimage);
        $row=mysqli_fetch_array($imageresult, MYSQLI_ASSOC);
        @unlink($row["images"]);
		
        
        // attempt UPDATE query execution
        $sql = "UPDATE game1 SET game1ID='$game1ID', question='$question', answer1='$answer1',answer2='$answer2', answer3='$answer3', answer4='$answer4', correct='$correct',images='" . $newname . "' WHERE game1ID='$game1ID';";
		$result = mysqli_query($link, $sql);
		$worked = "Operation successful!";
	}
	else
	{
		$missingerr = "Missing required inputs";
	}

	// close connection

	mysqli_close($link);
}

?>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  enctype="multipart/form-data" >
    <p>
        <label for="game1ID"> What row do you want updated in the spot the picture game:</label>
        <input type="text" name="game1ID" id="game1ID">
         <span class="error">* <?php
echo $game1IDerr ?></span>
    </p>
    <p>
        <label for="question">Input a Question that will updated into the database for spot the picture game:</label>
        <input type="text" name="question" id="question">
         <span class="error">* <?php
echo $questionerr ?></span>
    </p>
    <p>
        <label for="answer1">Possible Answer 1: </label>
        <input type="text" name="answer1" id="answer1">
        <span class="error">* <?php
echo $answer1err ?></span>
    </p>
    <p>
        <label for="answer2">Possible Answer 2: </label>
        <input type="text" name="answer2" id="answer2">
        <span class="error">* <?php
echo $answer2err ?></span>
    </p>
    <p>
        <label for="answer3">Possible Answer 3: </label>
        <input type="text" name="answer3" id="answer3">
        <span class="error">* <?php
echo $answer3err ?></span>
    </p>
    <p>
        <label for="answer4">Possible Answer 4:</label>
        <input type="text" name="answer4" id="answer4">
        <span class="error">* <?php
echo $answer4err ?></span>
    </p>
    <p>
        <label for="correct">Which draggable is the correct one eg drag1, drag2, drag3, drag4:</label>
        <input type="text" name="correct" id="correct">
        <span class="error">* <?php
echo $correcterr ?></span>
    </p>
    <p> 
    <input type="file" name="image" id="image" size="40">
    <span class="error">* <?php
echo $imageerr ?></span>
    </p>
    <input type="submit" value="Update Question">
      
    <br />
    <br />

     <span class="error"><?php
echo $missingerr ?></span>
        <span class="worked"><?php
echo $worked
?></span>
</form>
          
        </div>
    </div>
</div>

   

</body>

</html>
