<?php
session_start();
include("includes/config.php");

$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_database = "hostel";
$mysqli = new mysqli($mysqli_hostname, $mysqli_user, $mysqli_password, $mysqli_database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student Information</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="hostel.css" rel="stylesheet" type="text/css">
</head>

<body>
    <table width="100%" border="0">
        <?php
        $id = $mysqli->real_escape_string($_GET['id']);
        $result = $mysqli->query("SELECT * FROM registration WHERE emailid = '$id'");
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td colspan="2" align="center" class="font1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="center" class="font1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" class="font"><?php echo ucfirst($row['firstName']); ?> <?php echo ucfirst($row['lastName']); ?>'S <span class="font1"> information &raquo;</span> </td>
            </tr>
            <tr>
                <td colspan="2" class="font">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div align="right">Reg Date : <span class="comb-value"><?php echo $row['postingDate']; ?></span></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="heading" style="color: red;">Room Related Info &raquo; </td>
            </tr>
            <tr>
                <td colspan="2" class="font1">
                    <table width="100%" border="0">
                        <tr>
                            <td width="32%" valign="top" class="heading">Room no : </td>
                            <td class="comb-value1"><span class="comb-value"><?php echo $row['roomno']; ?></span></td>
                        </tr>
                        <tr>
                            <td width="22%" valign="top" class="heading">Seater : </td>
                            <td class="comb-value1"><span class="comb-value"><?php echo $row['seater']; ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="left" class="heading" style="color: red;">Personal Info &raquo; </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php
        }
        $mysqli->close();
        ?>
    </table>

    <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="14%">&nbsp;</td>
                <td width="35%" class="comb-value"><label>
                        <input name="Submit" type="button" class="txtbox4" value="Prints this Document" onclick="f3();" />
                    </label></td>
                <td width="3%">&nbsp;</td>
                <td width="26%"><label>
                        <input name="Submit2" type="button" class="txtbox4" value="Close this document" onclick="f2();" />
                    </label></td>
                <td width="8%">&nbsp;</td>
                <td width="14%">&nbsp;</td>
            </tr>
        </table>
    </form>
</body>

</html>
