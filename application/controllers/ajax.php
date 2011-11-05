<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Ajax_Controller extends Controller {

    function search()
    {
        $searchTerm = urlencode($_POST['query']);
        $page = $_POST['page'];

        $max_results = 30;
        $start_index = ($max_results * $page) + 1;
        //print $searchTerm;

        $queryString = 'http://gdata.youtube.com/feeds/api/videos?q='.$searchTerm.'&orderby=relevance&start-index='.$start_index.
					'&max-results='.$max_results.'&v=2&format=5';
        $xmlstr = file_get_contents($queryString);
        //$modstr = str_replace('yt:duration', 'duration', $xmlstr);
        $xml = new SimpleXMLElement($xmlstr);
        //var_dump($modstr);

        //Fetch all namespaces
        $namespaces = $xml->getNamespaces(true);

        //Register them with their prefixes
        foreach ($namespaces as $prefix => $ns) {
            //echo $prefix.' '.$ns.'<br />';
            $xml->registerXPathNamespace($prefix, $ns);
        }
        //$result = $xml->xpath('//yt:duration');
        //var_dump( $result );

        $duration_list = $xml->xpath('//yt:duration');
        $id_list = $xml->xpath('//yt:videoid');
        //var_dump( $duration_list );

        $x = 0;
        foreach($xml->entry as $entry)
        {

            $song_duration = $duration_list[$x]->attributes();

            $id 	  = $id_list[$x][0];

            //$title 	  = $entry->title;

            $title = str_replace('"','',$entry->title);
            /*
             $song_parts = explode('-', $title);
             $artist = $song_parts[0];
             if(isset($song_parts[1])){
             $title = $song_parts[1];
             }else{
             $title = '';
             }
             */
            $duration = $song_duration['seconds'];
            if($duration > 60){
                $mins = floor($duration / 60);
                $seconds = $duration - (60 * $mins);
                if(strlen($seconds) == 1){
                    $seconds = '0'.$seconds;
                }
                //print $mins.':'.$seconds;
            }else{
                $display_duration = '00:'.$duration;
            }
            ?>
<li class='result'>
<div class='result_<?php echo $x; ?>'><?php echo html::specialchars(str_replace("'", "", $title)); ?><a
    href="javascript:void(0);"
    onclick="play_song_preview('<?php echo $id; ?>');">Preview</a> <a
    href="javascript:void(0);"
    onclick="add('<?php echo $id; ?>', '<?php echo html::specialchars(str_replace("'", "", $title)); ?>', '<?php echo $duration; ?>');">Add</a>
</div>
</li>


            <?php
            //echo $title.'<a href="javascript:void(0);" onclick="playPreview(\''.$id.'\');">Preview</a> <a href="javascript:void(0);" onclick="add(\''.$id.'\', \''.$linkTitle.'\');">Add</a><br/>';
            $x++;
        }

    }
} // end ajax controller
?>