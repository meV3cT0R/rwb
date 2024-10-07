<head>
    <style>
        .tableContainer {
            position: relative;
        }

        .add-data-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 24px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .add-data-button:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

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
                    <tr class=<?php if ($i % 2 == 0) echo "even"; else echo "odd"; ?>>
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

<a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) . '/create'; ?>" class="add-data-button">
    <i class="fa fa-plus"></i> 
</a>