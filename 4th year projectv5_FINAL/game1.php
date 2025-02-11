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
                    <div class="imagearea">
                        <div id="picture"></div>
                    </div>
                    <div class="questionarea">
                        <div id="content">
                        </div>
                    </div>

                    <script>
                        // all varabiles for game1 spot the picture
                        var clock;
                        var startclock = 0;
                        var set = 0;
                        var score = 0;
                        var attempt = 0;
                        var limit = 0;
                        var start = 0;
                        var getscore = 0;
                        var showWin = 0;
                        var clicks = 1;
                        var startofgame1 = 0;
                        var maxrow;
                        var test;
                        var selectgame1 = 1;
                        var iscorrect = 0;
                        var alreadyasked = [];
                        var noquestionalreadyasked = 0;
                        var timer = 0;
                        // when document is ready to process
                        $(document).on("ready", function() {
                            // the menu is shown to the user and the user not started hide all game divs
                            if (startofgame1 == 0) {
                                $("#drag1").hide();
                                $("#drag2").hide();
                                $("#drag3").hide();
                                $("#drag4").hide();
                                $("#dropbox").hide();
                                $(".count").hide();
                                $("#score").hide();
                                $(".clock").hide();
                                $(".progressbararea").hide();
                            }
                            //at the start of the game load the previous score
                            if (getscore == 0) {
                                getPreviousScore();
                                getscore++;
                            }
                                // when the next button is clicked do the following:
                            $('#followbtn').on('click', function(e) {
                               // if its the first time clicking next unhide question
                               startofgame1 = 1;
                                if (startofgame1 == 1) {
                                    $("#drag1").fadeIn();
                                    $("#drag2").fadeIn();
                                    $("#drag3").fadeIn();
                                    $("#drag4").fadeIn();
                                    $("#dropbox").fadeIn();
                                    $(".count").fadeIn();
                                    $(".clock").fadeIn();
                                    $("#score").fadeIn();
                                    $(".progressbararea").fadeIn();
                                    $("#startofgame1").hide();
                                    $("#followbtn").hide();
                                    iscorrect = 0;

                                }


                                // this is for the flipclock.js so if its the start of the game start the clock otherwise skip.
                                $(document).ready(function() {
                                    if (startclock == 0) {
                                        clock = $('.clock').FlipClock(120, {
                                            clockFace: 'MinuteCounter',
                                            autoStart: true,
                                            countdown: true,
                                            callbacks: {
                                                stop: function() {
                                                    // if high score is less then current score UPDATE highscore and show throphy and ran out of time message
                                                    if (oldscore < (score)) {
                                                    console.log("old score is " + oldscore);
                                                    console.log("CURRENT score is " + score);
                                                    console.log("last highest score was less you win");
                                                        // console.log("last highest score was less you win");
                                                        showWin = 1;
                                                        timer = 1;
                                                        insertScoreAndWinValue(score, showWin, timer);
                                                    }
                                                    // if high score is GREATER then current score dont update highscore and  dont show throphy and ran out of time message
                                                    else {
                                                        // console.log("last highest score is more you lose");
                                                        showWin = 0;
                                                        timer = 1;
                                                        insertScoreAndWinValue(score, showWin, timer);
                                                    }
                                                    window.location = "game1_final.php ";
                                                }
                                            }

                                        });
                                        startclock++;
                                    }
                                });

                                // if the max limit of questions is reached check the last highest score was lower
                                //than the current score and showWin = 1 means you won otherwise you lose

                                if (limit == 10) {
                                    if (oldscore < (score)) {
                                        console.log("old score is " + oldscore);
                                        console.log("old score is " + score);
                                        console.log("last highest score was less you win");
                                        showWin = 1;
                                        timer = 0;
                                        insertScoreAndWinValue(score, showWin, timer);
                                    } else {
                                        //console.log("last highest score is more you lose");
                                        showWin = 0;
                                        timer = 0;
                                        insertScoreAndWinValue(score, showWin, timer);
                                    }
                                    window.location = "game1_final.php";
                                }
                                limit++;

                                // when next is clicked reset the attempt to 0 
                                attempt = 0;
                                //remove data from drag and dropbox divs
                                $("#drag1").empty();
                                $("#drag2").empty();
                                $("#drag3").empty();
                                $("#drag4").empty();
                                $("#content").empty();
                                e.preventDefault();
                                // reset the dropbox color to grey
                                if (set >= 1) {
                                    $("#dropbox").removeClass("incorrect")
                                    $("#dropbox").removeClass("correct")
                                    $("#dropbox").find("p")
                                    $("#dropbox").html("Drop me here");
                                }
                                // move all draggables to the orginial position
                                $("#drag1").animate({
                                    top: "0px",
                                    left: "0px"
                                });
                                $("#drag2").animate({
                                    top: "0px",
                                    left: "0px"
                                });
                                $("#drag3").animate({
                                    top: "0px",
                                    left: "0px"
                                });
                                $("#drag4").animate({
                                    top: "0px",
                                    left: "0px"
                                });
                                // re enable the draggables and dropbox
                                $('#drag1').draggable('enable')
                                $('#drag2').draggable('enable')
                                $('#drag3').draggable('enable')
                                $('#drag4').draggable('enable')
                                $('#dropbox').droppable('enable')

                                // call get getMaxRowThenSelect to get the maximum number of rows and then select the rows in the database 
                                // to start game1 spot the picture
                                getMaxRowThenSelect();
                            });
                        });
                    </script>
                    <script>
                    // if answered question correctly then show next button
                        function correct(iscorrect) {
                            if (iscorrect == 1) {
                                $("#followbtn").fadeIn();
                            }
                        }
                    </script>
                    <script>
                        // ajax is used here ajax calls a php file which in turn queries the sql database
                        // this code attempts to calculate the total number of max rows in the game1 sql table and returns a value and then the number is randomised
                        var getMaxRowThenSelect;
                        getMaxRowThenSelect = function() {
                            $.ajax({
                                type: "POST",
                                url: "getmaxrowsgame1.php",
                                data: {
                                    var1: selectgame1
                                }
                            }).done(function(data) {
                                //   console.log(data + "         data of array"); //this is working
                                users = JSON.parse(data);


                                for (var i in users) {

                                    maxrow = (users[i].maxrow);
                                    //console.log("maxrowsssssss      " + maxrow);
                                    test = parseInt(Math.floor(Math.random() * maxrow + 1));

                                    // console.log("test random    " + test);
                                }




                                // if question isnt already asked selectRowsForGameAndDisplay() method and parse and display it on the div
                                noquestionalreadyasked = 0;
                                // check questions already asked
                                for (var i = 0; i < alreadyasked.length; i++) {
                                    // if already asked then select a new question
                                    if (alreadyasked[i] == test) {
                                        getMaxRowThenSelect();
                                        noquestionalreadyasked = 1;
                                        break;
                                    }

                                }
                                // if not already asked parse and display it
                                if (noquestionalreadyasked == 0) {
                                    selectRowsForGameAndDisplay();
                                }

                            });

                        }
                        var users;
                        var i;
                        var loadData;
                        var result;
                        var imageref;
                        var answer1;
                        var answer2;
                        var answer3;
                        var answer4;



                        //using the random number call the selectRowsForGameAndDisplay method to select it from the database
                        // THEN display it on the correctly on the divs
                        function selectRowsForGameAndDisplay() {
                            $.ajax({
                                type: "POST",
                                url: "game1_select.php",
                                data: {
                                    var1: test
                                }
                            }).done(function(data) {
                                // console.log(data); //this is working
                                users = JSON.parse(data);
                                // go through the database row and place the data from the row in some places in html and in vars

                                for (var i in users) {
                                    $("#content").append("      " + clicks++ + "." + " " + users[i].question + "<br>");
                                    $("#drag1").append(users[i].answer1 + " " + "<br>");
                                    answer1 = (users[i].answer1);
                                    $("#drag2").append(users[i].answer2 + " " + "<br>");
                                    answer2 = (users[i].answer2);
                                    $("#drag3").append(users[i].answer3 + " " + "<br>");
                                    answer3 = (users[i].answer3);
                                    $("#drag4").append(users[i].answer4 + " " + "<br>");
                                    answer4 = (users[i].answer4);

                                    result = (users[i].correct);

                                    imageref = (users[i].images);

                                    // console.log("test " + test);

                                    //for debugging
                                    //console.log(answer1);
                                    //console.log(answer2);
                                    //console.log(answer3);
                                    //console.log(answer4);
                                    //console.log(result);
                                    //console.log("image test " + imageref);



                                }


                                // so the question that was selected put that in the array of already asked questions
                                alreadyasked.push(test);


                                //   console.log(" array of already asked question is    " + alreadyasked);




                                // display image method correctly
                                (function showImage() {
                                    var node = document.getElementById("picture");

                                    node.innerHTML = "<img id='picture' src=\"" + imageref + "\">";

                                })();

                            });
                        }
                    </script>
                    <script>
                        //when called it inserts the current score and win value for the current game showWin=0 means lose and showWin=1 means a win
                        var insertScoreAndWinValue;
                        insertScoreAndWinValue = function(score, showWin, timer) {
                            $.ajax({
                                type: "POST",
                                url: "insertScoreGame1.php",
                                data: {
                                    var1: score,
                                    var2: showWin,
                                    var3: timer
                                }
                            }).done(function(data) {
                                // console.log("scores!!!!!!!!!!           " + score); // 2



                            });
                        }
                    </script>
                    <script>
                        //when called gets the previous score from the last session
                        var oldscore;
                        var getPreviousScore;
                        getPreviousScore = function() {
                            $.ajax({
                                type: "GET",
                                url: "getScoreGame1.php",
                            }).done(function(data) {
                                //  console.log(data + "data of scores array "); //this is working
                                users = JSON.parse(data);


                                for (var i in users) {

                                    oldscore = (users[i].oldscore);

                                    //console.log("what was score         " + oldscore);
                                }
                            });
                        }
                    </script>

                    <script>
                        // scorei = scoreincrements checks the attempt of the user and increments the score value and then calls the countup function which displays that in html
                        function scorei(attempt) {
                            if (attempt == 0) {
                                score = score + 3;
                                //     console.log(score);
                                countUp(score);

                            } else if (attempt == 1) {
                                score = score + 2;
                                countUp(score);

                            } else if (attempt > 1) {
                                score++;
                                countUp(score);

                            }
                        }
                    </script>
                    <script>
                        // gets the score value from scorei and increments it in the html
                        function countUp(count) {
                            $display = $('.count'),

                                int = setInterval(function() {

                                    if (parseInt($display.text()) < count) {
                                        var curr_count = parseInt($display.text()) + 1;
                                        $display.text(curr_count);
                                    }
                                }, null);
                        }
                    </script>
                    <script>
                        // these are the conditions for when a draggable in the game1 should revert
                        $(function() {
                            var shouldRevert = function(droppable) { //function to see if a question box should revert to its original location
                                if (droppable == false) { //if box is not the target area, it should revert.
                                    return true
                                }
                            }

                            //setup the draggables and dropbox
                            $("#drag1").draggable({
                                revert: shouldRevert
                            });
                            $("#drag2").draggable({
                                revert: shouldRevert
                            });
                            $("#drag3").draggable({
                                revert: shouldRevert
                            });
                            $("#drag4").draggable({
                                revert: shouldRevert
                            });
                            $("#dropbox").droppable({

                                activeClass: "ui-state-default",
                                hoverClass: "ui-state-hover",

                                drop: function(event, ui) {
                                    if (ui.draggable.attr('id') == result) //if the "correct" element is true, then this droppable is the right answer
                                    {
                                        $(this)
                                            .removeClass("incorrect")
                                            .removeClass("incorrect")
                                            .addClass("correct") //If the answer if the correct one, add a new class called "correct"

                                        $("#dropbox").find("p")
                                        $("#dropbox").html("correct!"); //print to droppable box

                                        // play well done sound
                                        var sound = new Howl({
                                            urls: ['helpsound/right.mp3']
                                        }).play();

                                        // disable the dropbox and dragables
                                        $('#drag1').draggable('disable');
                                        $('#drag1').css('opacity', '1');
                                        $('#drag2').draggable('disable');
                                        $('#drag2').css('opacity', '1');
                                        $('#drag3').draggable('disable');
                                        $('#drag3').css('opacity', '1');
                                        $('#drag4').draggable('disable');
                                        $('#drag4').css('opacity', '1');
                                        $('#dropbox').droppable("disable");
                                        $('#dropbox').css('opacity', '1');

                                        // set this to know to reset colours of the dropbox later when click next
                                        set++;
                                        //increase score
                                        scorei(attempt);
                                        // its correct so show next button
                                        iscorrect++;
                                        correct(iscorrect);
                                    } else //if the "correct" element is false, then this droppable is the wrong answer
                                    {
                                        $(this)
                                            .removeClass("correct")
                                            .addClass("incorrect") //adds the .incorrect class to the target area. Turns it red, and prints incorrect.
                                        $("#dropbox").find("p") //finds a <p> tag for writing to the target box
                                        $("#dropbox").html("incorrect"); //print to droppable box
                                        // play wrong sound
                                        var sound = new Howl({
                                            urls: ['helpsound/wrong.mp3']
                                        }).play();
                                        // move draggable to start position
                                        ui.draggable.animate({
                                            top: "0px",
                                            left: "0px"
                                        });
                                        set++; // set is for reseting the dropbox color if it is set or greater than 1 then when the user clicks next it will turn grey  for the next question                    

                                        if (attempt < 3) // if attempt is lessthan 3 then increment attempt
                                        {
                                            attempt++;

                                        }
                                    }
                                }
                            });
                        });
                    </script>
                    <div class="scorearea">
                        <div class="count">0</div>
                        <div id="score">Score</div>

                    </div>
                    <div class="progressbararea">
                        <div id="v-center-basic">

                            <div class="fixed-height-250">
                                <div class="progress vertical bottom">
                                    <div class="progress-bar" role="progressbar" data-transitiongoal="0"></div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('.next').click(function() {
                                        // this manages the sidebar when next is clicked increment the bar and fill it up...
                                        var $pb = $('#v-center-basic .progress-bar');
                                        if (limit == 1) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 10).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 2) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 20).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 3) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 30).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 4) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 40).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 5) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 50).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 6) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 60).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 7) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 70).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 8) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 80).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 9) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 90).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                        if (limit == 10) {
                                            $('#v-center-basic .progress-bar').attr('data-transitiongoal', 100).progressbar({
                                                display_text: 'center'
                                            });
                                        }
                                    });
                                    $('#v-center-basic-reset').click(function() {
                                        $('#v-center-basic .progress-bar').attr('data-transitiongoal', 0).progressbar({
                                            display_text: 'center'
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="startgame1">
                        <div id="startofgame1">
                            <p> Welcome to Spot the picture game!</p>
                            <p> Try to see if you can Match the correct picture with the correct words!</p>
                            <p> Have fun!</p>
                        </div>
                    </div>
                    <div class="dragdropgame1">

                        <div id='drag1' class='ui-widget-content'></div>

                        <div id='drag2' class='ui-widget-content'></div>

                        <div id='drag3' class='ui-widget-content'></div>

                        <div id='drag4' class='ui-widget-content'></div>


                        <div id="dropbox" class="ui-widget-header">
                            <p>Drop here</p>
                        </div>
                    </div>
                    <div class="next">
                        <div><a href="#" id="followbtn">Next</a></div>

                    </div>


                    <span></span>
                    <div class="clockarea" align="center" style="margin:2em;">

                        <div class="clock" align="center" style="margin:2em;"></div>
                        <div class="message"></div>
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $("#Accordion1").accordion({
                                active: false,
                                collapsible: true
                            });
                        });
                    </script>
                    <script>
                        // sound plugin
                       /* var sound = new Howl({
                            urls: ['helpsound/soundtrack.mp3'],
                            loop: true,
                        }).play(); */
                    </script>
                    <div align="center" class="helparea" style="margin:2em;">


                        <style>
                            .wrap {
                                margin-top: 1%
                            }
                        </style>
                        <div class="wrap">
                            <div id="Accordion1">

                                <h3><b><a href="#">Help</a></b></h3>
                                <div>
                                    <button id="jp-play">play</button>
                                    <script>
                                        // sound of how to play game1
                                        var help = new Howl({
                                            urls: ['helpsound/game1help.mp3']
                                        })
                                        $(document).ready(function() {
                                            $("#jp-play").click(function() {
                                                help.play()
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    </body>

                </div>
            </div>
</div>
</body>

</html>