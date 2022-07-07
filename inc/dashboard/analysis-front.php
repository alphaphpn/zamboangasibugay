<?php

	include_once "../../inc/cnndb.php";

	// Page Visit
	$qry_pagevisit = "SELECT * FROM conf WHERE id=:ownerid LIMIT 1";
	$stmt_pagevisit = $cnn->prepare($qry_pagevisit);
	$stmt_pagevisit->bindParam(':ownerid', $owner_id);
	$stmt_pagevisit->execute();
	$row_pagevisit = $stmt_pagevisit->fetch(PDO::FETCH_ASSOC);
	$pagevisit = $row_pagevisit['page_visit'];

	// User
	$qry_user = "SELECT * FROM tbl_sysuser WHERE deletedx=0";
	$stmnt_user = $cnn->prepare($qry_user);
	$stmnt_user->execute();
	$rwCntUsr = $stmnt_user->rowCount();

	// Admin
	$qry_admin = "SELECT * FROM tbl_sysuser WHERE ulevpos=1 AND deletedx=0";
	$stmnt_admin = $cnn->prepare($qry_admin);
	$stmnt_admin->execute();
	$rwCntAdmin = $stmnt_admin->rowCount();
	// Cashier
	$qry_cashier = "SELECT * FROM tbl_sysuser WHERE ulevpos=3 AND deletedx=0";
	$stmnt_cashier = $cnn->prepare($qry_cashier);
	$stmnt_cashier->execute();
	$rwCntCashier = $stmnt_cashier->rowCount();
	// Customer
	$qry_customer = "SELECT * FROM tbl_sysuser WHERE ulevpos=6 AND deletedx=0";
	$stmnt_customer = $cnn->prepare($qry_customer);
	$stmnt_customer->execute();
	$rwCntCustomer = $stmnt_customer->rowCount();

	// Customer Service | Staff
	$qry_cs = "SELECT * FROM tbl_sysuser WHERE ulevpos=2 AND deletedx=0";
	$stmnt_cs = $cnn->prepare($qry_cs);
	$stmnt_cs->execute();
	$rwCntCS = $stmnt_cs->rowCount();
	// Client
	$qry_client = "SELECT * FROM tbl_sysuser WHERE ulevpos=4 AND deletedx=0";
	$stmnt_client = $cnn->prepare($qry_client);
	$stmnt_client->execute();
	$rwCntClient = $stmnt_client->rowCount();
	// Agent
	$qry_agent = "SELECT * FROM tbl_sysuser WHERE ulevpos=5 AND deletedx=0";
	$stmnt_agent = $cnn->prepare($qry_agent);
	$stmnt_agent->execute();
	$rwCntAgent = $stmnt_agent->rowCount();

	// Order
	$qry_order = "SELECT * FROM tbl_order_customer WHERE remarks=:process OR remarks=:checkout OR remarks=:reviewed OR remarks=:approved OR remarks=:shipped AND status=:unpaid AND deleted=0";
	$stmnt_order = $cnn->prepare($qry_order);
	$process = 'Process';
	$checkout = 'Checkout';
	$reviewed = 'Reviewed';
	$approved = 'Approved';
	$shipped = 'Shipped';
	$unpaid = 'Unpaid';
	$stmnt_order->bindParam(':process', $process);
	$stmnt_order->bindParam(':checkout', $checkout);
	$stmnt_order->bindParam(':reviewed', $reviewed);
	$stmnt_order->bindParam(':approved', $approved);
	$stmnt_order->bindParam(':shipped', $shipped);
	$stmnt_order->bindParam(':unpaid', $unpaid);
	$stmnt_order->execute();
	$rwCntOrdr = $stmnt_order->rowCount();

	// Order: Process
	$qry_process = "SELECT * FROM tbl_order_customer WHERE remarks=:process AND deleted=0";
	$stmnt_process = $cnn->prepare($qry_process);
	$process = 'Process';
	$stmnt_process->bindParam(':process', $process);
	$stmnt_process->execute();
	$rwCntProcess = $stmnt_process->rowCount();
	// Order: Checkout
	$qry_checkout = "SELECT * FROM tbl_order_customer WHERE remarks=:checkout AND deleted=0";
	$stmnt_checkout = $cnn->prepare($qry_checkout);
	$checkout = 'Checkout';
	$stmnt_checkout->bindParam(':checkout', $checkout);
	$stmnt_checkout->execute();
	$rwCntCheckout = $stmnt_checkout->rowCount();
	// Order: Reviewed
	$qry_reviewed= "SELECT * FROM tbl_order_customer WHERE remarks=:reviewed AND deleted=0";
	$stmnt_reviewed = $cnn->prepare($qry_reviewed);
	$reviewed = 'Reviewed';
	$stmnt_reviewed->bindParam(':reviewed', $reviewed);
	$stmnt_reviewed->execute();
	$rwCntReviewed = $stmnt_reviewed->rowCount();
	// Order: Approved
	$qry_approved = "SELECT * FROM tbl_order_customer WHERE remarks=:approved AND deleted=0";
	$stmnt_approved = $cnn->prepare($qry_approved);
	$approved = 'Approved';
	$stmnt_approved->bindParam(':approved', $approved);
	$stmnt_approved->execute();
	$rwCntApproved = $stmnt_approved->rowCount();
	// Order: Declined
	$qry_declined = "SELECT * FROM tbl_order_customer WHERE remarks=:declined AND deleted=0";
	$stmnt_declined = $cnn->prepare($qry_declined);
	$declined = 'Declined';
	$stmnt_declined->bindParam(':declined', $declined);
	$stmnt_declined->execute();
	$rwCntDeclined = $stmnt_declined->rowCount();
	// Order: Shipped
	$qry_shipped = "SELECT * FROM tbl_order_customer WHERE remarks=:shipped AND deleted=0";
	$stmnt_shipped = $cnn->prepare($qry_shipped);
	$shipped = 'Shipped';
	$stmnt_shipped->bindParam(':shipped', $shipped);
	$stmnt_shipped->execute();
	$rwCntShipped = $stmnt_shipped->rowCount();
	// Order: Complete
	$qry_complete = "SELECT * FROM tbl_order_customer WHERE remarks=:complete AND status=:paid AND deleted=0";
	$stmnt_complete = $cnn->prepare($qry_complete);
	$complete = 'Complete';
	$paid = 'Paid';
	$stmnt_complete->bindParam(':complete', $complete);
	$stmnt_complete->bindParam(':paid', $paid);
	$stmnt_complete->execute();
	$rwCntComplete = $stmnt_complete->rowCount();

	// Order: Paid
	$qry_paid = "SELECT * FROM tbl_order_customer WHERE status=:paid AND deleted=0";
	$stmnt_paid = $cnn->prepare($qry_paid);
	$paid = 'Paid';
	$stmnt_paid->bindParam(':paid', $paid);
	$stmnt_paid->execute();
	$rwCntPaid = $stmnt_paid->rowCount();
	// Order: Unpaid
	$qry_unpaid = "SELECT * FROM tbl_order_customer WHERE status=:unpaid AND deleted=0";
	$stmnt_unpaid = $cnn->prepare($qry_unpaid);
	$unpaid = 'Unpaid';
	$stmnt_unpaid->bindParam(':unpaid', $unpaid);
	$stmnt_unpaid->execute();
	$rwCntUnpaid = $stmnt_unpaid->rowCount();
	// Order: Cancel
	$qry_cancel = "SELECT * FROM tbl_order_customer WHERE status=:cancel AND deleted=0";
	$stmnt_cancel = $cnn->prepare($qry_cancel);
	$cancel = 'Cancel';
	$stmnt_cancel->bindParam(':cancel', $cancel);
	$stmnt_cancel->execute();
	$rwCntCancel = $stmnt_cancel->rowCount();

	// Sales / Paid
	$qry_sales = "SELECT SUM(sub_total) AS tsales FROM tbl_order_customer WHERE status=:paid AND deleted=0";
	$stmnt_sales = $cnn->prepare($qry_sales);
	$paid = 'Paid';
	$stmnt_sales->bindParam(':paid', $paid);
	$stmnt_sales->execute();
	$row_sales = $stmnt_sales->fetch(PDO::FETCH_ASSOC);
	if ($row_sales['tsales']==0) {
		$rwCntSals = '0.00';
	} else {
		$rwCntSals = $row_sales['tsales'];
	}
	// Unpaid
	$qry_amt_unpaid = "SELECT SUM(sub_total) AS sub_unpaid FROM tbl_order_customer WHERE status=:sum_unpaid AND deleted=0";
	$stmnt_amt_unpaid = $cnn->prepare($qry_amt_unpaid);
	$sum_unpaid = 'Unpaid';
	$stmnt_amt_unpaid->bindParam(':sum_unpaid', $sum_unpaid);
	$stmnt_amt_unpaid->execute();
	$row_amt_unpaid = $stmnt_amt_unpaid->fetch(PDO::FETCH_ASSOC);
	if ($row_amt_unpaid['sub_unpaid']==0) {
		$rwSumUnpaid = '0.00';
	} else {
		$rwSumUnpaid = $row_amt_unpaid['sub_unpaid'];
	}
	// Cancel
	$qry_amt_cancel = "SELECT SUM(sub_total) AS sub_cancel FROM tbl_order_customer WHERE status=:sum_cancel AND deleted=0";
	$stmnt_amt_cancel = $cnn->prepare($qry_amt_cancel);
	$sum_cancel = 'Cancel';
	$stmnt_amt_cancel->bindParam(':sum_cancel', $sum_cancel);
	$stmnt_amt_cancel->execute();
	$row_amt_cancel = $stmnt_amt_cancel->fetch(PDO::FETCH_ASSOC);
	if ($row_amt_cancel['sub_cancel']==0) {
		$rwSumCancel = '0.00';
	} else {
		$rwSumCancel = $row_amt_cancel['sub_cancel'];
	}

	// Global Variable for Analytics
	$total_pagevisits = $pagevisit;
	
	$total_user = $rwCntUsr;
	$total_admin = $rwCntAdmin;
	$total_cashier = $rwCntCashier;
	$total_customer = $rwCntCustomer;

	$total_cservice = $rwCntCS;
	$total_client = $rwCntClient;
	$total_agent = $rwCntAgent;

	$total_order = $rwCntOrdr;
	$total_process = $rwCntProcess;
	$total_checkout = $rwCntCheckout;
	$total_reviewed = $rwCntReviewed;
	$total_approved = $rwCntApproved;
	$total_declined = $rwCntDeclined;
	$total_shipped = $rwCntShipped;
	$total_complete = $rwCntComplete;

	$total_paid = $rwCntPaid;
	$total_unpaid = $rwCntUnpaid;
	$total_cancel = $rwCntCancel;

	$total_sales = number_format($rwCntSals,2);
	$total_amt_unpaid = number_format($rwSumUnpaid,2);
	$total_amt_cancel = number_format($rwSumCancel,2);
	