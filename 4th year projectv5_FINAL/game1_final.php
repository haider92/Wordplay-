<?php require( 'header/header.php'); ?>
<!-- Main Menu -->
<div class="side-menu-container">
    <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-menu-hamburger"></span>Home</a></li>
        <li class="active"><a href="games_menu.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Interactive Games </a></li>
        <li><a href="rewards.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Rewards </a></li>
        <li><a href="whiteboard.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Whiteboard </a></li>
        <li><a href="lessons_menu.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Lessons</a></li>
        <li><a href="about.php"><span class="glyphicon glyphicon-menu-hamburger"></span> About</a></li>
        <!-- Dropdown-->
        <li class="panel panel-default" id="dropdown">
            <a data-toggle="collapse" href="#dropdown-lvl1">
                <span class="glyphicon glyphicon-menu-down"></span> Admin <span class="caret"></span>
            </a>
            <?php require( 'header/dropdown1.php'); ?>
            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body">
                    <div id="header">
                        <h1> WordPlay!</h1>
                    </div>

                    <script>
                        var Win;
                        var score;
                        var oldscore;
                        var getScoreAndWinData;
                        var updateHighScore;
                        var showWin=0;
                        var timer;
                        $(document).on("ready", function() {

                            // get scores and win data from game1
                            getScoreAndWinData();
                            // if the current score is bigger than than the last high score update new highest score
                            if(oldscore <= (score - 1)) {
                                timer=0;
                                updateHighScore(score,timer);
                            }
                            // if you didnt win dont show trophy
                            if(showWin == 0) {
                                $("#scoreresultwin").hide();
                                $(".countresult3").hide();

                            }
                            else
                            {
                                // play you win a trophy sound
                                var sound = new Howl({
                                urls: ['helpsound/win.mp3']
                                }).play();
                            }
                            // if you beat the game1 before timer runs out hide it
                            if(timer == 0) {
                                $("#showtimer").hide();

                            }
                             // when to play what sound.
                            if(timer == 0 && showWin ==1) 
                            {
                                // play you win a trophy sound
                                var sound = new Howl({
                                urls: ['helpsound/win.mp3']
                                }).play();
                            }
                            else if(timer == 1 && showWin ==0) 
                            { 
                               // play you ran out of time sound
                                var sound = new Howl({
                                urls: ['helpsound/notime.mp3']
                                }).play();
                            }
                            
                        });
                    </script>
                    <script>
                        // get scores and win data from game1
                        getScoreAndWinData = function() {
                                $.ajax({
                                    async: false,
                                    cache: false,
                                    type: "GET",
                                    url: "getScoreGame1.php",
                                }).done(function(data) {
                                    users = JSON.parse(data);

                                    // the data from the sql database row in the correct html div
                                    for(var i in users) {

                                        $(".countresult").append(users[i].score);
                                        score = (users[i].score);
                                        $(".countresult2").append(users[i].oldscore);
                                        oldscore = (users[i].oldscore);
                                        $(".countresult3").append(users[i].Win);
                                        Win = (users[i].Win);
                                        showWin = (users[i].showWin);
                                        timer = (users[i].Timer);
                                        //for debugging
                                        // console.log("what was win         " + Win);
                                       // console.log("what was showin         " + showWin);
                                       // console.log("what was timer         " + timer);
                                       // console.log("what was score         " + score);
                                       // console.log("what was oldscore         " + oldscore);
                                    }
                                });
                            }
                    </script>


                    <script>
                        // update new highest score
                        updateHighScore = function(score,timer) {
                            $.ajax({
                                async: false,
                                cache: false,
                                type: "POST",
                                url: "insertScoreGame1newhighscore.php",
                                data: {
                                    var1: score,
                                    var2: timer
                                    
                                }
                            }).done(function(data) {
                                //console.log("scores           " + score); // 2



                            });
                        }
                    </script>
                    
                    <br>
                    <br>
                    <div id="replay" class="center-block ">What to do next?</div>
                    <div><a href="game1.php" class="center-block " id="replay">Replay spot the picture</a></div>
                    <div id="replay" class="center-block ">OR</div>
                    <div><a href="games_menu.php" class="center-block " id="replay">Go back to games menu</a></div>
           
                    
                    <div class="endofgame">
                        <div id="scoreresultwin">You beat your previous score! You won a trophy<img src="siteimages\trophy.png" width="100px" height="100px" class="center-block "></div>
                        <div class="countresult3"></div>
                           <div id="showtimer">Sorry. You ran out of time...</div>
                        <div id="scoreresult"> Your score is:</div>
                        <br>
                        <div class="countresult"></div>
                        <div id="scoreresult">Your previous highest score was:</div>
                        <br>
                        <div class="countresult2"></div>
                        
                        <div id="scoreresult">Share on social media:</div>
                        <a href="http://twitter.com/share?text=An%20Awesome%20Link&url=http://localhost/4th%20year%20projectv2/redirect.html">

                            <img src="siteimages\twitter.png" alt="World Wide Web Consortium Home" width="72" height="46" border="0" hspace="50" /></a>
                        <a href="http://www.facebook.com/sharer.php?u=http://localhost/4th%20year%20projectv3/redirect.html">
                            <img src="siteimages\fb.png" alt="World Wide Web Consortium Home" width="72" height="46" border="0" /></a>
                            <br><br><br>
                    </div>
                </div>
            </div>
</div>

</body>

</html>