<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body {
            font-family: 'Nimbus Mono PS', 'Courier New', monospace;
            font-weight: normal;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            place-self: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 80%;
            width: 400px;
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input{
            font-family: 'Nimbus Mono PS', 'Courier New', monospace;
            font-weight: normal;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .response-container {
            place-self: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 63vw;
            width: max-content;
            min-width: 352px;
            text-align: center;
        }
        .response {
            margin-top: 20px;
        }
        .success, .error {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 10px;
        }
        .success {
            background-color: green;
        }
        .error {
            background-color: red;
        }
        ul {
            list-style-type: none;
            text-align: left;
            padding: 0;
        }
        .columnizer{
            display: grid;
        }
    </style>
</head>
<body>
    <div class="columnizer">
        <div class="container">
            <h1>Загрузка файла</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <br>
                <input type="submit" value="Загрузить файл" name="submit">
            </form>
        </div>
        <?php
        require_once 'utils.php';
        use TextProcessor\Utils;

        $utility = new Utils;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
            $target_dir = "files/";
            $target_file = $target_dir . $utility->sanitizeFileName($_FILES["fileToUpload"]["name"]);
            $uploadOk = true;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($fileType != "txt") {
                $uploadOk = false;
            }

            if ($uploadOk) {
                echo '<div class="response-container">';
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo '<div class="success"></div>';
                    $utility->processText($target_file);
                } else {
                    echo '<div class="error"></div>';
                }
                echo '</div>';
            } else {
                echo '<div class="response-container">';
                echo '<div class="error"></div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>