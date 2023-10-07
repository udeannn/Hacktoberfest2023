<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
<script>
    $('.select2').select2({
        theme: 'bootstrap4',
    });

    // Top Sell Product
    const dataTopSellProduct = {
        labels: [],
        datasets: [{
            label: 'Sales',
            data: [],
            backgroundColor: [
                '#e67e22',
                '#dc3545',
                '#28a745',
                '#ffc107',
                '#17a2b8',
                '#605ca8',
                '#f012be',
                '#001f3f',
                '#d81b60',
                '#39cccc'
            ],
            hoverOffset: 4
        }]
    };

    const configTopSellProduct = {
        type: 'pie',
        data: dataTopSellProduct,
        weight: 20
    };

    let topSellProduct = new Chart(
        document.getElementById('topSellProduct'),
        configTopSellProduct
    );

    // Chart Order

    const dataChartOrder = {
        labels: [],
        datasets: []
    };

    const configChartOrder = {
        type: 'line',
        data: dataChartOrder,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false
                }
            },
            interaction: {
                mode: 'index',
                intersect: false,
            },
            stacked: false,
        },
    };

    let chartOrder = new Chart(
        document.getElementById('chartOrder'),
        configChartOrder
    );


    $('#form-filter').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: CURRENT_URL + '/filter',
            type: "GET",
            data: data,
            beforeSend: function() {
                $(".preload").show();
            },
            success: function(response) {
                // Widget
                let widget = '';
                $.each(response.widget, function(key, value) {
                    widget += `
                    <div class="${value.size} col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon ${value.color}"><i class="${value.icon}"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">${value.title}</span>
                                <span class="info-box-number">${
                                    value.is_currency == 1 ? rupiah(value.value) : numeric(value.value)
                                }</span>
                            </div>
                        </div>
                    </div>
                    `
                })
                $('#widget').html(widget);

                topSellProduct.data.labels = response.topSellProduct.labels;
                topSellProduct.data.datasets[0].data = response.topSellProduct.data;
                topSellProduct.update();

                chartOrder.data.labels = response.chartOrder.labels;
                chartOrder.data.datasets = response.chartOrder.datasets;
                chartOrder.update();
            }
        });
    });
</script>