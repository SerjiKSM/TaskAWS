<form action="" method="post" id="" >
    <table border="1" >
        <tr>
            <th>№</th>
            <th>Executor</th>
            <th>Tasks</th>
            <th>Date</th>
            <th>Time</th>
            <th>Done</th>
        </tr>
        <?php $i = 1;
        foreach ($allTasks as $elem): ?>
            <tr>
                <td >
                    <input type="text" value="<?php echo $i; ?>" readonly >
                </td>
                <td>
                    <input  name="" type="text" value="<?php echo $elem['name'] ?>" readonly>
                </td>
                <td>
                    <input  type="text" value="<?php echo $elem['task'] ?>" readonly>
                </td>
                <td>
                    <input type="date" id="myDate" value="<?php $date = new DateTime($elem['date']);
                    echo $date->format('Y-m-d'); ?>" readonly>
                </td>
                <td>
                    <input type="time" id="myTime" value="<?php $date = new DateTime($elem['date']);
                    echo $date->format('H:i:s'); ?>" readonly>
                </td>
                <td>
                    <input type="checkbox" name="done[]" value="<?php echo $elem['id']?>" <?php if($elem['done'])echo ' checked="checked" '?>  disabled >
                </td>
            </tr>
            <?php $i++; endforeach; ?>
    </table>
   
</form>
