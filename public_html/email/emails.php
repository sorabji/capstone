<?php

    
    include_once('../header.php');
    include_once('../util.php');
	$link = connect();
    // Load the class
    //require('messages.php');
    // Set the userid to 2 for testing purposes... you should have your own usersystem, so this should contain the userid
    $userid=2;
    // initiate a new pm class
    $pm = new Messages($userid);
    
    // check if a new message has been sent
    if(isset($_POST['newmessage'])) {
        // check if there is an error while sending the message
        if($pm->sendmessage($_POST['to'],$_POST['subject'],$_POST['message'])) {
            //Success?
            echo "Message successfully sent!";
        } else {
            // FAILURE.
            echo "Error, couldn't send PM. Maybe wrong user.";
        }
    }
    
    // check if a message has been deleted
    if(isset($_POST['delete'])) {
        // deletion error?
        if($pm->deleted($_POST['did'])) {
            echo "Message successfully deleted!";
        } else {
            echo "Error, couldn't delete PM!";
        }
    }
    
// In this switch we check what page has to be loaded, this way we just load the messages we want
if(isset($_GET['p'])) {
    switch($_GET['p']) {
        // get all new / unread messages
        case 'new': $pm->getmessages(); break;
        // get all sent messages
        case 'sent': $pm->getmessages(2); break;
        // get all read messages
        case 'read': $pm->getmessages(1); break;
        // get all deleted messages
        case 'deleted': $pm->getmessages(3); break;
        // get a specific message
        case 'view': $pm->getmessage($_GET['mid']); break;
        // get all new / unread messages
        default: $pm->getmessages(); break;
    }
} else {
    // get all new / unread messages
    $pm->getmessages();
}
// Standard links
?>
<a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=new'>New Messages</a>
<a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=send'>Sent Messages</a>
<a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=read'>Read Messages</a>
<a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=deleted'>Deleted Messages</a>
<br  /><br  />
<?php
//if its the default page or new message page 
if(!isset($_GET['p']) || $_GET['p'] == 'new') {
?>
<table border="0" cellspacing="1" cellpadding="1">
    <tr>
        <td>From</td>
        <td>Title</td>
        <td>Date</td>
    </tr>
    <?php
        // If there are messages, show them
        if(count($pm->messages)) {
            // message loop
            for($i=0;$i<count($pm->messages);$i++) {
                ?>
                <tr>
                    <td><?php echo $pm->messages[$i]['sender']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['subject'] ?></a></td>
                    <td><?php echo $pm->messages[$i]['created']; ?></td>
                </tr>
                <?php
            }
        } else {
            // else... tell the user that there are no new messages
            echo "<tr><td colspan='3'><strong>No new messages found</strong></td></tr>";
        }
    ?>
</table>
<?php
// check if the user wants send messages
} elseif($_GET['p'] == 'send') {
?>

<table border="0" cellspacing="1" cellpadding="1">
    <tr>
        <td>To</td>
        <td>Title</td>
        <td>Status</td>
        <td>Date</td>
    </tr>
    <?php
        // if there are messages, show them
        if(count($pm->messages)) {
            // message loop
            for($i=0;$i<count($pm->messages);$i++) {
                ?>
                <tr>
                    <td><?php echo $pm->messages[$i]['recipent']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['subject'] ?></a></td>
                    <td>
                    <?php  
                        // If a message is deleted and not viewed
                        if($pm->messages[$i]['to_deleted'] && !$pm->messages[$i]['to_viewed']) {
                            echo "Deleted without reading";
                        // if a message got deleted AND viewed
                        } elseif($pm->messages[$i]['to_deleted'] && $pm->messages[$i]['to_viewed']) {
                            echo "Deleted after reading";
                        // if a message got not deleted but viewed
                        } elseif(!$pm->messages[$i]['to_deleted'] && $pm->messages[$i]['to_viewed']) {
                            echo "Read";
                        } else {
                        // not viewed and not deleted
                            echo "Not read yet";
                        }
                    ?>
                    </td>
                    <td><?php echo $pm->messages[$i]['created']; ?></td>
                </tr>
                <?php
            }
        } else {
            // else... tell the user that there are no new messages
            echo "<tr><td colspan='4'><strong>No sent messages found</strong></td></tr>";
        }
    ?>
</table>

<?php
// check if the user wants the read messages
} elseif($_GET['p'] == 'read') {
?>
    <table border="0" cellspacing="1" cellpadding="1">
    <tr>
        <td>From</td>
        <td>Title</td>
        <td>Date</td>
    </tr>
    <?php
        // if there are messages, show them
        if(count($pm->messages)) {
            // message loop
            for($i=0;$i<count($pm->messages);$i++) {
                ?>
                <tr>
                    <td><?php echo $pm->messages[$i]['sender']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['subject'] ?></a></td>
                    <td><?php echo $pm->messages[$i]['to_vdate']; ?></td>
                </tr>
                <?php
            }
        } else {
            // else... tell the user that there are no new messages
            echo "<tr><td colspan='4'><strong>No read messages!</strong></td></tr>";
        }
    ?>
    </table>

<?php
// check if the user wants the deleted messages
} elseif($_GET['p'] == 'Deleted') {
?>
    <table border="0" cellspacing="1" cellpadding="1">
    <tr>
        <td>From</td>
        <td>Title</td>
        <td>Date</td>
    </tr>
    <?php
        // if there are messages, show them
        if(count($pm->messages)) {
            // message loop
            for($i=0;$i<count($pm->messages);$i++) {
                ?>
                <tr>
                    <td><?php echo $pm->messages[$i]['sender']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['subject'] ?></a></td>
                    <td><?php echo $pm->messages[$i]['to_ddate']; ?></td>
                </tr>
                <?php
            }
        } else {
            // else, no deleted messages
            echo "<tr><td colspan='4'><strong>No deleted messages found</strong></td></tr>";
        }
    ?>
</table>
<?php
} elseif($_GET['p'] == 'view' && isset($_GET['mid'])) {
    // if the users id is the recipients id and the message has not been viewed
    if($userid == $pm->messages[0]['toid'] && !$pm->messages[0]['to_viewed']) {
        // set the flag to viewed
        $pm->viewed($pm->messages[0]['id']);
    }
?>
	<!-- HTML STUFFS -->
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>From:</td>
            <td><?php echo $pm->messages[0]['sender']; ?></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>Date:</td>
            <td><?php echo $pm->messages[0]['created']; ?></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>Subject:</td>
            <td colspan="3"><?php echo $pm->messages[0]['subject']; ?></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $pm->render($pm->messages[0]['message']); ?></td>
        </tr>
    </table>
    <form name='reply' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <input type='hidden' name='rfrom' value='<?php echo $pm->messages[0]['sender']; ?>' />
        <input type='hidden' name='rsubject' value='Re: <?php echo $pm->messages[0]['subject']; ?>' />
        <input type='hidden' name='rmessage' value='[quote]<?php echo $pm->messages[0]['message']; ?>[/quote]' />
        <input type='submit' name='reply' value='Reply' />
    </form>
    <form name='delete' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <input type='hidden' name='did' value='<?php echo $pm->messages[0]['id']; ?>' />
        <input type='submit' name='delete' value='Delete' />
    </form>
<?php
}
?>
<form name="new" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<strong>To:</strong>
<input type='text' name='to' value='<?php if(isset($_POST['reply'])) { echo $_POST['rfrom']; } ?>' />
<strong>Subject:</strong>
<input type='text' name='subject' value='<?php if(isset($_POST['reply'])) { echo $_POST['rsubject']; } ?>' />
<strong>Message:</strong><br  />
<textarea name="message" style="margin-left: 2px; margin-right: 2px; width: 549px; margin-top: 2px; margin-bottom: 2px; height: 134px; "></textarea><?php if(isset($_POST['reply'])) { echo $_POST['rmessage']; } ?></textarea>
<input type='submit' name='newmessage' value='Send' />
</form>
<?php
	include_once('../footer.php');
?>

