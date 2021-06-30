<?php
set_time_limit(0);
require("/var/www/html/inc/func.php");
require("/var/www/html/inc/uagent.php");
require("/var/www/html/inc/simple_html_dom.php");
$servername = "localhost";
$username = "pmauser";
$password = "crack420";
$dbname = "hosts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//$sql = "INSERT IGNORE INTO MyGuests (firstname, lastname, email)vaLUES ('John', 'Doe', 'john@example.com')";
/*
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
///  





/**
 * The following code is a complete example of using phpcrawl with multi processes.
 *
 * The listed script "spiders" the documentation of the php-mysql-extension on php.net (http://php.net/manual/en/book.mysql.php)
 * including all it's subsections and links. By defining some rules is it assured that all other links leading to other sites 
 * and sections on php.net get ignored.
 *
 * This script has to be run from the commandline (php CLI, run "php multiprocessing_example.php"). 
 */

// Inculde the phpcrawl-mainclass
include("libs/PHPCrawler.class.php");

// Extend the class and override the handleDocumentInfo()-method
class MyCrawler extends PHPCrawler 
{
  function handleDocumentInfo($DocInfo) 
  {
  	global $conn;
    // Just detect linebreak for output ("\n" in CLI-mode, otherwise "<br>").
    if (PHP_SAPI == "cli") $lb = "\n";
    else $lb = "<br />";

    // Print the URL and the HTTP-status-Code
    echo "Page requested: ".$DocInfo->url." (".$DocInfo->http_status_code.")".$lb;
    
    // Print the refering URL
    echo "Referer-page: ".$DocInfo->referer_url.$lb;
    echo "\n";
    // Print if the content of the document was be recieved or not
    if ($DocInfo->received == true) {
    preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $DocInfo->source, $match);
    $links_found = array_unique($match[0]);
/*
echo "<pre>";
print_r($match[0]); 
echo "</pre>";*/
    foreach($links_found as $bk => $url)
    {

//	$url=substr(mysqli_real_escape_string($conn,$d->href),0,255);
    	if(substr($url,0,4)=='http' && ext($url)!='js'){
    	         	$anchor='';//substr(mysqli_real_escape_string($conn,$d->innertext),0,255);
    	     	$hash=mysqli_real_escape_string($conn,md5($url));	
    	$title='';//substr(mysqli_real_escape_string($conn,$d->title),0,255);
    	   echo "$url\n";
    $anchor=addslashes($anchor);
        $url=addslashes($url);
            $title=addslashes($title);
    // Now you should do something with the content of the actual
    // received page or file ($DocInfo->source), we skip it in this example 
    
 $sql = "INSERT IGNORE INTO `urls` (`anchor`,`title`,`url`,`hash`)
VALUES ('$anchor', '$title', '$url','$hash')";

mysqli_query($conn,$sql);// or die(mysqli_error($conn));
// $conn -> insert_id;

    }
    }
  /*  $regex = "((https?|ftp)\:\/\/)?"; // Checking scheme 
$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Checking host name and/or IP
$regex .= "(\:[0-9]{2,5})?"; // Check it it has port number
$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // The real path
$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // Check the query string params
$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Check anchors if are used.
preg_match_all($regex,$DocInfo->source,$m);
//print_r($m);*/
    
    if ($result = $conn->query("SELECT url FROM urls WHERE `url`='".$DocInfo->url."' LIMIT 1")) {
    /* determine number of rows result set */
//  $result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
echo "Old URL: ".$DocInfo->url."\n";
}
else
{    
    
    
    
    
    
    
      echo "Content received: ".$DocInfo->bytes_received." bytes".$lb;
  
          $html=str_get_html($DocInfo->source);

	$url=mysqli_real_escape_string($conn,$DocInfo->url);
    	if(substr($url,4)=='http'){

$title=substr($html->find('title')->innertext,0,255);
$anchor=substr($html->find('meta[name=description]')->content,0,255);
    	     	$hash=mysqli_real_escape_string($conn,md5($DocInfo->url));	
    	$title=substr(mysqli_real_escape_string($conn,$title),0,255);
    	   echo "$url\n";
    
    // Now you should do something with the content of the actual
    // received page or file ($DocInfo->source), we skip it in this example 
    
 $sql = "INSERT IGNORE INTO `urls` (`anchor`,`title`,`url`,`hash`)
VALUES ('$anchor', '$title', '$url','$hash')";

mysqli_query($conn,$sql);// or die(mysqli_error($conn));
    }


//unset($html);


    foreach($html->find('a') as $bk => $d)
    {

	$url=substr(mysqli_real_escape_string($conn,$d->href),0,255);
    	if(substr($d->href,0,4)=='http'){
    	         	$anchor=substr(mysqli_real_escape_string($conn,$d->innertext),0,255);
    	     	$hash=mysqli_real_escape_string($conn,md5($d->href));	
    	$title=substr(mysqli_real_escape_string($conn,$d->title),0,255);
    	   echo "$url\n";
    $anchor=addslashes($anchor);
        $url=addslashes($url);
            $title=addslashes($title);
    // Now you should do something with the content of the actual
    // received page or file ($DocInfo->source), we skip it in this example 
    
 $sql = "INSERT IGNORE INTO `urls` (`anchor`,`title`,`url`,`hash`)
VALUES ('$anchor', '$title', '$url','$hash')";

mysqli_query($conn,$sql);// or die(mysqli_error($conn));
    }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    foreach($html->find('img') as $bk => $d)
    {

	$url=substr(mysqli_real_escape_string($conn,$d->src),0,255);
    	if(substr($d->src,0,4)=='http'){
    	         	$anchor=substr(mysqli_real_escape_string($conn,$d->innertext),0,255);
    	     	$hash=mysqli_real_escape_string($conn,md5($d->src));	
    	$title=substr(mysqli_real_escape_string($conn,$d->title),0,255);
    	   echo "$url\n";
    
    // Now you should do something with the content of the actual
    // received page or file ($DocInfo->source), we skip it in this example 
        $anchor=addslashes($anchor);
        $url=addslashes($url);
            $title=addslashes($title);
 $sql = "INSERT IGNORE INTO `urls` (`anchor`,`title`,`url`,`hash`)
VALUES ('$anchor', '$title', '$url','$hash')";

mysqli_query($conn,$sql);// or die(mysqli_error($conn));
    }
    }
    
    }
    
    }
    else
    
    {
    	echo " Not Received: ".$DocInfo->url."\n";
    }
    
    /*
   foreach($html->find('iframe') as $k => $d)
    {
    

    	$anchor='';//mysqli_real_escape_string($conn,$d->innertext);	
	$url=mysqli_real_escape_string($conn,$d->src);
    	if(substr($url,4)=='http'){
    	     	$hash=mysqli_real_escape_string($conn,md5($d->src));	
    	$title=='';//mysqli_real_escape_string($conn,$d->title);
    	
    echo "$url\n";
    // Now you should do something with the content of the actual
    // received page or file ($DocInfo->source), we skip it in this example 
    
 $sql = "INSERT IGNORE INTO `urls` (`anchor`,`title`,`url`,`hash`)
VALUES ('$anchor', '$title', '$url','$hash')";
mysqli_query($conn,$sql);
}
    }
    
    
    
    */
    
    /*
   foreach($html->find('img') as $k => $d)
    {
         	$anchor='';//mysqli_real_escape_string($conn,$d->innertext);	
	$url=mysqli_real_escape_string($conn,$d->src);
    	if(substr($url,4)=='http'){
    	     	$hash=mysqli_real_escape_string($conn,md5($d->src));	
    	$title=='';//mysqli_real_escape_string($conn,$d->title);
    	 echo "$url\n";	
    
    // Now you should do something with the content of the actual
    // received page or file ($DocInfo->source), we skip it in this example 
    
 $sql = "INSERT IGNORE INTO `urls` (`anchor`,`title`,`url`,`hash`)
VALUES ('$anchor', '$title', '$url','$hash')";
mysqli_query($conn,$sql);
    }
    }
    
    */
    
        
   
  
    echo $lb;
    
    flush();

}
}
}
if(isset($_GET['url'])){
$crawl_url=$_GET['url'];
}
else 
if(!isset($argv[1])){
$crawl_url="https://stackexchange.com/";
}
else
    if (PHP_SAPI == "cli") 
    {
	$crawl_url=$argv[1];
}
else
{
// Now, create a instance of your class, define the behaviour
// of the crawler (see class-reference for more options and details)
// and start the crawling-process.
if ($result = $conn->query("SELECT url FROM urls ORDER BY `id` DESC LIMIT 1")) {
    /* determine number of rows result set */
//  $result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    /* close result set */
  
  	$crawl_url=$row['url'];
    $result->close();
  
}
}
}
}
$list="/etc/axcrawler/urls.list";
if(file_exists($list))
{
	$crawl_url=file_get_contents($list);
}


