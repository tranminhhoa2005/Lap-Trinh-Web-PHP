<?php
function h($s) { return htmlspecialchars($s); }

$products = [
    ['name' => 'iPhone 15', 'price' => 1000, 'qty' => 2],
    ['name' => 'Mouse', 'price' => 50, 'qty' => 10],
    ['name' => 'Keyboard', 'price' => 150, 'qty' => 5],
];

// Thêm cột amount
$products = array_map(function($p) {
    $p['amount'] = $p['price'] * $p['qty'];
    return $p;
}, $products);

// Tính tổng tiền
$total = array_reduce($products, fn($carry, $p) => $carry + $p['amount'], 0);

// Tìm sản phẩm amount lớn nhất
$maxProduct = array_reduce($products, fn($a, $b) => ($a['amount'] > $b['amount'] ? $a : $b), $products[0]);

// Sắp xếp price giảm dần
usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
?>

<table border="1">
    <tr>
        <th>STT</th><th>Name</th><th>Price</th><th>Qty</th><th>Amount</th>
    </tr>
    <?php foreach ($products as $index => $p): ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= h($p['name']) ?></td>
        <td><?= $p['price'] ?></td>
        <td><?= $p['qty'] ?></td>
        <td><?= $p['amount'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<p>Tổng tiền: <?= $total ?></p>
<p>Sản phẩm đắt nhất theo Amount: <?= h($maxProduct['name']) ?> (<?= $maxProduct['amount'] ?>)</p>