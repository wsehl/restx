<?php
require_once "mail_config.php";

$json = file_get_contents('../list.json');
$json = json_decode($json, true);

$message = '';
$message .= '<p>Клиент: ' . $_POST['ename'] . '</p>';
$message .= '<p>Почта: ' . $_POST['email'] . '</p>';
$message .= '<p>Телефон: ' . $_POST['ephone'] . '</p>';
$message .= '<p>Адрес: ' . $_POST['eaddr'] . '</p>';
$message .= '<hr style="width:100px;border-top: 1px dotted black;" align="left">';

$cart = $_POST['cart'];

$price = 0;
$final = 0;
$discount = 0;
$delivery = 0;

foreach ($cart as $id => $count) {
    $message .= $json[$id]['name'] . ' - ';
    $message .= $count . 'шт - ';
    $message .= $count * $json[$id]['cost'];
    $message .= '<br>';
    $price = $price + $count * $json[$id]['cost'];
}
if ($price >= 5000) {
    $delivery = 0;
} else {
    $delivery = 600;
}
if ($price >= 20000) {
    $discount = $price * 0.15;
    $final = $price - $discount;
} else {
    $final = $price + $delivery;
}
$message .= '<br>';
$message .= '<hr style="width:100px;border-top: 1px dotted black;" align="left">';
$message .= 'Всего: ' . $price;
$message .= '<br>';
$message .= 'Скидка: ' . $discount;
$message .= '<br>';
$message .= 'Доставка: ' . $delivery;
$message .= '<br>';
$message .= 'Всего: ' . $final;
$message .= '<br>';

$order_id = 0;
$order_message = $message;

$sql = "INSERT INTO orders (id, order_message) VALUES ('$order_id', '$order_message')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC LIMIT 1");
$print_data = mysqli_fetch_row($sql);
$last_id = $print_data[0];
$message .= '<strong> ID: ' . $last_id . '</strong>';

echo "\n";
echo $last_id;
echo "\n";
print_r($message);
$to = 'widesehl@gmail.com' . ',';
$to .= $_POST['email'];
$spectext = '<!DOCTYPE HTML><html><head><title>Заказ</title></head><body>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$m = mail($to, 'Заказ в ресторане', $spectext . $message . '</body></html>', $headers);
echo "\n";
if ($m) {
    echo 1;
} else {
    echo 0;
}
