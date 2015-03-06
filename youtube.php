<?php
$con=mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","pmformusic_user","cs411","pmformusic_music");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$sid = $_POST['sid'];

$exists = mysqli_query($con, "SELECT * FROM `Songs` WHERE sid =\"".$sid."\"");
$row = mysqli_fetch_array($exists);

if ($row['SID'] == $sid) {

	$ctracks = $row['Title'];
	$calbums = $row['Album'];
	$cartists = $row['Artist'];

// not searching for album because in general results were better	
//if ($calbums == "undefined") {
	$calbums = " ";
//}

// check for search keywords
// trim whitespace
// separate multiple keywords with /

        $q = "".$ctracks." ".$cartists." ".$calbums;
        $q = ereg_replace('[[:space:]]+', '/', trim($q));
        
      $feedURL = "http://gdata.youtube.com/feeds/api/videos?q={$q}&max-results=1&output=embed";
      
      $sxml = simplexml_load_file($feedURL);
          
      // search xml for valid videos
      foreach ($sxml->entry as $entry) {
        // grab video rss from yahoo
      	$media = $entry->children('http://search.yahoo.com/mrss/');
        
        // retrieve URL
        $attrs = $media->group->player->attributes();
        $watch = $attrs['url'];
        // extract video id from URL
        preg_match('/.+v=(.+)&f.+/', $watch, $matches);
        if ($matches[1] != '') {
        	echo $matches[1];
        }
      }
}
else {
	echo "Error: could not find SID in db";
}
        
?>