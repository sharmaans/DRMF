<!DOCTYPE html>
<html>

<head>
    <title>Letter Case Modifier</title>
</head>

<body>
    <center>
        <section style="width: 50%;">
            <br />
            <br />
            <br />
            <h1>Welcome to the Letter Case Modifier</h1>
            <p>The program is designed to take the text in <a href='https://www.tjhsst.edu/~2016rbelayac/NIST/KLSadd.tex' target='_blank'>KLSadd.tex</a> and <strong>inverse</strong> any letter's case that you choose. If you see red text below, either you haven't started or something went wrong; check your input and try again. In the end, a green "Finished" message will appear below and you may go and save <a href='https://www.tjhsst.edu/~2016rbelayac/NIST/KLSaddModified.tex' target='_blank'>KLSaddModified.tex</a> which will have the modification.</p>
            <br />
            <form name="inp" method="POST" action="changeLetterCase.php">
                <fieldset>
                    Text comes from the file <a href='https://www.tjhsst.edu/~2016rbelayac/NIST/KLSadd.tex' target='_blank'>KLSadd.tex</a>

                    <br />
                    <br /> Choose a Letter to Inverse Case:
                    <br />
                    <select name="letterDrop">
                        <option value="">Select a Letter</option>
                        <option value="all">All</option>
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="d">d</option>
                        <option value="e">e</option>
                        <option value="f">f</option>
                        <option value="g">g</option>
                        <option value="h">h</option>
                        <option value="i">i</option>
                        <option value="j">j</option>
                        <option value="k">k</option>
                        <option value="l">l</option>
                        <option value="m">m</option>
                        <option value="n">n</option>
                        <option value="o">o</option>
                        <option value="p">p</option>
                        <option value="q">q</option>
                        <option value="r">r</option>
                        <option value="s">s</option>
                        <option value="t">t</option>
                        <option value="u">u</option>
                        <option value="v">v</option>
                        <option value="w">w</option>
                        <option value="x">x</option>
                        <option value="y">y</option>
                        <option value="z">z</option>
                    </select>


                    <br />
                    <br />
                    <button type="submit" accesskey="s"><u>S</u>ubmit</button>
                </fieldset>
            </form>
            <br />
            <i>STATUS (wait for the green Finished Message):</i>
            <br />
            <br />

            <?php

            $content = file_get_contents('KLSadd.tex');
            $text = array();

            if($_POST['letterDrop'] != '' && preg_match("/^[a-z]$|^All$/", $_POST['letterDrop'], $matches)) {
              $letter = $_POST['letterDrop'];
            } else {
              echo "<font color='red'>Please select valid letter from dropdown list.</font><br />";
            }

            /*Separate all lines into array indices*/
            $text = explode("\n", $content);

            $temp = "";
            $finString = "";

            if (stripos($content, $letter) !== FALSE && strlen($letter) !== 3) {
                /*Parse through each line of text*/
                for($j = 0; $j < count($text); $j++) {
                    if (stripos($text[$j], $letter) !== FALSE) {
                        /*Parse through each letter of the lines of text*/
                        for($i = 0; $i < strlen($text[$j]); $i++){
                            if (stripos(substr($text[$j], $i, 1), $letter) !== FALSE) {
                                    $temp = strtolower(substr($text[$j], $i, 1)) ^ strtoupper(substr($text[$j], $i, 1)) ^ substr($text[$j], $i, 1);
                                    $finString = $finString.$temp;
                            } else {
                                $finString = $finString.substr($text[$j], $i, 1);
                            }
                        }
                        $finString = $finString."\n";
                    }
                    else if (strlen($text[$j]) == 0) {
                        $finString = $finString."\n";
                    }
                    else if (!stripos($text[$j], $letter)) {
                        $finString = $finString.$text[$j]."\n";
                    }
                    else {
                    }
                }
            } 
            else if (strlen($letter) == 3) {
                $finString = strtolower($content) ^ strtoupper($content) ^ $content;
            }
            else {
                echo "<font color='red'>The selected letter does not exist in the inputed text!</font>";
            }

            if (strlen($finString) > 0) {
                file_put_contents("KLSaddModified.tex", $finString);
                echo "<font color='green'>Finished, please check the file. Click here to view and save: <a href='https://www.tjhsst.edu/~2016rbelayac/NIST/KLSaddModified.tex' target='_blank'>KLSaddModified.tex</a></font>";
            }

              ?>
              
        </section>
    </center>
</body>
</html>
