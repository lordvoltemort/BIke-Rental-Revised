<!--container-->

            <div class="container">


            <!--Wrap-->
            <div id="wrapReview">
            <div id="main">
            <div class="row">
            <div class="col-md-5">
            <h3 class="headingReview">Comments and Responses</h3>
            </div>
            <div class="col-md-7">
            <div id="upper_blank"></div>
            </div>
            </div>
            </div>

            <p id="pReview">Your email address will not be published. Required fields are marked *</p>

            <!--Form Start-->

            <div id='form'>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post" id="commentform" action="index.php">
                        <div id="comment-name" class="form-row">
                            <input type = "text" placeholder = "Name (required)" name = "name"  id = "nameReview" >
                        </div>
                        <div id="comment-email" class="form-row">
                            <input type = "text" placeholder = "Mail (will not be published) (required)" name = "email"  id = "emailReview">
                        </div>
                        <div id="comment-message" class="form-row">
                            <textarea name = "comment" placeholder = "Message" id = "commentReview" ></textarea>
                        </div>
                        <input type="submit" name="dsubmit" id="commentSubmit" value="Submit Comment">
                        <input style="width: 30px" type="checkbox" value="1" name="subscribe" id="subscribe" checked="checked">
                        <p1><b>Notify me when new comments are added.</b></p1>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!--Reply Section-->
            <div id="second">
                <div class="row">
                    <div class="col-md-2">
                        <h3 class="second_heading" id="flip"><b>Previous comment ...</b></h3>
                    </div>	
                    <div class="col-md-10">
                        <div class="blankReview"></div>
                    </div>
                </div>
            </div>
            <div id = 'panel' >
            <?php 
                    $con=mysqli_connect("localhost","Rahul","Koqa313*@3","testing");
                        // Check connection
                        if (mysqli_connect_errno())
                          {
                          echo "Failed to connect to MySQL: " . mysqli_connect_error();
                          }

                        $result = mysqli_query($con,"SELECT * FROM commentsection");
                        
                        echo "<table >";
                        while($row = mysqli_fetch_array($result))
                              {
                        //          echo "<tr> <td> " . $row['name'] . " </td><td> comment" . $row['comment'] . " </td> </tr>"; //these are the fields that you have stored in your database table employee
                                echo "<div id='middle'>";
                                echo "";
                                echo "<p style='color:red'>" . $row['name']." </p>";
                                echo " " . $row['comment']." <br>";
                                echo "<form>";
//                                echo "<input type = 'button' value = 'reply' name = 'dreply' id = 'inner_reply'>";
                                echo "</form>";
                                echo "</div>";
                              }
                         echo "</table>";
                        mysqli_close($con);
                 ?>
            
            	</div>

            </div>








            <?php
   if(isset($_POST['comment'])&&isset($_POST['name'])&&isset($_POST['email']))
    {
        $comment = trim($_POST['comment']);
        
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        
        if(!empty($comment)&&!empty($name)&&!empty($email))
        {
            //$qry = "INSERT INTO commentsection (comment ,name, email ) VALUES ( '$comment' , '$name', '$title')";
            $query = "INSERT INTO commentsection VALUES ('".mysqli_real_escape_string($mysql_connect,$name )."','".mysqli_real_escape_string($mysql_connect,$email )."','".mysqli_real_escape_string($mysql_connect, $comment)."')";
            if($query_run = mysqli_query($mysql_connect, $query))
            {
                header('Location: index.php');
            }
            else
            {
                echo 'Sorry, we couldn\'t register you at this time. Try again later.';
            }
        }
    }        
?>