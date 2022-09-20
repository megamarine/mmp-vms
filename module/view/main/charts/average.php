<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<?php $TGL = date("F"); $BULAN = date("m"); ?>

<script type="text/javascript">

// Create the chart
Highcharts.chart('container', {
    chart: {
        margin: 75,
        type: 'column',
        options3d: {
            enabled : true,
            alpha   : 30,
            beta    : 10,
            depth   : 50
        }
    },
    title: {
        text: 'Average Transportation in <?php echo $TGL; ?> '
    },
    subtitle: {
        text: 'Click the columns to view detail.'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Waktu (Menit)'
        }

    },
    plotOptions: {
        column: {
            depth: 35
        },
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total minutes<br/>'
    },
    series: [{
        colorByPoint: true,
        name: 'Category',
        data: [
        <?php
        $stmt = $db1->query("select KEPERLUAN, AVG(timestampdiff(minute,TANGGAL_PARKIR, TANGGAL_KELUAR)) as AVG from (select NAMA_SUPPLIER, KEPERLUAN, TANGGAL_PARKIR, TANGGAL_KELUAR from t_parkirmasuk where TANGGAL_KELUAR IS NOT NULL and NAMA_SUPPLIER != '' and month(TANGGAL_KELUAR) = '$BULAN') tempTable group by KEPERLUAN");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $KEPERLUAN = $row["KEPERLUAN"];
            ?>
            {
                name: '<?php echo $row["KEPERLUAN"]; ?>',
                y: <?php echo $row["AVG"]; ?>,
                drilldown: '<?php echo $row["KEPERLUAN"]; ?>',
            },
            <?php
        }
        ?>
        ],
        stack: 0
    }],
    drilldown: {
        series: [
        <?php
        $stmt2 = $db1->query("select KEPERLUAN, AVG(timestampdiff(minute,TANGGAL_PARKIR, TANGGAL_KELUAR)) as AVG from (select NAMA_SUPPLIER, KEPERLUAN, TANGGAL_PARKIR, TANGGAL_KELUAR from t_parkirmasuk where TANGGAL_KELUAR IS NOT NULL and NAMA_SUPPLIER != '' and month(TANGGAL_KELUAR) = '$BULAN') tempTable group by KEPERLUAN");
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $KEPERLUAN = $row2["KEPERLUAN"];
            ?>
            {
                id: '<?php echo $KEPERLUAN; ?>',
                name: '<?php echo $KEPERLUAN; ?>',
                data: [
                <?php
                $stmt21 = $db1->query("select NAMA_SUPPLIER,KEPERLUAN, AVG(timestampdiff(minute,TANGGAL_PARKIR, TANGGAL_KELUAR)) as AVG1 from (select NAMA_SUPPLIER, KEPERLUAN, TANGGAL_PARKIR, TANGGAL_KELUAR from t_parkirmasuk where KEPERLUAN = '$KEPERLUAN' and TANGGAL_KELUAR IS NOT NULL and NAMA_SUPPLIER != '' and month(TANGGAL_KELUAR) = '$BULAN') tempTable group by NAMA_SUPPLIER");
                while ($row21 = $stmt21->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    {
                        name: '<?php echo $row21["NAMA_SUPPLIER"]; ?>',
                        y: <?php echo $row21["AVG1"]; ?>,
                    },
                    <?php
                }
                ?>
                ],
            },
            <?php
        }
        ?>
        ]
    }
});
</script>