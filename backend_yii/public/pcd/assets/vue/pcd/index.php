<!DOCTYPE html>
<?php
    $jsonEncodedData=include("db.php");
    echo $jsonEncodedData;exit;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test_amcharts</title>
    <link rel="stylesheet" href="test_amcharts.css">
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
</head>
<body>
    <h1 style="text-align: center">BIỂU ĐỒ CƠ CẤU CHI NGÂN SÁCH NHÀ NƯỚC TRÊN ĐỊA BÀN TPHCM</h1>
    <!-- <script src="test_amcharts.js"></script> -->
    <script>
        am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.colors.step = 4;

// Add data
chart.data = <?=$jsonEncodedData?>

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.title.text = "Year";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 20;

categoryAxis.startLocation = 0.5;
categoryAxis.endLocation = 0.5;


var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Percent";
valueAxis.calculateTotals = true;
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;
valueAxis.renderer.labels.template.adapter.add("text", function(text) {
  return text + "%";
});

// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "C_NS";
series.dataFields.valueYShow = "totalPercent";
series.dataFields.categoryX = "year";
series.name = "Chi_CĐNS";

series.tooltipHTML = "<span style='font-size:14px; color:#000000;'><b>Chi cân đối ngân sách: {valueY.value}</b></span>";

series.tooltip.getFillFromObject = false;
series.tooltip.background.fill = am4core.color("#FFF");

series.tooltip.getStrokeFromObject = true;
series.tooltip.background.strokeWidth = 3;

series.fillOpacity = 0.85;
series.stacked = true;

// static
series.legendSettings.labelText = "Chi_CĐNS total:";
series.legendSettings.valueText = "{valueY.close}";

// hovering
series.legendSettings.itemLabelText = "Chi_CĐNS:";
series.legendSettings.itemValueText = "{valueY}";

var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.valueY = "motorcycles";
series2.dataFields.valueYShow = "totalPercent";
series2.dataFields.categoryX = "year";
series2.name = "NSNN";

series2.tooltipHTML = "<span style='font-size:14px; color:#000000;'><b>Chi từ nguồn thu để lại đơn vị chi quản lý qua NSNN: {valueY.value}</b></span>";

series2.tooltip.getFillFromObject = false;
series2.tooltip.background.fill = am4core.color("#FFF");

series2.tooltip.getStrokeFromObject = true;
series2.tooltip.background.strokeWidth = 3;

series2.fillOpacity = 0.85;
series2.stacked = true;

// static
series2.legendSettings.labelText = "NSNN total:";
series2.legendSettings.valueText = "{valueY.close}";

// hovering
series2.legendSettings.itemLabelText = "NSNN:";
series2.legendSettings.itemValueText = "{valueY}";

var series3 = chart.series.push(new am4charts.LineSeries());
series3.dataFields.valueY = "bicycles";
series3.dataFields.valueYShow = "totalPercent";
series3.dataFields.categoryX = "year";
series3.name = "Chi_NSCD";
series3.tooltipText = "{name}: [bold]{valueY}[/]";

series3.tooltipHTML = "<span style='font-size:14px; color:#000000;'><b>Chi bổ sung cho ngân sách cấp dưới: {valueY.value}</b></span>";

series3.tooltip.getFillFromObject = false;
series3.tooltip.background.fill = am4core.color("#FFF");

series3.tooltip.getStrokeFromObject = true;
series3.tooltip.background.strokeWidth = 3;

series3.fillOpacity = 0.85;
series3.stacked = true;

// static
series3.legendSettings.labelText = "Chi_NSCD total:";
series3.legendSettings.valueText = "{valueY.close}";

// hovering
series3.legendSettings.itemLabelText = "Chi_NSCD:";
series3.legendSettings.itemValueText = "{valueY}";

var series4 = chart.series.push(new am4charts.LineSeries());
series4.dataFields.valueY = "a";
series4.dataFields.valueYShow = "totalPercent";
series4.dataFields.categoryX = "year";
series4.name = "Chi_NSCT";

series4.tooltipHTML = "<span style='font-size:14px; color:#000000;'><b>Chi nộp ngân sách cấp trên: {valueY.value}</b></span>";

series4.tooltip.getFillFromObject = false;
series4.tooltip.background.fill = am4core.color("#FFF");

series4.tooltip.getStrokeFromObject = true;
series4.tooltip.background.strokeWidth = 3;

series4.fillOpacity = 0.85;
series4.stacked = true;

// static
series4.legendSettings.labelText = "Chi_NSCT total:";
series4.legendSettings.valueText = "{valueY.close}";

// hovering
series4.legendSettings.itemLabelText = "Chi_NSCT:";
series4.legendSettings.itemValueText = "{valueY}";

// Add cursor
chart.cursor = new am4charts.XYCursor();

// add legend
chart.legend = new am4charts.Legend();
// add circle
var bullet3 = series3.bullets.push(new am4charts.CircleBullet())
bullet3.circle.radius = 4 ;
bullet3.fill = chart.colors.getIndex(3);
bullet3.stroke = am4core.color("#fff");
bullet3.strokeWidth = 1.5;
var bullet3hover = bullet3.states.create("hover");
bullet3hover.properties.scale = 1.4;

var bullet = series.bullets.push(new am4charts.CircleBullet())
bullet.circle.radius = 4 ;
bullet.fill = chart.colors.getIndex(3);
bullet.stroke = am4core.color("#fff");
bullet.strokeWidth = 1.5;
var bullethover = bullet.states.create("hover");
bullethover.properties.scale = 1.4;

var bullet2 = series2.bullets.push(new am4charts.CircleBullet())
bullet2.circle.radius = 4 ;
bullet2.fill = chart.colors.getIndex(3);
bullet2.stroke = am4core.color("#fff");
bullet2.strokeWidth = 1.5;
var bullet2hover = bullet2.states.create("hover");
bullet2hover.properties.scale = 1.4;

var bullet4 = series4.bullets.push(new am4charts.CircleBullet())
bullet4.circle.radius = 4 ;
bullet4.fill = chart.colors.getIndex(3);
bullet4.stroke = am4core.color("#fff");
bullet4.strokeWidth = 1.5;
var bullet4hover = bullet4.states.create("hover");
bullet4hover.properties.scale = 1.4;

}); // end am4core.ready()
    </script>
    <div id="chartdiv"></div>    
</body>
</html>