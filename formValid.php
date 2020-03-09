
<!DOCTYPE HTML>
<html>
   <head>
     <style>
        .error {color: #FF0000;}
     </style>
   </head>
<body>

<?php
// define variables and set to empty values
$subjectErr = $lecturerErr = $descriptionErr = $categoryErr = $creditsErr = "";
$subject = $lecturer = $description = $category = $credits = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["subject"])) {
    $subjectErr = "Subject is required";
  } else {
    $subject = test_input($_POST["subject"]);
    // check if subject <= 150 characters
    if (strlen($subject) > 150) {
      $subjectErr = "Only <= 150 characters allowed";
    }
  }

  if (empty($_POST["lecturer"])) {
    $lecturerErr = "Lecturer is required";
  } else {
    $lecturer = test_input($_POST["lecturer"]);
    // check if lecturer name <= 200
    if (strlen($lecturer) > 200) {
      $lecturerErr = "Only <= 200 characters allowed";
    }
  }

  if (empty($_POST["description"])) {
    $descriptionErr = "Description is required";
  } else {
    $description = test_input($_POST["description"]);
    //check if description is at least 10 characters long
    if(mb_strlen($description) < 10){
      $descriptionErr = "Description must be at least 10 characters long";
    }
  }

  if (empty($_POST["category"])) {
    $categoryErr = "Category is required";
  } else {
    $category = test_input($_POST["category"]);
  }

  if (empty($_POST["credits"])) {
    $credits = "";
  } else{
    $credits = test_input($_POST["credits"]);
    //check if credits is a positive integer
    if (!is_numeric($credits) || $credits < 1 || $credits != round($credits)) {
        $creditsErr = "Credits must be a positive integer number";
     }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Add elective course</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="/add_course_81555.php">
  Subject: <input type="text" name="subject">
  <span class="error">* <?php echo $subjectErr;?></span>
  <br><br>
  Lecturer: <input type="text" name="lecturer">
  <span class="error">* <?php echo $lecturerErr;?></span>
  <br><br>
  Description: <textarea name="description" rows="10" cols="40"></textarea>
  <span class="error">* <?php echo $descriptionErr;?></span>
  <br><br>
  Category:
  <select name ="category">
     <option value="М">М</option>
     <option value="ПМ">ПМ</option>
     <option value="ОКН">ОКН</option>
     <option value="ЯКН">ЯКН</option>
  </select>
  <span class="error">* <?php echo $categoryErr;?></span>
  <br><br>
  Credits: <input type="text" name="credits">
  <span class="error"> <?php echo $creditsErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $subject;
echo "<br>";
echo $lecturer;
echo "<br>";
echo $description;
echo "<br>";
echo $category;
echo "<br>";
echo $credits;
?>

</body>
</html>
