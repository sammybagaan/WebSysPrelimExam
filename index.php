<!DOCTYPE html>
<html>
<head>
    <title>Minimal Grade Calculator</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1dbdbff;
            color: #bb8bb5ff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(16, 94, 238, 0.85);
        }
        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            font-size: 14px;
            color: #f3108262;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #eca4a4ff;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #dd61c2ff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #1d0e6dff;
        }
        .result {
            margin-top: 20px;
            background: #f1f1f1;
            padding: 15px;
            border-radius: 4px;
        }
        .result h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .error {
            margin-top: 15px;
            color: #d9534f;
            font-size: 14px;
        }
    </style>
    <?php
            //Kaya ko ito na kuya sir ang mga disegn at backround dahil sakto lang sa mga mata hindi masakit pag tinignan kahit parang pang bebae mahilig lang sa ganiyan kulay.//
     ?>       
</head>
<body>
<div class="container">
    <h1>Grade Calculator</h1>
    <p>Quiz (30%) | Assignment (30%) | Exam (40%)</p>

    <form method="POST">
        <div class="form-group">
            <label for="quiz">Quiz Score (0-100)</label>
            <input type="number" id="quiz" name="quiz" min="0" max="100" step="0.01" required
                   value="<?php echo isset($_POST['quiz'])?$_POST['quiz']:'';?>">
        </div>

        <div class="form-group">
            <label for="assignment">Assignment Score (0-100)</label>
            <input type="number" id="assignment" name="assignment" min="0" max="100" step="0.01" required
                   value="<?php echo isset($_POST['assignment'])?$_POST['assignment']:'';?>">
        </div>

        <div class="form-group">
            <label for="exam">Exam Score (0-100)</label>
            <input type="number" id="exam" name="exam" min="0" max="100" step="0.01" required
                   value="<?php echo isset($_POST['exam']) ? $_POST['exam']:'';?>">
        </div>
        <button type="submit" name="calculate">Calculate Grade</button>
    </form>
    <?php
        //Sir kailangan ng code na ito ang weighted average dahil hindi mabobou ang mga later or mga letra at grades base sa mga nakuhang nang mga bata sa quiz, assignment, at exam scores sir.//
        if (isset($_POST['calculate'])) {
        $quiz = $_POST['quiz'];
        $assignment = $_POST['assignment'];
        $exam = $_POST['exam'];
        $error = "";
        if (!is_numeric($quiz) || $quiz < 0 || $quiz > 100){
            $error = "Quiz score must be a number between 0 and 100.";
        } elseif (!is_numeric($assignment) || $assignment < 0 || $assignment>100){
            $error = "Assignment score must be a number between 0 and 100.";
        } elseif (!is_numeric($exam) || $exam < 0 || $exam > 100) {
            $error = "Exam score must be a number between 0 and 100.";
        }
        if (empty($error)){
            $weighted_average=($quiz*0.30)+($assignment*0.30)+($exam*0.40);
            if ($weighted_average>=90){
                $grade="A";
            } elseif($weighted_average>=80){
                $grade="B";
            } elseif($weighted_average>=70){
                $grade = "C";
            } elseif($weighted_average>=60){
                $grade="D";
            } else{
                $grade="F";
            }
            echo "<div class='result'>
                    <h2>Result</h2>
                    <p><strong>Weighted Average:</strong>".number_format($weighted_average,2)."</p>
                    <p><strong>Letter Grade:</strong> $grade</p>
                </div>";
        } else {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>
</div>
</body>
</html>