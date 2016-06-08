<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $data = isset($_POST) ? $_POST : '';
        $task = isset($_GET['task']) ? $_GET['task'] : '';

        // put your code here
        $con = mysqli_connect("localhost", "root", "", "training");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // Perform queries 
        $sql = "SELECT * FROM profile";
        ?>
        <table border="1">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Lastname</th>
                <th>Gendar</th>
                <th>Salary</th>
                <th>Manger</th>
            </tr>
            <?php
            if ($result = mysqli_query($con, $sql)) {
                while ($obj = mysqli_fetch_object($result)) {
                    echo '<tr>';
                    echo '<td>' . $obj->id . '</td>';
                    echo '<td>' . $obj->name . '</td>';
                    echo '<td>' . $obj->lastname . '</td>';
                    echo '<td>' . ($obj->gendar == 1 ? 'M' : 'F') . '</td>';
                    echo '<td>' . number_format($obj->salary) . '</td>';
                    echo '<td><form action="index.php?task=edit" method="POST"><input type="submit" value="Edit" /><input type="hidden" name="id" value="' . $obj->id . '" /></form><input type="button" value="Del" /></td>';
                    echo '</tr>';
                }
                // Free result set
                mysqli_free_result($result);
            }
            ?>

        </table>

        <br>
        <br>

        <?php
        if ($task === "add") :
            $sqlAdd = "INSERT INTO profile (name, lastname, gendar, salary) VALUE('" . $data['name'] . "','" . $data['lastname'] . "','" . $data['gendar'] . "','" . $data['salary'] . "')";
            if (mysqli_query($con, $sqlAdd)) {
                echo 'Inser Ok';
            } else {
                echo 'Cannot Insert';
            }
            ?> 
            <?php $taskid = 'add'; ?>
        <?php elseif ($task === "edit") : ?>
            <?php $sqlEdit = "SELECT * FROM profile WHERE 1 AND id = '" . $data['id'] . "'"; ?>
            <?php
            if ($result = mysqli_query($con, $sqlEdit)) {
                while ($obj = mysqli_fetch_object($result)) {
                    $a = $obj;
                }
                $taskid = 'editdata';
            }
            ?>
        <?php elseif ($task === "editdata"): ?>
            <?php
            $sqlEditdata = "UPDATE profile SET name='" . $data['name'] . "',lastname='" . $data['lastname'] . "',gendar='" . $data['gendar'] . "',salary='" . $data['salary'] . "' WHERE id='" . $data['ids'] . "'";
            if (mysqli_query($con, $sqlEditdata)) {
                echo 'Edit Ok';
            } else {
                echo 'Cannot Edit';
            }
            ?>
            <?php $taskid = 'add'; ?>
        <?php else : ?>
            <?php $taskid = 'add'; ?>
        <?php endif; ?>
        <form action="index.php?task=<?php echo $taskid; ?>" method="POST">
            <table border="1">
                <tr>
                    <td><input type="text" name="name" value="<?php echo isset($a->name) ? $a->name : ''; ?>" /></td>
                    <td><input type="text" name="lastname" value="<?php echo isset($a->lastname) ? $a->lastname : ''; ?>" /></td>
                    <td>
                        <select name="gendar">
                            <option value="0" <?php echo isset($a->gendar) ? $a->gendar == 0 ? 'selected' : '' : ''; ?>>F</option>
                            <option value="1" <?php echo isset($a->gendar) ? $a->gendar == 1 ? 'selected' : '' : ''; ?>>M</option>
                        </select>
                    </td>
                    <td><input type="text" name="salary" value="<?php echo isset($a->salary) ? $a->salary : ''; ?>" /></td>                    
                </tr>
            </table>
            <input type="hidden" name="ids" value="<?php echo isset($a->id)?$a->id:'';?>" />
            <input type="submit" value="ส่ง">
        </form>


        <?php mysqli_close($con); ?>
    </body>
</html>
