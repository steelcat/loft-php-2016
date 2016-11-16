<?php
// #1
$xml_data = simplexml_load_file('data.xml');

echo '<h1>Заказ номер : ' . $xml_data["PurchaseOrderNumber"] . '</h1>';
echo 'Дата покупки : ' . $xml_data["OrderDate"];
echo '<h2>Адреса</h2>';
$addresses = $xml_data->Address;
foreach ($addresses as $address) {
    echo 'Тип адреса : ' . $address['Type'] . '<br>';
    echo '-----<br>';
    echo 'Имя : ' . (string) $address->Name . '<br>';
    echo 'Улица : ' . (string) $address->Street . '<br>';
    echo 'Город : ' . (string) $address->City . '<br>';
    echo 'Штат : ' . (string) $address->State . '<br>';
    echo 'Индекс : ' . (string) $address->Zip . '<br>';
    echo 'Страна : ' . (string) $address->Country . '<br>';
    echo '<br>';
}

echo 'Примечания к заказу : ' . (string) $xml_data->DeliveryNotes . '<br>';

echo '<h2>Товары</h2>';

$items = $xml_data->Items->Item;
foreach ($items as $item) {
    echo 'Артикул : ' . $item['PartNumber'] . '<br>';
    echo '-----<br>';
    echo 'Название : ' . (string) $item->ProductName . '<br>';
    echo 'Количество : ' . (string) $item->Quantity . '<br>';
    echo 'Цена : $' . (string) $item->USPrice . '<br>';
    echo 'Дата доставки : ' . (string) $item->ShipDate . '<br>';
    echo 'Комментарий : ' . (string) $item->Comment . '<br>';
    echo '<br>';
}



echo '<br><br>';

// #4
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
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
