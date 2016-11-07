<?php
// #1


// #4
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($curl), true);
$page = array_values($result['query']['pages'])[0];
$pagetitle = $page['title'];
$pageid = $page['pageid'];
echo "Title: $pagetitle <br>ID: $pageid <br>";
curl_close($curl);