$crawler = new MyCrawler();


$crawler->setUserAgentString(random_uagent());
$url_parts=parse_url($crawl_url);
$resume_key=__DIR__."/tmp/".$url_parts['host'].".pid";
$cache_key=$url_parts['host'];
$cache_dir=__DIR__."/tmp/$cache_key/";
mkdir($cache_dir,0777,true);
// URL to crawl (the entry-page of the mysql-documentation on php.net)
$crawler->setURL($crawl_url);
$crawler->setFollowRedirectsTillContent(true);
$crawler->enableCookieHandling(true);
$crawler->obeyRobotsTxt(false);
$crawler->obeyNoFollowTags(false);
$crawler->enableAggressiveLinkSearch(true);
$crawler->setLinkExtractionTags(array("href", "src", "srcdoc"));

// Let's the crawler wait for a half second before every request.
$crawler->setRequestDelay(0.5);
// Only receive content of documents with content-type "text/html"
$crawler->addReceiveContentType("#text/html#");
$crawler->setFollowMode(0);
// Ignore links to pictures, css-documents etc (prefilter)
$crawler->addURLFilterRule("#\.(jpg|gif|png|pdf|jpeg|css|js)$# i");

// Every URL within the mysql-documentation looks like 
// "http://php.net/manual/en/function.mysql-affected-rows.php"
// or "http://php.net/manual/en/mysql.setup.php", they all contain
// "http://php.net/manual/en/" followed by  "mysql" somewhere.
// So we add a corresponding follow-rule to the crawler.
//$crawler->addURLFollowRule("#^http://php.net/manual/en/.*mysql[^a-z]# i");

