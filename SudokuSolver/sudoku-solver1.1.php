<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sudoku Solver</title>
    <link rel="stylesheet" href="styles.css">
    
</head>

<body>
    <?php
    $_sudokuGrid = array(
                        array(),
                        array(),
                        array(),
                        array(),
                        array(),
                        array(),
                        array(),
                        array(),
                        array()
                    );
    
    $_htmlRow = $htmlColumn = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $_sudokuGrid = array(
                    array($_POST["r1c1"],$_POST["r1c2"],$_POST["r1c3"],$_POST["r1c4"],$_POST["r1c5"],$_POST["r1c6"],$_POST["r1c7"],$_POST["r1c8"],$_POST["r1c9"]),
                    array($_POST["r2c1"],$_POST["r2c2"],$_POST["r2c3"],$_POST["r2c4"],$_POST["r2c5"],$_POST["r2c6"],$_POST["r2c7"],$_POST["r2c8"],$_POST["r2c9"]),
                    array($_POST["r3c1"],$_POST["r3c2"],$_POST["r3c3"],$_POST["r3c4"],$_POST["r3c5"],$_POST["r3c6"],$_POST["r3c7"],$_POST["r3c8"],$_POST["r3c9"]),
                    array($_POST["r4c1"],$_POST["r4c2"],$_POST["r4c3"],$_POST["r4c4"],$_POST["r4c5"],$_POST["r4c6"],$_POST["r4c7"],$_POST["r4c8"],$_POST["r4c9"]),
                    array($_POST["r5c1"],$_POST["r5c2"],$_POST["r5c3"],$_POST["r5c4"],$_POST["r5c5"],$_POST["r5c6"],$_POST["r5c7"],$_POST["r5c8"],$_POST["r5c9"]),
                    array($_POST["r6c1"],$_POST["r6c2"],$_POST["r6c3"],$_POST["r6c4"],$_POST["r6c5"],$_POST["r6c6"],$_POST["r6c7"],$_POST["r6c8"],$_POST["r6c9"]),
                    array($_POST["r7c1"],$_POST["r7c2"],$_POST["r7c3"],$_POST["r7c4"],$_POST["r7c5"],$_POST["r7c6"],$_POST["r7c7"],$_POST["r7c8"],$_POST["r7c9"]),
                    array($_POST["r8c1"],$_POST["r8c2"],$_POST["r8c3"],$_POST["r8c4"],$_POST["r8c5"],$_POST["r8c6"],$_POST["r8c7"],$_POST["r8c8"],$_POST["r8c9"]),
                    array($_POST["r9c1"],$_POST["r9c2"],$_POST["r9c3"],$_POST["r9c4"],$_POST["r9c5"],$_POST["r9c6"],$_POST["r9c7"],$_POST["r9c8"],$_POST["r9c9"])
                );
        
        
    }
    //fill in empty spaces with zeros
        for ($row = 0; $row < 9; $row++) {
            for ($col = 0; $col < 9; $col++){
                if (empty($_sudokuGrid[$row][$col])) {
                    $_sudokuGrid[$row][$col] = "0";
                }
            }
        }
    ?>
    <div class="solver">
        <h1>Sudoku Solver</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <table class="sudoku-grid" id="sudokuGrid">
                <tr><?php $htmlRow=0; ?>
                    <td class="r1 c1 b1"><input type="number" name="r1c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c2 b1"><input type="number" name="r1c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c3 b1"><input type="number" name="r1c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c4 b2"><input type="number" name="r1c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c5 b2"><input type="number" name="r1c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c6 b2"><input type="number" name="r1c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c7 b3"><input type="number" name="r1c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c8 b3"><input type="number" name="r1c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r1 c9 b3"><input type="number" name="r1c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=1; ?>
                    <td class="r2 c1 b1"><input type="number" name="r2c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c2 b1"><input type="number" name="r2c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c3 b1"><input type="number" name="r2c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c4 b2"><input type="number" name="r2c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c5 b2"><input type="number" name="r2c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c6 b2"><input type="number" name="r2c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c7 b3"><input type="number" name="r2c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c8 b3"><input type="number" name="r2c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r2 c9 b3"><input type="number" name="r2c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=2; ?>
                    <td class="r3 c1 b1"><input type="number" name="r3c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c2 b1"><input type="number" name="r3c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c3 b1"><input type="number" name="r3c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c4 b2"><input type="number" name="r3c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c5 b2"><input type="number" name="r3c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c6 b2"><input type="number" name="r3c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c7 b3"><input type="number" name="r3c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c8 b3"><input type="number" name="r3c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r3 c9 b3"><input type="number" name="r3c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=3; ?>
                    <td class="r4 c1 b4"><input type="number" name="r4c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c2 b4"><input type="number" name="r4c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c3 b4"><input type="number" name="r4c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c4 b5"><input type="number" name="r4c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c5 b5"><input type="number" name="r4c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c6 b5"><input type="number" name="r4c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c7 b6"><input type="number" name="r4c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c8 b6"><input type="number" name="r4c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r4 c9 b6"><input type="number" name="r4c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=4; ?>
                    <td class="r5 c1 b4"><input type="number" name="r5c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c2 b4"><input type="number" name="r5c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c3 b4"><input type="number" name="r5c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c4 b5"><input type="number" name="r5c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c5 b5"><input type="number" name="r5c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c6 b5"><input type="number" name="r5c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c7 b6"><input type="number" name="r5c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c8 b6"><input type="number" name="r5c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r5 c9 b6"><input type="number" name="r5c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=5; ?>
                    <td class="r6 c1 b4"><input type="number" name="r6c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c2 b4"><input type="number" name="r6c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c3 b4"><input type="number" name="r6c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c4 b5"><input type="number" name="r6c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c5 b5"><input type="number" name="r6c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c6 b5"><input type="number" name="r6c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c7 b6"><input type="number" name="r6c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c8 b6"><input type="number" name="r6c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r6 c9 b6"><input type="number" name="r6c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=6; ?>
                    <td class="r7 c1 b7"><input type="number" name="r7c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c2 b7"><input type="number" name="r7c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c3 b7"><input type="number" name="r7c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c4 b8"><input type="number" name="r7c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c5 b8"><input type="number" name="r7c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c6 b8"><input type="number" name="r7c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c7 b9"><input type="number" name="r7c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c8 b9"><input type="number" name="r7c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r7 c9 b9"><input type="number" name="r7c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=7; ?>
                    <td class="r8 c1 b7"><input type="number" name="r8c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c2 b7"><input type="number" name="r8c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c3 b7"><input type="number" name="r8c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c4 b8"><input type="number" name="r8c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c5 b8"><input type="number" name="r8c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c6 b8"><input type="number" name="r8c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c7 b9"><input type="number" name="r8c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c8 b9"><input type="number" name="r8c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r8 c9 b9"><input type="number" name="r8c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>
                <tr><?php $htmlRow=8; ?>
                    <td class="r9 c1 b7"><input type="number" name="r9c1" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 0; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c2 b7"><input type="number" name="r9c2" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 1; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c3 b7"><input type="number" name="r9c3" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 2; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c4 b8"><input type="number" name="r9c4" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 3; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c5 b8"><input type="number" name="r9c5" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 4; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c6 b8"><input type="number" name="r9c6" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 5; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c7 b9"><input type="number" name="r9c7" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 6; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c8 b9"><input type="number" name="r9c8" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 7; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                    <td class="r9 c9 b9"><input type="number" name="r9c9" min="1" max="9" maxlength="1" oninput="noRepeats(); toNextCell();" value="<?php $htmlColumn = 8; if (!empty($_sudokuGrid[$htmlRow][$htmlColumn]) or $_sudokuGrid[$htmlRow][$htmlColumn] != 0) echo $_sudokuGrid[$htmlRow][$htmlColumn]; ?>"></td>
                </tr>

            </table> 
            <input class="solveButton" type="submit" value="Solve">
            </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST"){         
            
            //check candidates
            
            function checkCandidates($candidatesList){
                //echo "Candidates: ";
                
                $candidateCount = 0;
                $onlyOption = "";
                for ($i=0; $i < 9;$i++){
                    
                    if ($candidatesList[$i] == true) {
                        $onlyOption = $i+1;
                        $candidateCount++;
                        //echo $i+1 . ", ";
                    }
                }
                //echo "<br>";
                //echo "Amount of Candidates: " . $candidateCount . "<br>";
                if ($candidateCount == 1) {return $onlyOption;} else {return false;}
                
            }
            
            
            /*-------------------------------Solve the Puzzle----------------------------------------*/
            
            function solvePuzzle($grid) {
                $solvedCells = 0;
                $numbersAdded = 0;
                $loopsWithNoNewNumbers = 0;
                do {
                    $numbersAdded = 0;
                    $solvedCells = 0;
                    
                    //-----------------------------Naked singles------------------------------------------------
                    for ($row = 0; $row < 9; $row++) {
                        //echo "Row:" . $row . "<br>";
                        for ($col = 0; $col < 9; $col++){
                            //echo "Column:" . $col . "<br>";

                            //update number of solved cells
                            if ($grid[$row][$col] != 0 && !is_array($grid[$row][$col])){
                                $solvedCells++;
                                //echo "Value:" . $grid[$row][$col] . "<br>";
                            }

                            //if ($grid[$row][$col] != 0 or !is_array($grid[$row][$col])){echo "<br>";}
                            //check if cell is empty or has candidates
                            if ($grid[$row][$col] == 0 or is_array($grid[$row][$col])) {
                                //echo "is zero or has candidates<br>";
                                //create an array for each cell that contains it's candidates
                                if (($grid[$row][$col] == 0) or (empty($grid[$row][$col]))) {
                                    $grid[$row][$col] = array(true, true, true, true, true, true, true, true, true,);
                                    //echo "is zero<br>";
                                }

                                //check each column in same row
                                for ($checkColumn = 0; $checkColumn < 9; $checkColumn++){
                                    if ($grid[$row][$checkColumn] != 0 && !is_array($grid[$row][$checkColumn])){
                                        $_elimtdCandidate = $grid[$row][$checkColumn]-1;
                                        $grid[$row][$col][$_elimtdCandidate] = false;
                                    }
                                }
                                //check each row in same column
                                for ($checkRow = 0; $checkRow < 9; $checkRow++){
                                    if ($grid[$checkRow][$col] != 0 && !is_array($grid[$checkRow][$col])){
                                        $_elimtdCandidate = $grid[$checkRow][$col]-1;
                                        $grid[$row][$col][$_elimtdCandidate] = false;
                                    }
                                }
                                //findBox

                                $box = 0;

                                if (($row == 0 or $row == 1 or $row == 2) && ($col == 0 or $col == 1 or $col == 2)) {$box = 1;}
                                if (($row == 0 or $row == 1 or $row == 2) && ($col == 3 or $col == 4 or $col == 5)) {$box = 2;}
                                if (($row == 0 or $row == 1 or $row == 2) && ($col == 6 or $col == 7 or $col == 8)) {$box = 3;}
                                if (($row == 3 or $row == 4 or $row == 5) && ($col == 0 or $col == 1 or $col == 2)) {$box = 4;}
                                if (($row == 3 or $row == 4 or $row == 5) && ($col == 3 or $col == 4 or $col == 5)) {$box = 5;}
                                if (($row == 3 or $row == 4 or $row == 5) && ($col == 6 or $col == 7 or $col == 8)) {$box = 6;}
                                if (($row == 6 or $row == 7 or $row == 8) && ($col == 0 or $col == 1 or $col == 2)) {$box = 7;}
                                if (($row == 6 or $row == 7 or $row == 8) && ($col == 3 or $col == 4 or $col == 5)) {$box = 8;}
                                if (($row == 6 or $row == 7 or $row == 8) && ($col == 6 or $col == 7 or $col == 8)) {$box = 9;}

                                //check box

                                //init box
                                $boxRowMin = 0;
                                $boxRowMax = 0;
                                $boxColMin = 0;
                                $boxColMax = 0;

                                //establish box ranges
                                switch ($box) {
                                    case 1:
                                        $boxRowMin = 0;
                                        $boxRowMax = 2;
                                        $boxColMin = 0;
                                        $boxColMax = 2;
                                        break;
                                    case 2:
                                        $boxRowMin = 0;
                                        $boxRowMax = 2;
                                        $boxColMin = 3;
                                        $boxColMax = 5;
                                        break;
                                    case 3:
                                        $boxRowMin = 0;
                                        $boxRowMax = 2;
                                        $boxColMin = 6;
                                        $boxColMax = 8;
                                        break;
                                    case 4:
                                        $boxRowMin = 3;
                                        $boxRowMax = 5;
                                        $boxColMin = 0;
                                        $boxColMax = 2;
                                        break;
                                    case 5:
                                        $boxRowMin = 3;
                                        $boxRowMax = 5;
                                        $boxColMin = 3;
                                        $boxColMax = 5;
                                        break;
                                    case 6:
                                        $boxRowMin = 3;
                                        $boxRowMax = 5;
                                        $boxColMin = 6;
                                        $boxColMax = 8;
                                        break;
                                    case 7:
                                        $boxRowMin = 6;
                                        $boxRowMax = 8;
                                        $boxColMin = 0;
                                        $boxColMax = 2;
                                        break;
                                    case 8:
                                        $boxRowMin = 6;
                                        $boxRowMax = 8;
                                        $boxColMin = 3;
                                        $boxColMax = 5;
                                        break;
                                    case 9:
                                        $boxRowMin = 6;
                                        $boxRowMax = 8;
                                        $boxColMin = 6;
                                        $boxColMax = 8;
                                        break;
                                }

                                for ($boxRow = $boxRowMin; $boxRow <= $boxRowMax; $boxRow++){
                                    for ($boxCol = $boxColMin; $boxCol <= $boxColMax; $boxCol++)
                                        if (($grid[$boxRow][$boxCol] != 0) && !is_array($grid[$boxRow][$boxCol])){
                                        $_elimtdCandidate = $grid[$boxRow][$boxCol]-1;
                                        $grid[$row][$col][$_elimtdCandidate] = false;
                                    }
                                }
                                //echo "Candidate array values:" . implode(", ", $grid[$row][$col]) . "<br>";
                                //check candidates. if only one option, apply that candidate
                                if (checkCandidates($grid[$row][$col]) != false){
                                    $grid[$row][$col] = checkCandidates($grid[$row][$col]);
                                    $numbersAdded++;
                                }
                                //echo "<br>";
                            }
                        }
                    }
                    //------------------------------Check for pairs and find candidates with that------------------------------
                    
                    //check if any numbers have been added and increment the count accordingly. Then, loop again
                    if ($numbersAdded == 0){
                        $loopsWithNoNewNumbers++;
                    } else{
                        $loopsWithNoNewNumbers = 0;
                    }
                } while ($loopsWithNoNewNumbers <= 5);
                
                echo "Cells solved:" . $solvedCells . "<br>";
                
                for ($row = 0; $row < 9; $row++) {
                    for ($col = 0; $col < 9; $col++){
                        if (is_array($grid[$row][$col])){
                            echo "? ";
                        }else{
                           echo $grid[$row][$col] . " "; 
                        }
                    }
                    echo "<br>";
                }
                if ($solvedCells == 81){
                    echo "Puzzle Solved!<br>";
                }
            }
            solvePuzzle($_sudokuGrid);
            /*-------------------------------------------Display solved Puzzle-----------------------------------*/
            /*-----------------------------------turn this into a table with html--------------------------------*/
            
        }
        ?>
    </div>
    <script src="scripts.js"></script>
</body>
</html>