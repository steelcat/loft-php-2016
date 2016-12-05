<?php
CONST TOKEN = 'f65e954fad14cbfb23be0a39b41e624acee0040277c623eec74591f16b8da4da06f5f454daeef8661d39b';
$user_id = 864279;
$text = 'Постим на страничку от имени Steelcat';
$image_name = 'steelcat.jpg';
$image = __DIR__ . DIRECTORY_SEPARATOR . $image_name;

$upload_url = vkAPI('photos.getWallUploadServer', ['owner_id' => $user_id])->response->upload_url;

try {
    $ch = curl_init($upload_url);
    $cfile = curl_file_create($image, mime_content_type($image), $image_name);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['photo' => $cfile]);
    $responseUpload = json_decode(curl_exec($ch));
    curl_close($ch);
    echo 'Картинка успешно загружена<br>';
} catch (Exception $e) {
    exit('Неизвестная ошибка при попытке загрузки картинки');
}

$responseSave = vkAPI('photos.saveWallPhoto', [
    'owner_id' => $user_id,
    'photo' => stripslashes($responseUpload->photo),
    'server' => $responseUpload->server,
    'hash' => $responseUpload->hash,
]);

if ($responseSave->error) {
    exit('Неизвестная ошибка при попытке сохранения картинки');
} else {
    echo 'Картинка успешно сохранена<br>';
}

$responsePost = vkAPI('wall.post', [
    'owner_id' => $user_id,
    'message' => $text,
    'attachments' => $responseSave->response[0]->id,
    'hash' => $responseSave->response[0]->hash,
]);

if ($responsePost->error) {
    if ($responsePost->error->error_code == 214) {
        exit('Стена закрыта для постинга');
    } else {
        exit('Неизвестная ошибка при попытке постинга');
    }
} else {
    echo 'Пост успешно добавлен';
}

function vkAPI($method, array $data = [])
{
    $params = [];
    foreach ($data as $name => $val) {
        $params[$name] = $val;
        $params['access_token'] = TOKEN;
    }
    $json = file_get_contents('https://api.vk.com/method/' . $method . '?' . http_build_query($params));
    return json_decode($json);
}
