<?php
// #1
$xml_data = simplexml_load_file('data.xml');
echo 'Purchase Order Number : ' . $xml_data["PurchaseOrderNumber"] . '<br>';
echo 'Order Date : ' . $xml_data["OrderDate"] . '<br>';
echo '-----<br>';
echo 'Shipping Address : ' . $xml_data->Address[0] . '<br>';


echo '<br><br>';

// #4
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=query&titles=PHP|Main&prop=revisions&rvprop=content&format=json");
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($curl), true);
$pages = array_values($result['query']['pages']);
foreach ($pages as $page) {
    $pagetitle = $page['title'];
    $pageid = $page['pageid'];
    echo "Title: $pagetitle <br>ID: $pageid <br>";
}
curl_close($curl);
