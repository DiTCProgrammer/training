<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'lib/function.php';

$data = new MainFunction();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EX 3</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
            (function ($) {
                $(function () {
                    $('.btnedit').on('click', function () {
                        console.log('Start');
                        var dataid = $(this).data('id');
                        $('input[name="name"]').find('*[data-id="' + dataid + '"]').attr('readonly',false);
                    });
                });
            })(jQuery);
        </script>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Lastname</th>
                <th>Gendar</th>
                <th>Salary</th>
                <th>Manger</th>
            </tr>
            <?php if ($data->getMainData()) : ?>
                <?php foreach ($data->getMainData() as $obj) : ?>
                    <tr>
                        <td><?php echo $obj->id; ?></td>
                        <td><input type="text" name="name" data-id="<?php echo $obj->id; ?>" value="<?php echo $obj->name ? $obj->name : ''; ?>" readonly /></td>
                        <td><input type="text" name="lastname" data-id="<?php echo $obj->id; ?>" value="<?php echo $obj->lastname ? $obj->lastname : ''; ?>" readonly /></td>
                        <td>
                            <select name="gendar" disabled data-id="<?php echo $obj->id; ?>">
                                <option value="0" <?php echo($obj->gendar == 0 ? 'selected' : ''); ?>>M</option>
                                <option value="1" <?php echo($obj->gendar == 0 ? 'selected' : ''); ?>>F</option>
                            </select>
                        </td>
                        <td><input type="text" name="salary" data-id="<?php echo $obj->id; ?>" value="<?php echo $obj->salary ? number_format($obj->salary) : ''; ?>" readonly /></td>
                        <td><input type="button" class="btnedit" data-id="<?php echo $obj->id; ?>" value="Edit" /><input type="button" value="Del" data-id="<?php echo $obj->id; ?>" /></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </body>
</html>