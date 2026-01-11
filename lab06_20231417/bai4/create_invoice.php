<?php
$invoiceData = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $items = $_POST['items'];
    $subtotal = 0;
    $validItems = [];

    foreach ($items as $item) {
        if (!empty($item['name']) && $item['qty'] > 0 && $item['price'] > 0) {
            $total = $item['qty'] * $item['price'];
            $subtotal += $total;
            $item['total'] = $total;
            $validItems[] = $item;
        }
    }

    if (count($validItems) > 0) {
        $discount = $_POST['discount'];
        $vat = $_POST['vat'];
        $discountAmt = $subtotal * ($discount / 100);
        $vatAmt = ($subtotal - $discountAmt) * ($vat / 100);
        $finalTotal = ($subtotal - $discountAmt) + $vatAmt;

        $invoiceData = [
            'customer' => $_POST['customer_name'],
            'phone' => $_POST['phone'],
            'items' => $validItems,
            'subtotal' => $subtotal,
            'discount' => $discountAmt,
            'vat' => $vatAmt,
            'final' => $finalTotal,
            'time' => date('Y-m-d H:i:s')
        ];
        
        if (!is_dir('../data/invoices')) mkdir('../data/invoices', 0777, true);
        file_put_contents("../data/invoices/invoice_".time().".json", json_encode($invoiceData, JSON_PRETTY_PRINT));
    }
}
?>

<form method="post">
    Khách: <input type="text" name="customer_name" required> 
    SĐT: <input type="text" name="phone" required><br><br>
    
    <?php for($i=0; $i<3; $i++): ?>
    Mặt hàng <?=$i+1?>: <input type="text" name="items[<?=$i?>][name]">
    SL: <input type="number" name="items[<?=$i?>][qty]">
    Giá: <input type="number" name="items[<?=$i?>][price]"><br>
    <?php endfor; ?>
    
    <br>Giảm giá %: <input type="number" name="discount" value="0">
    VAT %: <input type="number" name="vat" value="0"><br>
    <button type="submit">Tạo hóa đơn</button>
</form>

<?php if ($invoiceData): ?>
<h3>HÓA ĐƠN</h3>
<p>Khách: <?= $invoiceData['customer'] ?> - <?= $invoiceData['phone'] ?></p>
<table border="1">
    <tr><th>Hàng</th><th>SL</th><th>Đơn giá</th><th>Thành tiền</th></tr>
    <?php foreach ($invoiceData['items'] as $it): ?>
    <tr>
        <td><?= $it['name'] ?></td>
        <td><?= $it['qty'] ?></td>
        <td><?= number_format($it['price']) ?></td>
        <td><?= number_format($it['total']) ?></td>
    </tr>
    <?php endforeach; ?>
    <tr><td colspan="3">Tổng tạm</td><td><?= number_format($invoiceData['subtotal']) ?></td></tr>
    <tr><td colspan="3">Giảm giá</td><td>-<?= number_format($invoiceData['discount']) ?></td></tr>
    <tr><td colspan="3">VAT</td><td>+<?= number_format($invoiceData['vat']) ?></td></tr>
    <tr><td colspan="3"><strong>TỔNG CỘNG</strong></td><td><strong><?= number_format($invoiceData['final']) ?></strong></td></tr>
</table>
<?php endif; ?>