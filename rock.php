<?php
    # Program: rock.php
    #    Date: 22-Jan-2026
    #  Author: gerry.walterscheid@gmail.com
    # Descrip: Play the game Rock, Paper, Sissors against the computer.

    session_start();
    header("Content-type: text/xml");

    $urlPath = "http://192.168.3.250/cisco/rock.php";

    $moves = array(
    	"rock",
    	"paper",
    	"sissors");

    # Get SoftKey selection and determine which action to take.
    $human = $_GET['key'] ?? -1;

    $status = "Your move.";
    $mesg1 = "";
    $mesg2 = "";
    $result = "";

    if ($human > -1) {
    	$computer = mt_rand(0,2);

        # Determine game results.
        switch($human) {
        case 0 :
            switch($computer) {
            case 0 : 
                $result = ""; 
                $status = "We tie!"; 
                break;
       	    case 1 :
                $result = "Paper wraps rock.";
                $status = "I win!";
                break;
            case 2 : 
                $result = "Rock breaks sissors.";
                $status = "You win!";
                break; }
            break;

        case 1 :
            switch ($computer) {
        	case 0 : 
        		$result = "Paper wraps rock.";
                $status = "You win!";
                break;
        	case 1 :
        		$result = "";
                $status = "We tie!";
                break;
            case 2 :
        		$result = "Sissors cuts paper.";
                $status = "I win!";
                break; }
            break;

        case 2 :
            switch ($computer) {
            case 0 :
                $result = "Rock breaks sissors.";
                $status = "I win!";
                break;
            case 1 :
                $result = "Sissors cuts paper.";
                $status = "You win!";
                break;
            case 2 :
                $result = "";
                $status = "We tie!"; } 
        }

        $mesg1 = "  You chose ".$moves[$human].".";
        $mesg2 = "  I chose ".$moves[$computer].".";
    }

    # Update IP Phone display.
    echo "<CiscoIPPhoneText>\n";
    echo "  <Title>Rock, Paper, Sissors</Title>\n";
    echo "  <Text>\n";
    echo "    $mesg1\n";
    echo "    $mesg2\n";
    echo "  </Text>\n";

    echo "  <SoftKeyItem>\n";
    echo "    <Name>Rock</Name>\n";
    echo "    <URL>$urlPath?key=0</URL>\n";
    echo "    <Position>1</Position>\n";
    echo "  </SoftKeyItem>\n";

    echo "  <SoftKeyItem>\n";
    echo "    <Name>Paper</Name>\n";
    echo "    <URL>$urlPath?key=1</URL>\n";
    echo "    <Position>2</Position>\n";
    echo "  </SoftKeyItem>\n";

    echo "  <SoftKeyItem>\n";
    echo "    <Name>Sissors</Name>\n";
    echo "    <URL>$urlPath?key=2</URL>\n";
    echo "    <Position>3</Position>\n";
    echo "  </SoftKeyItem>\n";

    echo "  <SoftKeyItem>\n";
    echo "    <Name>Exit</Name>\n";
    echo "    <URL>SoftKey:Exit</URL>\n";
    echo "    <Position>4</Position>\n";
    echo "  </SoftKeyItem>\n";

    echo "  <Prompt>$result  $status</Prompt>\n";
    echo "</CiscoIPPhoneText>\n"; 

    # Save current variable state.
    $_SESSION['id'] = "rock";
?>
