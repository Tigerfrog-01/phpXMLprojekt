<?php
//Uudiste lugemise funktsioon
function Uudised($url,$kogus)
{
    $feed=simplexml_load_file("$url");
    echo "<ul>";
    echo "Kuupäev:" .date("d.m.Y",strtotime($feed->channel->item->pubDate));
    $loendur=0;
    foreach ($feed->channel->item as $item) {
        if($loendur<=$kogus)
        {
        echo "<li>
     <a href='$item->link' target='_blank'>.$item->title<a>";
        echo $item->description;
        $imgurl = $item->enclosure->attributes() -> url;
        echo "<img src='$imgurl' alt='' >";
        echo "</li>";
        $loendur++;

    }
    }
    echo "</ul>";

}