$crawler->setUrlCacheType(PHPCrawlerUrlCacheTypes::URLCACHE_SQLITE);
$crawler->setWorkingDirectory($cache_dir);

// Important for resumable scripts/processes!
$crawler->enableResumption();

// At the firts start of the script retreive the crawler-ID and store it
// (in a temporary file in this example)
if (!file_exists("$resume_key"))
{
  $crawler_ID = $crawler->getCrawlerId();
  file_put_contents("$resume_key", $crawler_ID);
}
// If the script was restarted again (after it was aborted), read the crawler-ID
// and pass it to the resume() method.
else
{
  $crawler_ID = file_get_contents("$resume_key");
  $crawler->resume($crawler_ID);
}
// That's it, start crawling using 5 processes
$crawler->goMultiProcessed(15);
// Delete the stored crawler-ID after the process is finished completely and successfully.
unlink("$resume_key");

// At the end, after the process is finished, we print a short
// report (see method getReport() for more information)
$report = $crawler->getProcessReport();

if (PHP_SAPI == "cli") $lb = "\n";
else $lb = "<br />";
    
echo "Summary:".$lb;
echo "Links followed: ".$report->links_followed.$lb;
echo "Documents received: ".$report->files_received.$lb;
echo "Bytes received: ".$report->bytes_received." bytes".$lb;
echo "Process runtime: ".$report->process_runtime." sec".$lb;


 $conn->close();

?>
