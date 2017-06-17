<form action="/add/executor" method="post" id="formTasks">
    <table border="1">
        <tr>
            <th>№</th>
            <th>Executor</th>
            <th>Tasks</th>
            <th>Date</th>
            <th>Time</th>
        </tr>

        <? $i = 1;
        foreach ($arrTasks as $elem): ?>
            <tr>
                <td>
                    <?php echo $i; ?>
                </td>

                <td>
                    <select id="myselect" name="executors[]">
                        <option></option>
                        <?php foreach ($users as $user): ?>
                            <option  value="task_<?= $elem['id'] ?>-user_<?= $user['id'] ?>" <?php if ($elem['id_user'] == $user['id']) echo ' selected="selected"'; ?>>
                                <?= $user['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input type="text" value="<?php echo $elem['task'] ?>" disabled>
                </td>
                <td>
                    <input type="date" id="myDate" value="<?php $date = new DateTime($elem['date']);
                    echo $date->format('Y-m-d'); ?>" disabled>
                </td>
                <td>
                    <input type="time" id="myTime" value="<?php $date = new DateTime($elem['date']);
                    echo $date->format('H:i:s'); ?>" disabled>
                </td>
            </tr>

            <?php $i++; endforeach; ?>

    </table>

    <p>
        <input type="submit" value="Save executors">
    </p>

</form>

