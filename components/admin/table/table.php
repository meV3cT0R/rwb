<div class="tableContainer">
    <table>
        <thead>
            <tr>
                <?php
                    if (isset($cols)) {
                        foreach($cols as $col) {
                            ?>
                            <th>
                                <?php 
                                    echo $col;
                                ?>
                            </th>
                            <?php
                        }

                    }
                ?>


            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($arr)) {
                for ($i = 0; $i < count($arr); $i++) {
                    ?>
                    <tr class=<?php if ($i % 2 == 0)
                        echo "even";
                    else
                        echo "odd"; ?>>

                        <?php
                            foreach($arr[$i] as $val) {
                                ?>
                                    <td>
                                        <?php echo $val; ?>
                                    </td>
                                <?php
                            }
                        ?>
                    </tr>

                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>