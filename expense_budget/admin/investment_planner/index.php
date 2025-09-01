<?php
require_once('../../config.php');
require_once('../../classes/Master.php');
// $_settings->set_title('Investment Planner');
require_once('../inc/header.php');
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Investment Planner</h3>
                <a href="<?php echo base_url ?>admin" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <?php
                    // Fetch total budget and expense sums
                    $conn = $Master->conn;
                    $total_budget = $conn->query("SELECT SUM(amount) as total FROM running_balance WHERE balance_type = 1")->fetch_assoc()['total'];
                    $total_expense = $conn->query("SELECT SUM(amount) as total FROM running_balance WHERE balance_type = 2")->fetch_assoc()['total'];

                    $expense_percentage = 0;
                    if($total_budget > 0){
                        $expense_percentage = ($total_expense / $total_budget) * 100;
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Total Budget: <span class="text-primary"><?php echo number_format($total_budget, 2) ?></span></h5>
                        </div>
                        <div class="col-md-6">
                            <h5>Total Expense: <span class="text-danger"><?php echo number_format($total_expense, 2) ?></span></h5>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5>Expense as Percentage of Budget</h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo min($expense_percentage, 100) ?>%;" aria-valuenow="<?php echo $expense_percentage ?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($expense_percentage, 2) ?>%</div>
                        </div>
                    </div>
                    <?php
                    // Define 5 standard investment options
                    $investment_options = [
                        "High-Yield Savings Account",
                        "Index Funds",
                        "Bonds",
                        "Real Estate Investment Trusts (REITs)",
                        "Stocks"
                    ];

                    // Determine suggestions based on expense percentage with dynamic count
                    if ($expense_percentage < 30) {
                        $suggestions = [
                            $investment_options[4], // Stocks
                            $investment_options[1], // Index Funds
                            $investment_options[0], // High-Yield Savings Account
                        ];
                    } elseif ($expense_percentage < 60) {
                        $suggestions = [
                            $investment_options[1], // Index Funds
                            $investment_options[3], // REITs
                            $investment_options[2], // Bonds
                        ];
                    } elseif ($expense_percentage < 80) {
                        $suggestions = [
                            $investment_options[2], // Bonds
                            $investment_options[0], // High-Yield Savings Account
                        ];
                    } else {
                        $suggestions = [
                            $investment_options[0], // High-Yield Savings Account
                            $investment_options[2], // Bonds
                        ];
                    }
                    ?>
                    <div class="mt-4">
                        <h5>Investment Suggestions</h5>
                        <ul>
                            <?php foreach ($suggestions as $option): ?>
                                <li><?php echo htmlspecialchars($option) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>
