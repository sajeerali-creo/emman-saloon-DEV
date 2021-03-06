<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/invoice/style.css" media="all" />
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="<?php echo base_url(); ?>assets/invoice/logo.png">
            </div>
            <div id="company">
                <h2 class="name">Eman Saloon</h2>
                <div>Dubai, UAE,<br />
                    Phone (هاتف):+ 971 4 348 0009
                </div>
                <div>Email (اللكتروني البريد): info@emansalon.com</div>
                <div>TRN # 100021529100003</div>
            </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div style="text-align:center; font-size:22px;">
                    Invoice Tax (فاتورة ضريبية)
                </div>
                <br>
                <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 class="name"><?php echo $bookingInfo['info']['first_name'] . " " . $bookingInfo['info']['last_name']; ?></h2>
                    <div class="address"><?php echo $bookingInfo['info']['address']; ?></div>
                    <div class="email"><a href="mailto:<?php echo $bookingInfo['info']['email']; ?>"><?php echo $bookingInfo['info']['email']; ?></a></div>
                </div>
                <div id="invoice">
                    <div>Receipt Number(رقم اليصال): <?php echo $bookingInfo['info']['invoice_number']; ?></div>
                    <div class="date">Date of Invoice (تاريخ استلم
                        ): <?php echo date("d/m/Y"); ?>
                    </div>
                    <div class="date"><?php echo date("h:i:s A"); ?></div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="desc">Detail (تفاصيل)</th>
                        <th class="qty">Amount (مبلغ)</th>
                        <th class="unit">Qt(كمية)</th>
                        <th class="qty">Discount(خصم)</th>
                        <th class="total">Total Amount (المبلغ الإجمالي)</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $intCount = 1;
                    $intOrderTotal = 0;
                    $intVat = (empty($bookingInfo['info']['vat']) ? 0 : $bookingInfo['info']['vat']);
                    $intESC = (empty($bookingInfo['info']['extra_service_charge']) ? 0 : $bookingInfo['info']['extra_service_charge']);
                    $intVatAmount = 0;
                    foreach ($bookingInfo['serviceAllInfo'] as $key => $value) {
                        $quantity       = $value['person'];
                        $discount       = $value['discount_price'];
                        $price          = number_format($value['price'], 2, '.', '');
                        $service_charge = number_format($value['service_charge'], 2, '.', '');
                        $itemTotal      = (($price + $service_charge) * $quantity);
                        $itemTotal      -= $itemTotal * ($discount / 100);
                        $itemTotal      = number_format($itemTotal, 2, '.', '');
                        $intOrderTotal  += $itemTotal;
                        $itemTotalNew = $itemTotal + ($itemTotal * ($intVat / 100));
                        ?><tr>
                            <td class="no"><?php echo $intCount++; ?></td>
                            <td class="desc">
                                <h3><?php 
                                    echo(ucwords(strtolower($value['serviceCategory'])) ." " . $value['serviceName']); 
                                    if(!empty($value['serviceNameAr'])){
                                        echo "(" . $value['serviceNameAr'] . ")";
                                    }
                                    ?> <!-- (<?php 
                                echo $value['person'];
                                if($value['person'] > 1){
                                    echo " Persons";
                                }
                                else{
                                    echo " Person";
                                }
                                ?> ) --></h3>
                                Service Charge: <?php echo $service_charge; ?> AED<br>
                                Service done by: Roshana
                            </td>
                            <td class="qty"><?php echo $price; ?> AED</td>
                            <td class="unit"><?php echo $value['person']; ?></td>
                            <td class="qty"><?php echo $value['discount_price']; ?>%</td>
                            <td class="total"><?php echo number_format($itemTotalNew, 2, '.', ','); ?> AED</td>
                        </tr><?php
                    }
                    
                    $intVatAmount = ($intOrderTotal + $intESC) * ($intVat / 100);
                    $intVatAmount = number_format($intVatAmount, 2, '.', '');
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="3">EXCLUSIVE</td>
                        <td><?php echo number_format($intOrderTotal, 2, '.', ',') ?> AED</td>
                    </tr><?php
                    if(!empty($intESC)){
                        ?><tr>
                            <td colspan="2"></td>
                            <td colspan="3">EXTRA SERVICE CHARGE</td>
                            <td><?php echo number_format($intESC, 2, '.', ',') ?> AED</td>
                        </tr><?php
                    }
                    ?><tr>
                        <td colspan="2"></td>
                        <td colspan="3">VAT <?php echo $intVat; ?>%</td>
                        <td><?php echo number_format($intVatAmount, 2, '.', ',') ?> AED</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="3">GRAND TOTAL</td>
                        <td><?php echo number_format(($intOrderTotal + $intESC + $intVatAmount), 2, '.', ',') ?> AED</td>
                    </tr>
                </tfoot>
            </table>
            <div id="thanks">Thank you!</div>
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </body>
</html>