<?php

$config['db']['host']     = "";
$config['db']['username'] = "";
$config['db']['password'] = "";
$config['db']['dbname']   = "";

$db = new mysqli($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['dbname']);
if($db->connect_errno > 0){
    die('Database error: [' . $db->connect_error . ']');
}

$smilie_category_id = 1;
$display_in_editor  = 1; //1 = yes / 0 = no.
$url = "https://raw.githubusercontent.com/JustOneMoreBlock/TeddyBear/master/128x128"; //leave empty to use images on server.

$sql = "SELECT * FROM TeddyBear";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
header ("Content-Type:text/xml");
?><?xml version="1.0" encoding="utf-8"?>
<smilies_export>
  <smilie_categories>
    <smilie_category id="1" title="TeddyBear" display_order="0"/>
  </smilie_categories>
  <smilies>
<?php
while ($row = $result->fetch_assoc()) {
?>
    <smilie smilie_category_id="<?php echo $smilie_category_id; ?>" title="<?php echo $row["title"]; ?>" display_order="<?php echo $row["id"]; ?>" display_in_editor="<?php echo $display_in_editor; ?>">
      <image_url><?php echo "$url/".$row["image_url"].""; ?></image_url>
      <smilie_text><?php echo $row["smilie_text"]; ?></smilie_text>
    </smilie>
<?php
}
?>
  </smilies>
</smilies_export>