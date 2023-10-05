<?php

function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}

$profile = http_request("https://dummyjson.com/products");

// ubah string JSON menjadi array
$profile = json_decode($profile, TRUE);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Curl Data JSON</title>
</head>

<body>
    <div class="container-md"></div>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Thumbnail</th>
            <th>Images</th>
        </tr>
        <?php
            foreach($profile['products'] as $d) { ?>
        <tr>
        <?php
            echo "<td>",$d['title'],"</td>";
            echo "<td>$",$d['price'],"</td>";
            echo "<td><img width='100px' alt='image' src=",$d['thumbnail'],"></img></td>";
            echo "<td>";
                foreach ($d['images'] as $image) {
                    echo "<img width='100px' alt='image' src=", $image, "></img>";
                }
            echo "</td>";
        } ?>
        </tr>
    </table>

</body>
</html>