
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
               <li ><a href="about.php"><span class="glyphicon glyphicon-menu-hamburger"></span> About</a></li>
            
        

            <!-- Dropdown-->
            <li class="active" class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                       <span class="glyphicon glyphicon-menu-down"></span> Admin <span class="caret"></span>
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
<h2 align="center">Insert Question Into spelling word game</h2>  

<?php require('php/connection.php'); ?>
<?php

// include 'ChromePhp.php';
//this was used to debug php

$worked = "";
$question = $dropbox1 = $dropbox2 = $dropbox3 = $dropbox4 = $drag1 = $drag2 = $drag3 = $drag4 = $answer = "";
$questionerr = $dropbox1err = $dropbox2err = $dropbox3err = $dropbox4err = $drag1err = $drag2err = $drag3err = $drag4err = $answererr = $missingerr = "";

// check if input box was filled or not if not throw an error

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST["question"]))
	{
		$questionerr = "A question is required";
	}
	else
	{
		$question = mysqli_real_escape_string($link, $_POST['question']);
	}

	if (empty($_POST["dropbox1"]))
	{
		$dropbox1err = "A dropbox1 is required";
	}
	else
	{
		$dropbox1 = mysqli_real_escape_string($link, $_POST['dropbox1']);
	}

	if (empty($_POST["dropbox2"]))
	{
		$dropbox2err = "A dropbox2 is required";
	}
	else
	{
		$dropbox2 = mysqli_real_escape_string($link, $_POST['dropbox2']);
	}

	if (empty($_POST["dropbox3"]))
	{
		$dropbox3err = "A dropbox3 is required";
	}
	else
	{
		$dropbox3 = mysqli_real_escape_string($link, $_POST['dropbox3']);
	}

	if (empty($_POST["dropbox4"]))
	{
		$dropbox4err = "A dropbox4 is required";
	}
	else
	{
		$dropbox4 = mysqli_real_escape_string($link, $_POST['dropbox4']);
	}

	if (empty($_POST["drag1"]))
	{
		$drag1err = "A drag1 is required";
	}
	else
	{
		$drag1 = mysqli_real_escape_string($link, $_POST['drag1']);
	}

	if (empty($_POST["drag2"]))
	{
		$drag2err = "A drag2 is required";
	}
	else
	{
		$drag2 = mysqli_real_escape_string($link, $_POST['drag2']);
	}

	if (empty($_POST["drag3"]))
	{
		$drag3err = "A drag3 is required";
	}
	else
	{
		$drag3 = mysqli_real_escape_string($link, $_POST['drag3']);
	}

	if (empty($_POST["drag4"]))
	{
		$dropbox4err = "A drag4 is required";
	}
	else
	{
		$drag4 = mysqli_real_escape_string($link, $_POST['drag4']);
	}

	if (empty($_POST["answer"]))
	{
		$answererr = "A answer is required";
	}
	else
	{
		$answer = mysqli_real_escape_string($link, $_POST['answer']);
	}

	if ($question != "" && $dropbox1 != "" && $dropbox2 != "" && $dropbox3 != "" && $dropbox4 != "" && $answer != "" && $drag1 != "" && $drag2 != "" && $drag3 != "" && $drag4 != "")

	// attempt insert query execution

	{
		$sql = "INSERT INTO game2 (question, dropbox1, dropbox2,dropbox3,dropbox4, drag1, drag2, drag3, drag4,answer) VALUES ('$question', '$dropbox1', '$dropbox2', '$dropbox3', '$dropbox4','$drag1', '$drag2','$drag3', '$drag4','$answer');";
		$result = mysqli_query($link, $sql);
        $worked = "Operation successful!";
	}
	else
	{
		$missingerr = "Missing required inputs";
	}

	mysqli_close($link);
}

?>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  enctype="multipart/form-data" >
    <p>
        <label for="question">Input a Question that will inserted into the database for the spelling game:</label>
        <input type="text" name="question" id="question">
         <span class="error">* <?php
echo $questionerr ?></span>
    </p>
    <p>
        <label for="dropbox1">Which draggable is correct for dropbox1 in terms of drag1, drag2, drag3, drag4 : </label>
        <input type="text" name="dropbox1">
        <span class="error">* <?php
echo $dropbox1err ?></span>
    </p>
    <p>
        <label for="dropbox2">Which draggable is correct for dropbox2 in terms of drag1, drag2, drag3, drag4 : </label>
        <input type="text" name="dropbox2">
        <span class="error">* <?php
echo $dropbox2err ?></span>
    </p>
    <p>
        <label for="dropbox3">Which draggable is correct for dropbox3 in terms of drag1, drag2, drag3, drag4 :  </label>
        <input type="text" name="dropbox3">
        <span class="error">* <?php
echo $dropbox3err ?></span>
    </p>
 <p>
        <label for="dropbox4">Which draggable is correct for dropbox4 in terms of drag1, drag2, drag3, drag4 :  </label>
        <input type="text" name="dropbox4">
        <span class="error">* <?php
echo $dropbox4err ?></span>
    </p>
     <p>
        <label for="drag1">what is a possible answer that will go into the first dropbox in terms  of the letter of the word for example a,b,c : </label>
        <input type="text" name="drag1">
        <span class="error">* <?php
echo $drag1err ?></span>
    </p>
    <p>
        <label for="drag2">what is a possible answer that will go into the second dropbox in terms of the letter of the word for example a,b,c :  </label>
        <input type="text" name="drag2">
        <span class="error">* <?php
echo $drag2err ?></span>
    </p>
    <p>
        <label for="drag3">what is a possible answer that will go into the thrid dropbox in terms of the letter of the word for example a,b,c :  </label>
        <input type="text" name="drag3" >
        <span class="error">* <?php
echo $drag3err ?></span>
    </p>
 <p>
        <label for="drag4">what is a possible answer that will go into the forth dropbox in terms of the letter of the word for example a,b,c :  </label>
        <input type="text" name="drag4">
        <span class="error">* <?php
echo $drag4err ?></span>
    </p>
    <p>
        <label for="answer"> put the word that will be inserted in full for example fish or wolf:  </label>
        <input type="text" name="answer">
        <span class="error">* <?php
echo $answererr ?></span>
    </p>

    <input type="submit" value="Add Question">
    <br />
    <br />

     <span class="error"><?php
echo $missingerr ?></span>
   <span class="worked"><?php
echo $worked ?></span>
</form>
          
        </div>
    </div>
</div>

   

</body>

</html>