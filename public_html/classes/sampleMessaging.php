<?php

    
    
    include('config.php');
    // Load the class
    require('messages.php');
    // Set the userid to 2 for testing purposes... you should have your own usersystem, so this should contain the userid
    $userid=2;
    // initiate a new pm class
    $pm = new cpm($userid);
    
    // check if a new message had been send
    if(isset($_POST['newmessage'])) {
        // check if there is an error while sending the message (beware, the input hasn't been checked, you should never trust users input!)
        if($pm->sendmessage($_POST['to'],$_POST['subject'],$_POST['message'])) {
            // Tell the user it was successful
            echo "Message successfully sent!";
        } else {
            // Tell user something went wrong it the return was false
            echo "Error, couldn't send PM. Maybe wrong user.";
        }
    }
    
    // check if a message had been deleted
    if(isset($_POST['delete'])) {
        // check if there is an error during deletion of the message
        if($pm->deleted($_POST['did'])) {
            echo "Message successfully deleted!";
        } else {
            echo "Error, couldn't delete PM!";
        }
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Simple private Messaging</title>
</head>
<body>
<?php
// In this switch we check what page has to be loaded, this way we just load the messages we want using numbers from 0 to 3 (0 is standart, so we don't need to type this)
if(isset($_GET['p'])) {
    switch($_GET['p']) {
        // get all new / unread messages
        case 'new': $pm->getmessages(); break;
        // get all send messages
        case 'send': $pm->getmessages(2); break;
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
<a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=send'>Send Messages</a>
<a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=read'>Read Messages</a>
<a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=deleted'>Deleted Messages</a>
<br  /><br  />
<?php
// if it's the standart startpage or the page new, then show all new messages
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
                    <td><?php echo $pm->messages[$i]['from']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></td>
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
                    <td><?php echo $pm->messages[$i]['to']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></td>
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
            echo "<tr><td colspan='4'><strong>No send messages found</strong></td></tr>";
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
                    <td><?php echo $pm->messages[$i]['from']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></td>
                    <td><?php echo $pm->messages[$i]['to_vdate']; ?></td>
                </tr>
                <?php
            }
        } else {
            // else... tell the user that there are no new messages
            echo "<tr><td colspan='4'><strong>No read messages found</strong></td></tr>";
        }
    ?>
    </table>

<?php
// check if the user wants the deleted messages
} elseif($_GET['p'] == 'deleted') {
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
                    <td><?php echo $pm->messages[$i]['from']; ?></td>
                    <td><a href='<?php echo $_SERVER['PHP_SELF']; ?>?p=view&mid=<?php echo $pm->messages[$i]['id']; ?>'><?php echo $pm->messages[$i]['title'] ?></a></td>
                    <td><?php echo $pm->messages[$i]['to_ddate']; ?></td>
                </tr>
                <?php
            }
        } else {
            // else... tell the user that there are no new messages
            echo "<tr><td colspan='4'><strong>No deleted messages found</strong></td></tr>";
        }
    ?>
</table>
<?php
// if the user wants a detail view and the message id is set...
} elseif($_GET['p'] == 'view' && isset($_GET['mid'])) {
    // if the users id is the recipients id and the message hadn't been viewed yet
    if($userid == $pm->messages[0]['toid'] && !$pm->messages[0]['to_viewed']) {
        // set the messages flag to viewed
        $pm->viewed($pm->messages[0]['id']);
    }
?>
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>From:</td>
            <td><?php echo $pm->messages[0]['from']; ?></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>Date:</td>
            <td><?php echo $pm->messages[0]['created']; ?></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>Subject:</td>
            <td colspan="3"><?php echo $pm->messages[0]['title']; ?></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $pm->render($pm->messages[0]['message']); ?></td>
        </tr>
    </table>
    <form name='reply' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <input type='hidden' name='rfrom' value='<?php echo $pm->messages[0]['from']; ?>' />
        <input type='hidden' name='rsubject' value='Re: <?php echo $pm->messages[0]['title']; ?>' />
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
<textarea name='message'><?php if(isset($_POST['reply'])) { echo $_POST['rmessage']; } ?></textarea>
<input type='submit' name='newmessage' value='Send' />
</form>
</body>
</html>