<?php
require_once 'dataBase.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .invoiceContainerShow {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100vw;
            padding: 5px;

        }

        .invoiceContainerHide {
            display: none;

        }

        .salesChartContainer {
            display: flex;
            max-width: 500px;


        }
    </style>
</head>

<body>
    <?php include 'tempnav.php'; ?>
    <h2>Dashbord</h2>
    <div class="salesChartContainer">
        <canvas id="salesChart"></canvas>
    </div>
    <div>
        <button id="showInvoice">Show Invoices</button>
    </div>
    <div>
        <h2>Monthly Sales Summary</h2>
        <table id="salesTable">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Sales</th>
                    <th>Cost</th>
                    <th>Profit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                getMonthlySalesAndCostByTable($conn)
                ?>
            </tbody>
        </table>
    </div>

    <div id="invoiceContainer" class="invoiceContainerHide">
        <h2>Salea by invoce</h2>
        <table>

            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <!-- <th>Date</th> -->
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <!-- <th>Status</th> -->
                    <!-- <th>user_id</th> -->
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                if ($_SESSION["id"] != "") {
                    getAllinvoces($conn);
                }

                ?>
            </tbody>
        </table>



    </div>




</body>

</html>
<?php
$salesData = getMonthlySalesAndCost($conn);
?>
<script>
    const ctx = document.getElementById('salesChart');

    // Create gradient fill for datasets
    const gradient1 = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
    gradient1.addColorStop(0, 'rgba(74, 144, 226, 0.3)');
    gradient1.addColorStop(1, 'rgba(74, 144, 226, 0)');

    const gradient2 = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
    gradient2.addColorStop(0, 'rgba(226, 74, 74, 0.3)');
    gradient2.addColorStop(1, 'rgba(226, 74, 74, 0)');

    const gradient3 = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
    gradient3.addColorStop(0, 'rgba(74, 226, 74, 0.3)');
    gradient3.addColorStop(1, 'rgba(74, 226, 74, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($salesData['months']); ?>,
            datasets: [{
                    label: 'Sales',
                    data: <?php echo json_encode($salesData['sales']); ?>,
                    borderColor: '#4A90E2',
                    backgroundColor: gradient1,
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                },
                {
                    label: 'Cost',
                    data: <?php echo json_encode($salesData['costs']); ?>,
                    borderColor: '#E24A4A',
                    backgroundColor: gradient2,
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                },
                {
                    label: 'Profit',
                    data: <?php echo json_encode($salesData['profits']); ?>,
                    borderColor: '#4AE24A',
                    backgroundColor: gradient3,
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rs.' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Financial Overview',
                    font: {
                        size: 20,
                        weight: 'bold'
                    },
                    padding: 20
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rs.' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
<?php
function getMonthlySalesAndCostByTable($conn)

{
    $salesData = getMonthlySalesAndCost($conn);
    for ($i = 0; $i < count($salesData['months']); $i++) {
        echo "<tr>";
        echo "<td>" . $salesData['months'][$i] . "</td>";
        echo "<td>" . $salesData['sales'][$i] . ".00" . "</td>";
        echo "<td>" . $salesData['costs'][$i] . "</td>";
        echo "<td>" . $salesData['profits'][$i] . "</td>";
        echo "</tr>";
    }
}

?>

<script>
    const showInvoice = document.getElementById('showInvoice');
    const invoiceContainer = document.getElementById('invoiceContainer');
    const tableBody = document.getElementById('tableBody');

    let selectedInvoice = true;


    showInvoice.addEventListener('click', () => {
        console.log('clicked');
        if (selectedInvoice) {
            invoiceContainer.classList.remove('invoiceContainerHide');
            invoiceContainer.classList.add('invoiceContainerShow');
            console.log('show');
        } else {
            invoiceContainer.classList.remove('invoiceContainerShow');
            invoiceContainer.classList.add('invoiceContainerHide');
            console.log('hide');
        }
        selectedInvoice = !selectedInvoice;
    });
</script>