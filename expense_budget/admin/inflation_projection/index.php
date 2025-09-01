<?php
require_once('../../config.php');
require_once('../../classes/Master.php');
// $_settings->set_title('Inflation Projection');
require_once('../inc/header.php');
?>
<script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
<?php
// Fetch budget and expense data from running_balance grouped by year-month
$conn = $Master->conn;
$budget_data = [];
$expense_data = [];

$budget_result = $conn->query("SELECT YEAR(date_created) as year, MONTH(date_created) as month, SUM(amount) as total FROM running_balance WHERE balance_type = 1 GROUP BY year, month ORDER BY year, month");
while($row = $budget_result->fetch_assoc()){
    $label = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
    $budget_data[] = ['label' => $label, 'amount' => floatval($row['total'])];
}

$expense_result = $conn->query("SELECT YEAR(date_created) as year, MONTH(date_created) as month, SUM(amount) as total FROM running_balance WHERE balance_type = 2 GROUP BY year, month ORDER BY year, month");
while($row = $expense_result->fetch_assoc()){
    $label = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
    $expense_data[] = ['label' => $label, 'amount' => floatval($row['total'])];
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Inflation Projection</h3>
                <a href="<?php echo base_url ?>admin" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <canvas id="inflationChart" style="max-width: 100%; height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('inflationChart').getContext('2d');

    const budgetData = <?php echo json_encode($budget_data); ?>;
    const expenseData = <?php echo json_encode($expense_data); ?>;

    // Prepare labels and data for budget
    const budgetLabels = budgetData.map(item => item.label);
    const budgetAmounts = budgetData.map(item => item.amount);

    // Prepare labels and data for expense
    const expenseLabels = expenseData.map(item => item.label);
    const expenseAmounts = expenseData.map(item => item.amount);

    // Combine labels for x-axis (unique sorted)
    const allLabels = Array.from(new Set([...budgetLabels, ...expenseLabels])).sort();

    // Map data to combined labels, fill missing with null
    const budgetDataMapped = allLabels.map(label => {
        const found = budgetData.find(item => item.label === label);
        return found ? found.amount : null;
    });
    const expenseDataMapped = allLabels.map(label => {
        const found = expenseData.find(item => item.label === label);
        return found ? found.amount : null;
    });

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: allLabels,
            datasets: [
                {
                    label: 'Budget',
                    data: budgetDataMapped,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                    tension: 0.1
                },
                {
                    label: 'Expense',
                    data: expenseDataMapped,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false,
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            stacked: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Budget and Expense Overview'
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Amount'
                    },
                    beginAtZero: true
                },
                x: {
                    title: {
                        display: true,
                        text: 'Year-Month'
                    }
                }
            }
        }
    });

    // Inflation projection for 5 years starting at 2% with dynamic fluctuations
    function calculateInflationProjection(startInflation, years) {
        const projection = [];
        let currentInflation = startInflation;
        for (let i = 0; i < years; i++) {
            // Add a random fluctuation between -0.5% and +0.5%
            const fluctuation = (Math.random() - 0.5) * 1.0; // ±0.5%
            currentInflation = currentInflation * (1 + fluctuation / 100);
            // Ensure inflation is not negative
            if (currentInflation < 0) currentInflation = 0;
            projection.push(parseFloat(currentInflation.toFixed(2)));
            // Compound with base 2% inflation
            currentInflation *= 1.02;
        }
        return projection;
    }

    const inflationYears = [];
    const currentYear = new Date().getFullYear();
    for (let i = 0; i < 5; i++) {
        inflationYears.push((currentYear + i).toString());
    }

    const inflationData = calculateInflationProjection(2, 5);

    // Create a new canvas element for inflation projection chart
    const inflationChartContainer = document.createElement('div');
    inflationChartContainer.innerHTML = '<canvas id="inflationProjectionChart" style="max-width: 100%; height: 400px; margin-top: 40px;"></canvas>';
    document.querySelector('.card-body .container-fluid').appendChild(inflationChartContainer);

    const inflationCtx = document.getElementById('inflationProjectionChart').getContext('2d');

    const inflationChart = new Chart(inflationCtx, {
        type: 'line',
        data: {
            labels: inflationYears,
            datasets: [{
                label: 'Inflation Projection (%)',
                data: inflationData,
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Inflation Projection for 5 Years (Starting at 2%)'
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Inflation Rate (%)'
                    },
                    beginAtZero: true
                },
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    }
                }
            }
        }
    });
});
</script>

<?php require_once('../inc/footer.php'); ?>
