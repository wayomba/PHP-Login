<?php
session_start();
require '../login/autoload.php';
$conf = new GlobalConf;
$base_url = $conf->base_url;

if (!array_key_exists('admin', $_SESSION)  || $_SESSION['ip_address'] != getenv ( "REMOTE_ADDR" )) {
    session_destroy();
    header("location:".$base_url."/login/index.php");
} else {
  
chdir('../');
$pagetype = 'adminpage';
$title = 'Admin Verification';
include "login/partials/pagehead.php";

//include 'partials/adminpagehead.php';
$users = AdminUserPull::UserList();
$x = 0;
?>

<div class="container">

<?php
echo "<h3>Verify/Delete Users</h3>";

    if (!empty($users)) {

        echo '<table id="userlist" class="table table-sm"><thead class="headrow"><th>Username</th><th>Email</th><th><button class="btn btn-info btn-sm pull-right">Select All</button><input type="checkbox" id="selectAll" hidden></input></th></thead>';

        foreach($users as $user){
            $x++;
            echo '<tr class="datarow" scope="row" id="row'.$x.'"><td>'.$user['username'].'</td><td>'.$user['email'].'</td><td><button id="verbutton'.$x.'" class="btn btn-success btn-sm btn-fixed pull-right" onclick="verifyUser(\''.$user['id'].'\',\''.$user['email'].'\',\''.$user['username'].'\',\''.$x.'\');">Verify</button><button id="delbutton'.$x.'" class="btn btn-danger btn-sm btn-fixed pull-right" onclick="deleteUser(\''.$user['id'].'\',\''.$user['email'].'\',\''.$user['username'].'\',\''.$x.'\');">Delete</button><input type="checkbox" value="'.$user['id'].'" id="'.$x.'" hidden></input></td></tr>';
        }
        echo '</table><button id="verAll" class="btn btn-success" onclick="verifyAll();">Verify Selected</button>';
    } else {
        echo '<p class="message">No new users!</p>';
    };

};

?>
    </table>
    </div>
    </form>
    </body>
</html>